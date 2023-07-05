<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['title'] = 'Dashboard';
        return view('Modules.Dashboard.Views.dashboard', $data);
    }
    
}