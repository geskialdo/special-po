<?php

namespace App\Modules\Landingpage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index(Request $request)
    {
        return view('modules.landingpage.views.home');
    }
}