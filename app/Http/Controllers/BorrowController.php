<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
        ]);

        // Use transaction & pessimistic locking to prevent race conditions
        try {
            $borrow = DB::transaction(function () use ($request) {
                // Lock book row for update (SELECT ... FOR UPDATE)
                $book = Book::lockForUpdate()->findOrFail($request->book_id);

                // Check book availability after lock
                if ($book->available < 1) {
                    throw new \Exception('Buku tidak tersedia untuk dipinjam.');
                }

                // Create borrow record
                $borrow = Borrow::create([
                    'book_id' => $request->book_id,
                    'member_id' => $request->member_id,
                    'user_id' => Auth::id() ?? 1,
                    'borrow_date' => $request->borrow_date,
                    'due_date' => $request->due_date,
                    'status' => 'borrowed',
                    'notes' => $request->notes ?? null,
                ]);

                // Decrement book availability (atomic operation)
                $book->decrement('available');

                return $borrow;
            });

            return redirect()->route('borrows.index')
                ->with('success', 'Peminjaman berhasil dicatat.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage() ?? 'Peminjaman gagal. Silakan coba lagi.');
        }
    }

    public function show(Borrow $borrow)
    {
        $borrow->load(['book', 'member', 'user']);
        return view('borrows.show', compact('borrow'));
    }

    public function edit(Borrow $borrow)
    {
        $books = Book::all();
        $members = Member::all();
        return view('borrows.edit', compact('borrow', 'books', 'members'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:borrowed,returned,overdue',
        ]);

        $borrow->update($request->all());

        return redirect()->route('borrows.index')
            ->with('success', 'Data peminjaman berhasil diupdate.');
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return redirect()->route('borrows.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function returnBook(Borrow $borrow)
    {
        // Use transaction & pessimistic locking to prevent race conditions
        try {
            DB::transaction(function () use ($borrow) {
                // Lock borrow & book rows for update
                $borrow = Borrow::lockForUpdate()->findOrFail($borrow->id);
                $book = Book::lockForUpdate()->findOrFail($borrow->book_id);

                // Check if already returned (prevent double return)
                if ($borrow->status === 'returned') {
                    throw new \Exception('Buku ini sudah dikembalikan sebelumnya.');
                }

                // Update borrow status
                $borrow->update([
                    'return_date' => now(),
                    'status' => 'returned',
                ]);

                // Increment book availability (atomic operation)
                $book->increment('available');
            });

            return redirect()->route('borrows.index')
                ->with('success', 'Buku berhasil dikembalikan.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage() ?? 'Pengembalian gagal. Silakan coba lagi.');
        }
    }
}
