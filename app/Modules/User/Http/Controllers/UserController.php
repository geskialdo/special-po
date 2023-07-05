<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin(Request $request)
    {
        $data = [];
        $data['title'] = 'Admin';
        return view('Modules.User.Views.admin', $data);
    }

    public function showAdminAdd(Request $request)
    {
        $data = [];
        $data['title'] = 'Tambah Admin';
        return view('Modules.User.Views.admin_add', $data);
    }

    public function showAdminEdit(Request $request, $id)
    {
        $data = [];
        $data['title'] = 'Edit Admin';
        $data['id'] = $id;
        return view('Modules.User.Views.admin_edit', $data);
    }

    public function deleteAdmin(Request $request, $id)
    {
        return 'delete admin ' . $id;
    }

    public function wajibPajak(Request $request)
    {
        $data = [];
        $data['title'] = 'Wajib Pajak';
        return view('Modules.User.Views.wajib_pajak', $data);
    }

    public function showWajibPajakAdd(Request $request)
    {
        $data = [];
        $data['title'] = 'Tambah Wajib Pajak';
        return view('Modules.User.Views.wajib_pajak_add', $data);
    }

    public function showWajibPajakEdit(Request $request, $id)
    {
        $data = [];
        $data['title'] = 'Edit Wajib Pajak';
        $data['id'] = $id;
        return view('Modules.User.Views.wajib_pajak_edit', $data);
    }

    public function deleteWajibPajak(Request $request, $id)
    {
        return 'delete wajib pajak ' . $id;
    }
}