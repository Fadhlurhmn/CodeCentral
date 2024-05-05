@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
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
            <form class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('penduduk/' . $penduduk->id_penduduk) }}" method="POST">
                <h1 class="px-5 py-7 mb-5 font-semibold text-center text-3xl rtl:text-right text-gray-900 bg-slate-100 border-2 border-teal-500 col-span-4 rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                @method('POST')
                {{-- nik --}}
                    <label for="nik" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">NIK</label>
                    <input type="text" name="nik" id="nik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan NIK warga" value="{{ $penduduk->nik }}" required />
                    <div id="nikError" class="hidden col-span-2 text-red-500 text-sm">NIK harus diisi dengan 16 karakter</div>
                    <div class="relative bg-teal-500 hover:bg-teal-600 col-span-4 rounded-lg transition duration-300 ease-in-out">
                        <input type="file" name="nik_photo" id="nik_photo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" />
                        <label for="nik_photo" class="block text-sm font-medium cursor-pointer text-white py-2 px-4">
                            Submit Foto KTP *jika ada perubahan (Max ukuran 2MB)
                        </label>
                    </div>
                {{-- nama --}}
                    <label for="nama" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nama</label>
                    <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nama warga" value="{{ $penduduk->nama }}" required />            
                {{-- alamat_ktp --}}
                    <label for="alamat_ktp" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat KTP</label>
                    <input type="text" name="alamat_ktp" id="alamat_ktp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat KTP" value="" required />
                {{-- alamat_domisili --}}
                    <label for="alamat_domisili" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat Domisili</label>
                    <input type="text" name="alamat_domisili" id="alamat_domisili" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat Domisili " value="" required />
                {{-- RT --}}
                    <label for="rt" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Rt</label>
                    <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan nomer Rt" value="{{$penduduk->rt}}" required />
                    {{-- RW hidden --}}
                    <input type="hidden" name="rw" value="{{$penduduk->rw}}" required/>
                {{-- tempat_lahir --}}
                    <label for="tempat_lahir" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{$penduduk->tempat_lahir}}" required />
                {{-- tanggal_lahir --}}
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Tanggal Lahir</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{$penduduk->tanggal_lahir}}" required />
                {{-- gol_darah --}}
                    <label for="gol_darah" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Gologan Darah</label>
                    <input type="text" name="gol_darah" id="gol_darah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{$penduduk->gol_darah}}" />
                {{-- agama --}}
                    <label for="agama" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Agama</label>
                    <input type="text" name="agama" id="agama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Agama Warga" value="{{$penduduk->agama}}" required />
                {{-- No telpon --}}
                    <label for="no_telp" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nomor telepon</label>
                    <div class="flex col-span-4">
                        <span class="text-gray-800 mr-2 pt-2">+62</span>
                        <input type="tel" name="no_telp" id="no_telp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan nomor telepon"/>
                    </div>
                {{-- pekerjaan --}}
                    <label for="pekerjaan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Pekerjaan Warga" value="{{$penduduk->pekerjaan}}" required />
                    <div id="pekerjaError" class="hidden col-span-2 text-red-500 text-sm">Isi dengan "Tidak bekerja" jika belum bekerja</div>
                {{-- status penduduk --}}
                    <label for="status_penduduk" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Status Penduduk</label>
                    <select name="status_penduduk" id="status_penduduk" class="block py-2.5 px-2.5 col-span-4 text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-slate-100 focus:bg-slate-100">
                        <option value="{{$penduduk->status_penduduk}}">{{$penduduk->status_penduduk}}</option>
                        <option value="Tetap">Tetap</option>
                        <option value="Sementara">Sementara</option>
                    </select>
                {{-- status data --}}
                    <label for="status_data" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">status_data</label>
                    <select name="status_data" id="status_data" class="block py-2.5 px-2.5 col-span-4 text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-slate-100 focus:bg-slate-100">
                        <option value="{{$penduduk->status_data}}">{{$penduduk->status_data}}</option>                            
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak aktif">Tidak aktif</option>
                    </select>                    
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

@include('layout.end')
<script>
    // script tulisan dibawah input
    document.getElementById('nik').addEventListener('input', function() {
        var nikInput = this.value;
        var nikError = document.getElementById('nikError');
        
        if (nikInput.length !== 16) {
            nikError.classList.remove('hidden');
        } else {
            nikError.classList.add('hidden');
        }
    });
    
    document.getElementById('pekerjaan').addEventListener('input', function() {
        var pekerjaanInput = this.value;
        var pekerjaError = document.getElementById('pekerjaError');
        
        if (pekerjaanInput.length !== 16) {
            pekerjaError.classList.remove('hidden');
        } else {
            pekerjaError.classList.add('hidden');
        }
    });


    // Script upload file
    const nik_photo = document.getElementById('nik_photo');
    
    const uploadIndicator_nik = document.getElementById('uploadIndicator_nik');
    nik_photo.addEventListener('change', function() {
        if (nik_photo.files.length > 0) {mbar
            uploadIndicator_nik.classList.remove('hidden');
        } else {
            uploadIndicator_nik.classList.add('hidden');
        }
    });

    // Script untuk menambahkan awalan +62 pada nomor telepon 
    document.getElementById('no_telp').addEventListener('change', function() {
        var no_telp_input = document.getElementById('no_telp');
        var no_telp_value = no_telp_input.value;

        // Memastikan bahwa nomor telepon dimulai dengan +62
        if (!no_telp_value.startsWith('+62')) {
            no_telp_input.value = '+62' + no_telp_value;
        }
    });
</script>
