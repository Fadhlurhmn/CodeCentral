<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengumumanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Pengumuman',
            'list' => ['Home', 'Pengumuman']
        ];

        $page = (object)[
            'title' => 'Daftar pengumuman dipublish'
        ];

        $activeMenu = 'pengumuman';

        return view('pengumuman', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function list()
    {
        // data dummy buat testing tabel, silahkan ngikut jobsheet buat ambil data pake select
        $pengumuman = [
            [
                'id_pengumuman' => '1',
                'judul_pengumuman' => 'Lorem ipsum dolor sit amet.',
                'created_at' => '30/04/2024'
            ],
            [
                'id_pengumuman' => '2',
                'judul_pengumuman' => 'Lorem ipsum dolor sit amet.',
                'created_at' => '31/04/2024'
            ],
        ];

        // buat testing tabel, pakai yang bawah aja
        return DataTables::of($pengumuman)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengumuman) {
                $btn = '<a href="' . url('/pengumuman/1/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></i></a> ';
                $btn .= '<a href="' . url('/pengumuman/1/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);


            // logic yang fix dipake, karena kalo pake data dummy ada error baca id_pengumuman
        // return DataTables::of($pengumuman)
        //     ->addIndexColumn()
        //     ->addColumn('aksi', function ($pengumuman) {
        //         $btn = '<a href="' . url('/pengumuman/' . $pengumuman->id_pengumuman . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></i></a> ';
        //         $btn .= '<a href="' . url('/pengumuman/' . $pengumuman->id_pengumuman . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
        //         return $btn;
        //     })
        //     ->rawColumns(['aksi'])
        //     ->make(true);
    }

    public function create()
    {
        // belum ada pemanggilan model pengumuman, silahkan ditambahkan

        $breadcrumb = (object)[
            'title' => 'Tambah Pengumuman',
            'list' => ['Home', 'Pengumuman', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Pengumuman baru'
        ];
       
        $activeMenu = 'pengumuman';

        // bila sudah ada model pengumuman, tambah variabel yg nyimpen data pengumuman ke bawah ini
        return view('admin.pengumuman.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        // tgs wahyudi, store itu habis create disimpen ke database
    }
    public function show(string $id)
    {
        // data dummy, buat percobaan, variabel $pengumuman boleh dipake buat ngisi dari database
        $pengumuman = (object)[
            'judul_pengumuman' => 'Lorem ipsum dolor sit amet consectetur',
            'deskripsi' => '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed impedit fugit molestiae ratione corrupti, vitae ad magnam sint. Ullam, corrupti.</p>
            <br><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate aut alias aliquam corporis ducimus fugiat excepturi exercitationem sit esse unde. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus sapiente saepe consequuntur nihil minus! Qui corporis animi perspiciatis dolores cupiditate distinctio odio rem sequi hic explicabo odit totam inventore ipsam, repudiandae aliquam ab velit sapiente reprehenderit dicta quod quis deserunt!</p>', 
            'created_at' => '31-04-2024',
            'lampiran' => asset('img/user2.jpg')
        ];
        

        // belum ada pemanggilan model pengumuman, silahkan ditambahkan

        $breadcrumb = (object)[
            'title' => 'Preview Pengumuman',
            'list' => ['Home', 'Pengumuman', 'Preview']
        ];

        $page = (object)[
            'title' => 'Preview pengumuman'
        ];

        $activeMenu = 'pengumuman'; 

        // bila sudah ada model pengumuman, tambah variabel yg nyimpen data pengumuman ke bawah ini
        return view('admin.pengumuman.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'pengumuman' => $pengumuman]);
    }
    public function edit(string $id)
    {
        // data dummy, buat percobaan, variabel $pengumuman boleh dipake buat ngisi dari database
        $pengumuman = (object)[
            'judul_pengumuman' => 'Lorem ipsum dolor sit amet consectetur',
            'deskripsi' => '<p>Nama Saya Manusia</p><p>&nbsp;</p><p>Saya manusia, saya suka makan, tidur, dan lain hal.</p><p><strong>Terkadang</strong></p><p>&nbsp;</p><p><i>Apabila</i></p>',
            'created_at' => '31-04-2024',
            'lampiran' => asset('img/user2.jpg')
        ];

        // belum ada pemanggilan model pengumuman, silahkan ditambahkan

        $breadcrumb = (object) [
            'title' => 'Edit Pengumuman',
            'list' => ['Home', 'Pengumuman', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit pengumuman'
        ];

        $activeMenu = 'pengumuman'; 

         // bila sudah ada model pengumuman, tambah variabel yg nyimpen data pengumuman ke bawah ini
        return view('admin.pengumuman.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'pengumuman' => $pengumuman]);
    }
    
    public function update(Request $request, string $id)
    {
       // tgs wahyudi, habis edit disimpen ke database
    }
}
