<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


// auth routes
Route::post('/login', [UserController::class, 'login'])->name('login');


// util routes
Route::get('/utilities/users', [UserController::class, 'showUsers']);

Route::post('/users/register', [UserController::class, 'register'])->name('users');