<?php

use App\Modules\Landingpage\Http\Controllers\LandingpageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingpageController::class, 'index']);