<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BansosController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial',
            'list' => ['Home','Penerima Bantuan Sosial']
        ];

        $page = (object)[
            'title' => 'Daftar Penerima Bantuan Sosial'
        ];

        $activeMenu = 'bansos';

        return view('admin.bansos.bansos', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
        $bansos = 
    }
}
