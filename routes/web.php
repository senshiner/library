<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\LibraryController;

Route::get('/', function () {
    return view('welcome');
});

// Gunakan LibraryController untuk dashboard
Route::get('/dashboard', [LibraryController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Routes untuk Perpustakaan
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('borrows', BorrowController::class)->except(['edit']);
    Route::post('/borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
});

require __DIR__.'/auth.php';