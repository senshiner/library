<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Gunakan LibraryController untuk dashboard - accessible by both admin and member
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [LibraryController::class, 'dashboard'])->name('dashboard');
});

// Shared routes - accessible by both admin and member
Route::middleware(['auth', 'verified'])->group(function () {
    // Books - view only for all authenticated users
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
});

// Admin routes - full access
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Books - create, edit, delete for admin only
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Members
    Route::resource('members', MemberController::class);
    
    // Borrows
    Route::resource('borrows', BorrowController::class);
    Route::post('/borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
    
    // Users - User Management
    Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
});

// Member routes - limited access (create borrow)
Route::middleware(['auth', 'verified', 'role:member'])->group(function () {
    // Members can create borrow (peminjaman)
    Route::get('/borrows/create', [BorrowController::class, 'create'])->name('borrows.create');
    Route::post('/borrows', [BorrowController::class, 'store'])->name('borrows.store');
});

require __DIR__.'/auth.php';