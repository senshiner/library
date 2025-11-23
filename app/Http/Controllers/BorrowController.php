<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Check book availability
        $book = Book::find($request->book_id);
        if ($book->available < 1) {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Create borrow record
        $borrow = Borrow::create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'user_id' => Auth::id() ?? 1, // Default to user 1 if no auth
            'borrow_date' => $request->borrow_date,
            'due_date' => $request->due_date,
            'status' => 'borrowed',
            'notes' => $request->notes,
        ]);

        // Update book availability
        $book->decrement('available');

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
        // Update borrow status
        $borrow->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        // Update book availability
        $borrow->book->increment('available');

        return redirect()->route('borrows.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}
