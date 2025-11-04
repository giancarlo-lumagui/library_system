<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


// auth routes
Route::post('/login', [UserController::class, 'login'])->name('login');


// util routes
Route::get('/users/show', [UserController::class, 'show']);
Route::get('/users/users', [UserController::class, 'showUsers']);
Route::post('/users/register', [UserController::class, 'register'])->name('users');
Route::delete('/users/{deleteId}', [UserController::class, 'destroy']);
Route::put('/users/{editId}', [UserController::class, 'update']);