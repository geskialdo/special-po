<?php

use App\Modules\Login\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->middleware('isloggedout');

Route::get('/register', [LoginController::class, 'register'])->middleware('isloggedout');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('isloggedin');

Route::post('/login', [LoginController::class, 'authenticate'])->middleware('isloggedout');