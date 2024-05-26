<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
    $breadcrumb = (object)[
        'title' => 'Daftar Pengumuman',
        'list' => [
            ['name' => 'Home', 'url' => url('/admin')],
            ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')]
        ]
    ];

    $page = (object)[
        'title' => 'Daftar pengumuman dipublish'
    ];

    $activeMenu = 'pengumuman';

    $query = $request->input('query');
    if ($query) {
        $pengumuman = PengumumanModel::where('judul_pengumuman', 'like', "%$query%")->get();
    } else {
        $pengumuman = PengumumanModel::all();
    }

    return view('admin.pengumuman.index', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'activeMenu' => $activeMenu,
        'pengumuman' => $pengumuman
    ]);
    }

    public function list()
    {
        $pengumuman = PengumumanModel::select(['id_pengumuman', 'judul_pengumuman', 'created_at']);

        return DataTables::of($pengumuman)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengumuman) {
                $btn = '<a href="' . url('admin/pengumuman/' . $pengumuman->id_pengumuman . '/show') . '" class="btn btn-primary ml-1 flex-col "><i class="fas fa-info-circle"></i></a> ';
                $btn .= '<a href="' . url('admin/pengumuman/' . $pengumuman->id_pengumuman . '/edit') . '" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
{
    $pengumuman = PengumumanModel::all();

    $breadcrumb = (object)[
        'title' => 'Tambah Pengumuman',
        'list' => [
            ['name' => 'Home', 'url' => url('/admin')],
            ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')],
            ['name' => 'Tambah', 'url' => url('admin/pengumuman/create')]
        ]
    ];

    $page = (object)[
        'title' => 'Tambah Pengumuman baru'
    ];

    $activeMenu = 'pengumuman';

    return view('admin.pengumuman.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'pengumuman' => $pengumuman, 'activeMenu' => $activeMenu]);
}

public function store(Request $request)
{
    $request->validate([
        'judul_pengumuman' => 'required|string|max:100',
        'deskripsi' => 'required|string',
        'lampiran' => 'nullable|image|max:2048'
    ]);

    $data = $request->only('judul_pengumuman', 'deskripsi');

    if ($request->hasFile('lampiran')) {
        // Menyimpan file lampiran yang diupload
        $lampiran = $request->file('lampiran');
        $nama_file = time() . "_" . $lampiran->getClientOriginalName();
        $path = $lampiran->storeAs('pengumuman', $nama_file, 'public');
        $data['lampiran'] = $path;
    } else {
        $data['lampiran'] = null; // atau set default gambar jika diperlukan
    }

    $pengumuman = PengumumanModel::create([
        'id_user' => Auth::user()->id,
        'judul_pengumuman' => $data['judul_pengumuman'],
        'deskripsi' => $data['deskripsi'],
        'lampiran' => $data['lampiran'],
    ]);

    return redirect('admin/pengumuman/' . $pengumuman->id . '/show')->with('success', 'Pengumuman berhasil ditambahkan');
}

    public function show($id)
    {
        $pengumuman = PengumumanModel::findOrFail($id);

        $breadcrumb = (object)[
            'title' => 'Preview Pengumuman',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')],
                ['name' => 'Preview', 'url' => url('admin/pengumuman//{id}/show')]
            ]
        ];

        $page = (object)[
            'title' => 'Preview pengumuman'
        ];

        $activeMenu = 'pengumuman';

        return view('admin.pengumuman.show', ['breadcrumb' => $breadcrumb,'page' => $page,'activeMenu' => $activeMenu,'pengumuman' => $pengumuman]);
    }
    public function edit($id)
    {
        $pengumuman = PengumumanModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Edit Pengumuman',
            'list' => [
                ['name' => 'Home', 'url' => url('/admin')],
                ['name' => 'Pengumuman', 'url' => url('admin/pengumuman')],
                ['name' => 'Edit', 'url' => url('admin/pengumuman//{id}/edit')]
            ]
        ];

        $page = (object) [
            'title' => 'Edit pengumuman'
        ];

        $activeMenu = 'pengumuman';

        return view('admin.pengumuman.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'pengumuman' => $pengumuman]);
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'judul_pengumuman' => 'required|string|max:255',
    //         'deskripsi' => 'required|string',
    //         'lampiran' => 'nullable|image|max:2048'
    //     ]);

    //     $pengumuman = PengumumanModel::findOrFail($id);
    //     $data = $request->only('judul_pengumuman', 'deskripsi');

    //     if ($request->hasFile('lampiran')) {
    //         if ($pengumuman->lampiran) {
    //             \Storage::delete('public/' . $pengumuman->lampiran);
    //         }
    //         $data['lampiran'] = $request->file('lampiran')->store('pengumuman', 'public');
    //     }

    //     $pengumuman->update($data);

    //     return view('admin.pengumuman.show')->with('success', 'Pengumuman berhasil diubah');
    // }
}
