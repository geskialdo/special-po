<?php

use App\Modules\Bphtb\Http\Controllers\BphtbController;
use Illuminate\Support\Facades\Route;

Route::get('/bphtb', [BphtbController::class, 'index'])->middleware(['isloggedin:WAJIB PAJAK', 'menugen']);
Route::get('/bphtb/tambah', [BphtbController::class, 'showAdd'])->middleware(['isloggedin:WAJIB PAJAK', 'menugen']);
Route::get('/bphtb/edit/{id}', [BphtbController::class, 'showEdit'])->middleware(['isloggedin:WAJIB PAJAK', 'menugen']);
Route::get('/bphtb/delete/{id}', [BphtbController::class, 'delete'])->middleware(['isloggedin:WAJIB PAJAK']);