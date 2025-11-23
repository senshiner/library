<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\LibraryController;

// Routes untuk Perpustakaan
Route::get('/library', [LibraryController::class, 'dashboard'])->name('library.dashboard');
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('members', MemberController::class);
Route::resource('borrows', BorrowController::class);
Route::get('/', function () {
    return redirect()->route('library.dashboard');
});
