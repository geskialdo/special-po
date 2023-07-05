<?php

use App\Modules\Dashboard\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);

// Route::get('/dashboard/pengaturan', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);

// Route::get('/objek-pajak', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);

// Route::get('/badges', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);
// Route::get('/badges/edit', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);

// Route::get('/alerts', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);
// Route::get('/alerts/edit', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);


// Route::get('/normal-tables', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);
// Route::get('/normal-tables/edit', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);

// Route::get('/datatables', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);
// Route::get('/datatables/edit', [DashboardController::class, 'index'])->middleware(['isloggedin', 'menugen']);

// Route::domain('{account}.example.com')->group(function () {
//     Route::get('/user/{id}', function (string $account, string $id) {
//         // ...
//     });
// });

// Route::prefix('admin')->group(function () {
//     Route::get('/users', function () {
//         // Matches The "/admin/users" URL
//     });
// });

// Route::get('/posts/{post:slug}', function () {

// });