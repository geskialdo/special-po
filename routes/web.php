<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('views.welcome');
// });

Route::get('/makehash/{plaintext}', function ($plaintext) {
    return Hash::make($plaintext);
});


$module_path = base_path('app/Modules');

if (is_dir($module_path)) {
    $route_files = glob($module_path . '/*/web.php');
    foreach ($route_files as $file) {
        try {
            require_once($file);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}