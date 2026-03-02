<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,HomeController,DincharyaController};

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('pages.home');
// });

Route::get('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/registration', [AuthController::class, 'Registration'])->name('registration');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dincharya', [DincharyaController::class, 'index'])->name('dincharya');
