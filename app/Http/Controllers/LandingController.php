<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanModel;
use Illuminate\Routing\Controller;

class LandingController extends Controller
{
    // public function getPengumumanLandingContent()
    // {
    //     return PengumumanModel::orderBy('updated_at', 'desc')->take(4)->get();
    // }
    
    // public function getBansosLandingContent()
    // {
    //     return BansosModel::orderBy('updated_at', 'desc')->take(5)->get();
    // }
    
    // public function getUmkmLandingContent()
    // {
    //     return UmkmModel::orderBy('updated_at', 'desc')->take()->get();
    // }

    public function index()
    {
        $activeMenu = 'Home';
        // $pengumuman = $this->getPengumumanLandingContent();
        // $bansos = $this->getBansosLandingContent();
        // $umkm = $this->getUmkmLandingContent();
        
        $pengumuman = (object)[
            (object)[
                'id_pengumuman' => '1',
                'id_user' => '1',
                'judul_pengumuman' => 'Mari Membuat Anak',
                'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
                'gambar' => 'user2.jpg',
                'created_at' => '12-12-2012',
                'updated_at' => '13-12-2012',
            ],
            (object)[
                'id_pengumuman' => '2',
                'id_user' => '1',
                'judul_pengumuman' => 'Mari Membuat Anak2',
                'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
                'gambar' => 'user2.jpg',
                'created_at' => '12-12-2012',
                'updated_at' => '13-12-2012',
            ],
            (object)[
                'id_pengumuman' => '3',
                'id_user' => '1',
                'judul_pengumuman' => 'Mari Membuat Anak3',
                'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
                'gambar' => 'user2.jpg',
                'created_at' => '12-12-2012',
                'updated_at' => '13-12-2012',
            ],
            (object)[
                'id_pengumuman' => '4',
                'id_user' => '1',
                'judul_pengumuman' => 'Mari Membuat Anak4',
                'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
                'gambar' => 'user1.jpg',
                'created_at' => '12-12-2012',
                'updated_at' => '13-12-2012',
            ],
        ];

        $firstPengumuman = (object)[
            'id_pengumuman' => '1',
            'id_user' => '1',
            'judul_pengumuman' => 'Mari Membuat Anak',
            'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
            'gambar' => 'user2.jpg',
            'created_at' => '12-12-2012',
            'updated_at' => '13-12-2012',
        ];

        // bansos unsure
        // $bansos = [
        //     [

        //     ]
        // ];

        $umkm = (object)[
            (object)[
                'id_umkm' => '1',
                'id_keluarga' => '1',
                'nama_usaha' => 'Toko Anak Pak Budi',
                'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
                'gambar' => 'user3.jpg',
                'status_pengajuan' => 'aktif',
                'alamat' => 'jalan sama ayang',
                'countdown' => '14-12-2012',
                'created_at' => '12-12-2012',
                'updated_at' => '13-12-2012',
            ],
            (object)[
                'id_umkm' => '2',
                'id_keluarga' => '1',
                'nama_usaha' => 'Toko Anak Pak Budi2',
                'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
                'gambar' => 'user3.jpg',
                'status_pengajuan' => 'aktif',
                'alamat' => 'jalan sama ayang',
                'countdown' => '14-12-2012',
                'created_at' => '12-12-2012',
                'updated_at' => '13-12-2012',
            ],
            (object)[
                'id_umkm' => '3',
                'id_keluarga' => '1',
                'nama_usaha' => 'Toko Anak Pak Budi3',
                'deskripsi' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ipsam, voluptates deserunt, provident tempore maxime assumenda quod consequatur iusto ut id velit reprehenderit.</p><p>Quod, rerum voluptatem? Distinctio facere id beatae esse officiis dolorum ut cupiditate illo harum consequatur odit quis minima eos quaerat natus, dolorem ipsa repellat expedita enim voluptate.</p>',
                'gambar' => 'user1.jpg',
                'status_pengajuan' => 'aktif',
                'alamat' => 'jalan sama ayang',
                'countdown' => '14-12-2012',
                'created_at' => '12-12-2012',
                'updated_at' => '13-12-2012',
            ],
        ];

        return view('index', ['activeMenu' => $activeMenu, 'pengumuman' => $pengumuman, 'firstPengumuman' => $firstPengumuman, 'umkm' => $umkm]);
    }
}
