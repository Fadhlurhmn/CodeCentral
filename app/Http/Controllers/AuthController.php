<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        // kita ambil data user lalu simpan pada variable $user
        $user = Auth::user();

        // kondisi jika user nya ada
        if ($user) {
            // jika user nya memiliki level admin
            if ($user->id_level == '1'){
                return redirect()->intended('admin');
            }
            // jika user nya memiliki level manager
            else if ($user->id_level == '2') {
                return redirect()->intended('rw');
            } 
            else if ($user->id_level == '3') {
                return redirect()->intended('rt');
            } 
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        // validasi saat tombol login di klik
        // validasi pengisian username dan pass yg wajib
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // ambil data request username dan pass saja
        $credential = $request->only('username', 'password');

        // cek jika data username dan pass valid dengan data
        if (Auth::attempt($credential)){
            $user = Auth::user();

            // cek level
            if ($user->id_level == '1'){
                return redirect()->intended('admin');
            }
            else if ($user->id_level == '2') {
                return redirect()->intended('rw');
            } 
            else if ($user->id_level == '3') {
                return redirect()->intended('rt');
            } 
            // jika belum ada role maka ke /
            return redirect()->intended('/');
        }   
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukkan sudah benar']);
    }

    public function register()
    {
        return view('register');
    }

    public function proses_register(Request $request)
    {
        // validasi data input register
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:m_user',
            'password' => 'required',
        ]);

        // apabila gagal register akan muncul pesan error
        if ($validator->fails()){
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        // apabila berhasil isi level & hash
        $request['id_level'] = '2';
        $request['password'] = Hash::make($request->password);

        // masukkan semua data pada req ke table user
        UserModel::create($request->all());

        // apabila berhasil akan diarahkan ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        // menghapus session saat logout
        $request->session()->flush();
        
        Auth::logout();
        return redirect('login');
    }

}
