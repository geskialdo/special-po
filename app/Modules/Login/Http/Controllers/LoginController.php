<?php

namespace App\Modules\Login\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Login\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    protected LoginModel $login_model;
    public function __construct()
    {
        $this->login_model = new LoginModel();
    }

    public function index(Request $request)
    {
        return view('modules.login.views.login');
    }

    public function register(Request $request)
    {
        return 'halaman register';
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return response()->redirectTo('/login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $user_raw = $this->login_model->getUserAndRolesByUsername($username);

        if ($user_raw->count() === 0 || !Hash::check($password, $user_raw[0]->password)) {
            return response()->json([
                'message' => 'Kombinasi Username dan Password Anda tidak ditemukan',
                'error' => true
            ], 401);
        }

        $roles = [];
        foreach ($user_raw as $row) {
            $roles[] = trim($row->role);
        }

        $user_raw = $user_raw[0];
        $user = [
            'id_user' => $user_raw->id_user,
            'username' => $user_raw->username,
            'name' => $user_raw->name,
            'roles' => $roles
        ];

        $request->session()->put('user', $user);

        return response()->json([
            'message' => 'Login berhasil, Anda akan dialihkan...',
            'error' => false
        ], 200);
    }
}