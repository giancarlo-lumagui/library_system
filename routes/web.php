<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// dashboard auth
Route::get('dashboard', function (){
    return view('dashboard.dashboard');
})->name('dashboard');


// auth routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// util routes
Route::get('/users/show', [UserController::class, 'show']);
Route::get('/users/users', [UserController::class, 'showUsers'])->name('users');
Route::post('/users/register', [UserController::class, 'register']);
Route::delete('/users/{deleteId}', [UserController::class, 'destroy']);
Route::put('/users/{editId}', [UserController::class, 'update']);

// book routes


Route::get('/books/show', [BookController::class, 'show']);
Route::get('/books/books', [BookController::class, 'showBooks'])->name('books');
Route::post('/books/register', [BookController::class, 'register']); //->name('books');
Route::put('/books/{editId}', [BookController::class, 'update']);
Route::delete('/books/{deleteId}', [BookController::class, 'destroy']);
Route::get('/books/filter', [BookController::class, 'filter']);
Route::get('/books/genres', [BookController::class, 'showGenre']);


// member routes

Route::get('/members/show', [MemberController::class, 'show']);
Route::get('/members/members', [MemberController::class, 'showMembers'])->name('members');
Route::post('/members/register', [MemberController::class, 'register']); //->name('register');
Route::put('/members/{id}', [MemberController::class, 'update']);
Route::delete('/members/{id}', [MemberController::class, 'destroy']);

// borrow routes

Route::get('/borrows/show',[BorrowController::class,'showBorrowPage'])->name('borrow');
Route::get('/borrows/list',[BorrowController::class,'showBorrows']);
Route::post('/borrows/borrow',[BorrowController::class,'borrow']);
Route::put('/borrows/return/{id}',[BorrowController::class,'returnBook']);
