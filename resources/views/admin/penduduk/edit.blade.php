@include('base.start')

@include('base.navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">{{ $breadcrumb->title }}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">

            @if(!$penduduk)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('penduduk') }}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            <form class="px-10 py-10 min-w-full bg-white max-w-3xl grid grid-cols-2 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('penduduk/' . $penduduk->id_penduduk) }}" method="POST">
                <h1 class="p-5 mb-5 font-semibold text-left rtl:text-right text-gray-900 bg-teal-400 col-span-2 rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                @method('POST')
                <div class="relative z-0 w-full mb-5 group">
                    <label for="nik">NIK</label>
                    <input type="number" name="nik" id="nik" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="NIK Sebelumnya" value="{{ $penduduk->nik }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="Nama Sebelumnya" value="{{ $penduduk->nama }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group col-span-2">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="Alamat Sebelumnya" value="{{ $penduduk->alamat }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="rt">Rt</label>
                    <input type="text" name="rt" id="rt" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="rt" value="{{ $penduduk->rt}}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="rw">Rw</label>
                    <input type="text" name="rw" id="rw" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="rw" value="{{ $penduduk->rw}}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="tempat_lahir">Tempat lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="tempat_lahir" value="{{ $penduduk->tempat_lahir }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="tanggal_lahir">Tanggal lahir</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="tanggal_lahir" value="{{ $penduduk->tanggal_lahir }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="gol_darah">Golongan darah</label>
                    <input type="text" name="gol_darah" id="gol_darah" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="Golongan Darah" value="{{ $penduduk->gol_darah}}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="agama">Agama</label>
                    <input type="text" name="agama" id="agama" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="agama" value="{{ $penduduk->agama}}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="no_telp">No Telp</label>
                    <input type="text" name="no_telp" id="no_telp" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="no_telp sebelumnya" value="{{ $penduduk->no_telp }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="pekerjaan" value="{{ $penduduk->pekerjaan}}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="status_data">status_data</label>
                    {{-- <input type="text" name="status_data" id="status_data" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="Status Data sebelumnya" value="{{ $penduduk->status_data}}" required /> --}}
                    <select name="status_data" id="status_data" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100">
                        <option value="{{$penduduk->status_data}}">{{$penduduk->status_data}}</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak aktif">Tidak aktif</option>
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="status_penduduk">Status Penduduk</label>
                    {{-- <input type="text" name="status_penduduk" id="status_penduduk" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="Status penduduk" value="{{ $penduduk->status_penduduk}}" required /> --}}
                    <select name="status_penduduk" id="status_penduduk" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100">
                        <option value="{{$penduduk->status_penduduk}}">{{$penduduk->status_penduduk}}</option>
                        <option value="Tetap">Tetap</option>
                        <option value="Sementara">Sementara</option>
                        <option value="Pindah">Pindah</option>
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group col-span-2">
                    <label for="id_keluarga">ID Keluarga</label>
                    <input type="text" name="id_keluarga" id="id_keluarga" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="id_keluarga" value="{{ $penduduk->id_keluarga}}" required />
                </div>
                <!-- Other form inputs here -->
                <div class="flex justify-between">
                    <a href="{{ url('penduduk') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>

@include('base.end')
