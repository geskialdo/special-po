<?php

namespace App\Modules\Bphtb\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BphtbController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['title'] = 'BPHTB';
        return view('Modules.Bphtb.Views.bphtb', $data);
    }

    public function showAdd(Request $request)
    {
        $data = [];
        $data['title'] = 'Tambah BPHTB';
        return view('Modules.Bphtb.Views.bphtb_add', $data);
    }

    public function showEdit(Request $request, $id)
    {
        $data = [];
        $data['title'] = 'Tambah BPHTB';
        $data['id'] = $id;
        return view('Modules.Bphtb.Views.bphtb_edit', $data);
    }

    public function delete(Request $request, $id)
    {
        return 'hapus bphtb ' . $id;
    }
}