<?php

namespace App\Http\Controllers;

use App\Models\PengumumanModel;
use Illuminate\Http\Request;
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
            $pengumuman = PengumumanModel::with('user')->where('judul_pengumuman', 'like', "%$query%")->get();
        } else {
            $pengumuman = PengumumanModel::with('user')->get();
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
        'judul_pengumuman' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'thumbnail' => 'required|image|max:2048'
    ]);

    // menyimpan data foto ktp yang diupload ke variabel foto_ktp
    $thumbnail = $request->file('thumbnail');

    $nama_file = time() . "_" . $thumbnail->getClientOriginalName();

    // isi dengan nama folder tempat kemana file diupload
    $tujuan_upload = 'pengumuman_thumbnail';
    $thumbnail->move($tujuan_upload, $nama_file);

    PengumumanModel::create([
        'id_user' => Auth::user()->id_user,
        'judul_pengumuman' => $request->judul_pengumuman,
        'deskripsi' => $request->deskripsi,
        'thumbnail' => $nama_file
    ]);

    return redirect('admin/pengumuman/')->with('success', 'Pengumuman berhasil ditambahkan');
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_pengumuman' => 'required|string',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        $pengumuman = PengumumanModel::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $nama_file = time() . "_" . $thumbnail->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'pengumuman_thumbnail';
            $thumbnail->move($tujuan_upload, $nama_file);

            // Update the pengumuman with the new thumbnail
            $pengumuman->update([
                'id_user' => Auth::user()->id_user,
                'judul_pengumuman' => $request->judul_pengumuman,
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $nama_file
            ]);
        } else {
            // Update the pengumuman without changing the thumbnail
            $pengumuman->update([
                'id_user' => Auth::user()->id_user,
                'judul_pengumuman' => $request->judul_pengumuman,
                'deskripsi' => $request->deskripsi
            ]);
        }

        return redirect('admin/pengumuman/')->with('success', 'Pengumuman berhasil diubah');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = pathinfo($originName, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;

            $path = $request->file('upload')->storeAs('public/pengumuman_gambar', $fileName);

            $url = asset('storage/pengumuman_gambar/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
