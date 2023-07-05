<?php

use App\Modules\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user/admin', [UserController::class, 'admin'])->middleware(['isloggedin:SUPERADMIN', 'menugen']);
Route::get('/user/admin/tambah', [UserController::class, 'showAdminAdd'])->middleware(['isloggedin:SUPERADMIN', 'menugen']);
Route::get('/user/admin/edit/{id}', [UserController::class, 'showAdminEdit'])->middleware(['isloggedin:SUPERADMIN', 'menugen']);
Route::get('/user/admin/delete/{id}', [UserController::class, 'deleteAdmin'])->middleware(['isloggedin:SUPERADMIN']);

Route::get('/user/wajib-pajak', [UserController::class, 'wajibPajak'])->middleware(['isloggedin:SUPERADMIN,ADMIN', 'menugen']);
Route::get('/user/wajib-pajak/tambah', [UserController::class, 'showWajibPajakAdd'])->middleware(['isloggedin:SUPERADMIN,ADMIN', 'menugen']);
Route::get('/user/wajib-pajak/edit/{id}', [UserController::class, 'showWajibPajakEdit'])->middleware(['isloggedin:SUPERADMIN,ADMIN', 'menugen']);
Route::get('/user/wajib-pajak/delete/{id}', [UserController::class, 'deleteWajibPajak'])->middleware(['isloggedin:SUPERADMIN,ADMIN']);