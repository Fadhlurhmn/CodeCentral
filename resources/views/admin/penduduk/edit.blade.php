@include('layouts.start')

@include('layouts.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layouts.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{ $breadcrumb->title }}</h1>
        </div>
        <div class="w-full h-screen min-w-max p-5 shadow overflow-y-scroll">

            @if(!$penduduk)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('penduduk') }}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            <form class="px-10 py-10 min-w-full bg-white max-w-3xl grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('penduduk/' . $penduduk->id_penduduk) }}" method="POST">
                <h1 class="px-5 pt-12 pb-5 mb-5 font-semibold text-center rtl:text-right text-gray-900 bg-teal-400 col-span-4 rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                @method('POST')
               {{-- nik --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4">
                    <label for="nik" class="block mb-2 text-sm font-bold text-gray-900">NIK</label>
                    <input type="text" name="nik" id="nik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan NIK warga" value="{{ $penduduk->nik }}" required />
                </div>
                {{-- nama --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 ">
                    <label for="nama" class="block mb-2 text-sm font-bold text-gray-900">Nama</label>
                    <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Nama warga" value="{{ $penduduk->nama }}" required />
                </div>
                {{-- alamat --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 flex">
                    <div class="w-2/3 mr-5">
                        <label for="alamat" class="block mb-2 text-sm font-bold text-gray-900">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Alamat warga" value="{{$penduduk->alamat}}" required />
                    </div>
                {{-- RT --}}
                    <div>
                        <label for="rt" class="block mb-2 text-sm font-bold text-gray-900">Rt</label>
                        <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" placeholder="Masukkan nomer Rt" value="{{$penduduk->rt}}" required />
                    </div>
                </div>
                <div class="hidden relative z-0 w-full mb-5 font-bold group col-span-4">
                    <label for="rw">Rw</label>
                    <input type="text" name="rw" id="rw" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="rw" value="{{ $penduduk->rw}}" required />
                </div>
                {{-- tempat_lahir --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 ">
                    <label for="tempat_lahir" class="block mb-2 text-sm font-bold text-gray-900">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{$penduduk->tempat_lahir}}" required />
                </div>
                {{-- tanggal_lahir --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 ">
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-bold text-gray-900">Tanggal Lahir</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{$penduduk->tanggal_lahir}}" required />
                </div>
                {{-- gol_darah --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 ">
                    <label for="gol_darah" class="block mb-2 text-sm font-bold text-gray-900">Gologan Darah</label>
                    <input type="text" name="gol_darah" id="gol_darah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{$penduduk->gol_darah}}" required />
                </div>

                {{-- agama --}}
                 <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 ">
                    <label for="agama" class="block mb-2 text-sm font-bold text-gray-900">Agama</label>
                    <input type="text" name="agama" id="agama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Agama Warga" value="{{$penduduk->agama}}" required />
                </div>

                {{-- no telp --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 ">
                    <label for="no_telp" class="block mb-2 text-sm font-bold text-gray-900">Nomer Telfon</label>
                    <input type="number" name="no_telp" id="no_telp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Nomer Telfon Warga" value="{{$penduduk->no_telp}}" required />
                </div>
                {{-- pekerjaan --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-4 ">
                    <label for="pekerjaan" class="block mb-2 text-sm font-bold text-gray-900">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Pekerjaan Warga" value="{{$penduduk->pekerjaan}}" required />
                </div>
                {{-- status data --}}
                <div class="relative z-0 w-full mb-5 font-bold group col-span-4">
                    <label for="status_data">status_data</label>
                    <select name="status_data" id="status_data" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100">
                        <option value="{{$penduduk->status_data}}">{{$penduduk->status_data}}</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak aktif">Tidak aktif</option>
                    </select>
                </div>
                {{-- status penduduk --}}
                <div class="relative z-0 w-full mb-5 font-bold group col-span-4">
                    <label for="status_penduduk">Status Penduduk</label>
                    <select name="status_penduduk" id="status_penduduk" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100">
                        <option value="{{$penduduk->status_penduduk}}">{{$penduduk->status_penduduk}}</option>
                        <option value="Tetap">Tetap</option>
                        <option value="Sementara">Sementara</option>
                    </select>
                </div>
                {{-- id_keluarga --}}
                <div class="relative z-0 w-full mb-5 font-bold group col-span-4">
                    <label for="id_keluarga">ID Keluarga</label>
                    <input type="text" name="id_keluarga" id="id_keluarga" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="id_keluarga" value="{{ $penduduk->id_keluarga}}" required />
                </div>
                        {{-- Fungsi [id_keluarga] ini gabisa bang (utamakan fungsi ini bisa work!)  --}}
                {{-- <div class="relative z-0 w-full mb-5 group font-bold col-span-4">
                    <select name="id_keluarga" id="id_keluarga" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100">
                        @foreach($keluarga as $keluarga_penduduk)
                            <option value="{{ $keluarga_penduduk->id }}">{{ $keluarga_penduduk->id_keluarga }}</option>
                        @endforeach
                    </select>
                    <label for="id_keluarga" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Id Keluarga</label>                    
                </div> --}}
                {{-- Submit --}}
                <div class="flex justify-between group col-span-2">
                    <a href="{{ url('penduduk') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>

@include('layouts.end')
