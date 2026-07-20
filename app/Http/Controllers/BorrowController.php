<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use RuntimeException;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['book', 'member', 'user'])->latest()->get();
        return view('borrows.index', compact('borrows'));
    }

    public function create()
    {
        $books = Book::where('available', '>', 0)->get();
        $members = Member::where('status', 'active')->get();
        return view('borrows.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'member_id' => [
                'required',
                Rule::exists('members', 'id')->where('status', 'active'),
            ],
            'borrow_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after:borrow_date'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $borrowed = DB::transaction(function () use ($validated) {
            $book = Book::whereKey($validated['book_id'])->lockForUpdate()->firstOrFail();

            if ($book->available < 1) {
                return false;
            }

            Borrow::create([
                'book_id' => $book->id,
                'member_id' => $validated['member_id'],
                'user_id' => Auth::id(),
                'borrow_date' => $validated['borrow_date'],
                'due_date' => $validated['due_date'],
                'status' => 'borrowed',
                'notes' => $validated['notes'] ?? null,
            ]);

            $book->decrement('available');

            return true;
        });

        if (! $borrowed) {
            return back()->withInput()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        return redirect()->route('borrows.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Borrow $borrow)
    {
        $borrow->load(['book', 'member', 'user']);
        return view('borrows.show', compact('borrow'));
    }

    public function edit(Borrow $borrow)
    {
        abort(404);
    }

    public function update(Request $request, Borrow $borrow)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'member_id' => [
                'required',
                Rule::exists('members', 'id')->where('status', 'active'),
            ],
            'borrow_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after:borrow_date'],
            'return_date' => ['nullable', 'date', 'after_or_equal:borrow_date'],
            'status' => ['required', 'in:borrowed,returned,overdue'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            DB::transaction(function () use ($borrow, $validated) {
                $lockedBorrow = Borrow::whereKey($borrow->id)->lockForUpdate()->firstOrFail();
                $oldBookId = $lockedBorrow->book_id;
                $newBookId = (int) $validated['book_id'];
                $wasActive = $lockedBorrow->status !== 'returned';
                $willBeActive = $validated['status'] !== 'returned';

                $bookIds = collect([$oldBookId, $newBookId])->unique()->sort()->values();
                $books = Book::whereIn('id', $bookIds)->lockForUpdate()->get()->keyBy('id');
                $oldBook = $books[$oldBookId];
                $newBook = $books[$newBookId];

                if ($wasActive) {
                    $oldBook->available = min($oldBook->quantity, $oldBook->available + 1);
                    $oldBook->save();
                }

                if ($willBeActive) {
                    $newBook->refresh();

                    if ($newBook->available < 1) {
                        throw new RuntimeException('Buku tidak tersedia untuk dipinjam.');
                    }

                    $newBook->decrement('available');
                }

                $lockedBorrow->update([
                    'book_id' => $newBookId,
                    'member_id' => $validated['member_id'],
                    'borrow_date' => $validated['borrow_date'],
                    'due_date' => $validated['due_date'],
                    'return_date' => $validated['status'] === 'returned'
                        ? ($validated['return_date'] ?? now())
                        : null,
                    'status' => $validated['status'],
                    'notes' => $validated['notes'] ?? null,
                ]);
            });
        } catch (RuntimeException $exception) {
            return back()->withInput()->with('error', $exception->getMessage());
        }

        return redirect()->route('borrows.index')
            ->with('success', 'Data peminjaman berhasil diupdate.');
    }

    public function destroy(Borrow $borrow)
    {
        if ($borrow->status !== 'returned') {
            return back()->with('error', 'Peminjaman aktif tidak boleh dihapus. Kembalikan buku terlebih dahulu.');
        }

        $borrow->delete();

        return redirect()->route('borrows.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function returnBook(Borrow $borrow)
    {
        $returned = DB::transaction(function () use ($borrow) {
            $lockedBorrow = Borrow::whereKey($borrow->id)->lockForUpdate()->firstOrFail();

            if ($lockedBorrow->status === 'returned') {
                return false;
            }

            $book = Book::whereKey($lockedBorrow->book_id)->lockForUpdate()->firstOrFail();

            $lockedBorrow->update([
                'return_date' => now(),
                'status' => 'returned',
            ]);

            $book->available = min($book->quantity, $book->available + 1);
            $book->save();

            return true;
        });

        if (! $returned) {
            return redirect()->route('borrows.index')
                ->with('error', 'Buku sudah ditandai sebagai dikembalikan.');
        }

        return redirect()->route('borrows.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}
