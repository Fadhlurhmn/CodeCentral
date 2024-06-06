<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
            ]
        ];
        $activeMenu = 'dashboard';

        return view('admin.index',['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }


    public function index_rt()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/rt')],
            ]
        ];

        $activeMenu = 'dashboard';

        return view('rt.index',['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }

    public function index_rw(){
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                ['name' => 'Home', 'url' => url('/rw')],
            ]
        ];

        $activeMenu = 'dashboard';

        return view('rw.index',['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
