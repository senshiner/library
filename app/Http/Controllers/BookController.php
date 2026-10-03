<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = Book::with('category')
            ->when($search, fn ($q) => $q->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('books.index', compact('books', 'search'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatedBookData($request);
        $validated['available'] = $validated['quantity'];

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $this->validatedBookData($request, $book);
        $activeBorrows = $book->borrows()->whereIn('status', ['borrowed', 'overdue'])->count();

        if ($validated['quantity'] < $activeBorrows) {
            return back()->withInput()->withErrors([
                'quantity' => 'Jumlah buku tidak boleh lebih kecil dari total peminjaman aktif.',
            ]);
        }

        if (($validated['available'] ?? 0) > $validated['quantity'] - $activeBorrows) {
            return back()->withInput()->withErrors([
                'available' => 'Stok tersedia tidak boleh melebihi jumlah buku dikurangi peminjaman aktif.',
            ]);
        }

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy(Book $book)
    {
        if ($book->borrows()->whereIn('status', ['borrowed', 'overdue'])->exists()) {
            return back()->with('error', 'Buku dengan peminjaman aktif tidak boleh dihapus.');
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    private function validatedBookData(Request $request, ?Book $book = null): array
    {
        $currentYear = now()->year;

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'isbn' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('books', 'isbn')->ignore($book),
            ],
            'quantity' => ['required', 'integer', 'min:1'],
            'published_year' => ['nullable', 'integer', 'min:1900', 'max:' . $currentYear],
            'publisher' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
        ];

        if ($book) {
            $rules['available'] = ['required', 'integer', 'min:0'];
        }

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request, $book) {
            if (! $book || $validator->errors()->isNotEmpty()) {
                return;
            }

            if ((int) $request->available > (int) $request->quantity) {
                $validator->errors()->add('available', 'Stok tersedia tidak boleh melebihi jumlah buku.');
            }
        });

        return $validator->validate();
    }
}
