@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">

        <div class="w-full h-fit min-w-max p-5">
            @include('layout.breadcrumb2')
            @if(!$penduduk)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/penduduk') }}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            <form id="form_penduduk" action="{{ url('admin/penduduk/' . $penduduk->id_penduduk) }}" method="POST" enctype="multipart/form-data">
                <div class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-4 ">
                        {{ $page->title }}
                    </h1>
                    @csrf
                    {{-- @method('PUT') --}}

                    <!-- Display errors -->
                    @if ($errors->any())
                    <div class="col-span-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Ada yang salah!</strong>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    
                    {{-- <input type="hidden" name="foto_ktp_lama" value="{{ $penduduk->foto_ktp }}"> --}}

                    {{-- nik --}}
                    <label for="nik" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">NIK <span class="text-red-500">*</span></label>
                    <input type="number" name="nik" id="nik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan NIK" value="{{ $penduduk->nik }}" required />
                    <div id="nikError" class="hidden col-span-4 text-red-500 text-xs">NIK harus diisi dengan 16 karakter</div>
                    <div class="relative col-span-2 rounded-lg w-full h-full transition duration-300 ease-in-out mt-2">
                        <input type="file" name="foto_ktp" id="foto_ktp" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"/>
                        <label for="foto_ktp" class="text-xs font-medium cursor-pointer text-white text-center py-2 px-4 bg-teal-500 rounded-lg hover:bg-teal-600 transition duration-300 ease-in-out">
                            Submit Foto KTP (Max ukuran 2MB)
                        </label>
                        <span id="file-name" class="text-xs text-gray-700 mt-2 block"></span>
                    </div>
                    <div id="uploadIndicator_foto" class="hidden col-span-4">
                        <!-- Contoh: ikon atau pesan teks -->
                        <span class="text-green-500 text-sm">Gambar Terunggah</span>
                    </div>
                    <div class="mt-3 col-span-4">
                        <p class="text-sm">Foto Sebelumnya : </p>
                        <img src="{{ asset('storage/'. $penduduk->foto_ktp) }}" class="img-thumbnail w-96" />                        
                    </div>
                    {{-- nama --}}
                    <label for="nama" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Nama</label>
                    <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nama warga" value="{{ $penduduk->nama }}" required />
                    {{-- alamat_ktp --}}
                    <label for="alamat_ktp" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Alamat KTP</label>
                    <input type="text" name="alamat_ktp" id="alamat_ktp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat KTP" value="{{ $penduduk->alamat_ktp }}" required />
                    {{-- alamat_domisili --}}
                    <label for="alamat_domisili" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Alamat Domisili</label>
                    <input type="text" name="alamat_domisili" id="alamat_domisili" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat Domisili " value="{{ $penduduk->alamat_domisili }}" required />
                    {{-- RT --}}
                    <label for="rt" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Rt</label>
                    <select name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " required>
                        <option value="{{ $penduduk->rt }}" selected hidden>{{ $penduduk->rt }}</option>
                        @foreach ($level as $rt)
                            @if (strpos($rt->nama_level, 'RT') !== false)
                                <?php $rt_value = str_replace('RT ', '', $rt->nama_level); ?>
                                <option value="{{ $rt_value }}">{{ $rt_value }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{-- RW hidden --}}
                    <input type="hidden" name="rw" value="{{ $penduduk->rw }}" required/>
                    {{-- tempat_lahir --}}
                    <label for="tempat_lahir" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{ $penduduk->tempat_lahir }}" required />
                    {{-- tanggal_lahir --}}
                    <label for="tanggal_lahir" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Tanggal Lahir</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{ $penduduk->tanggal_lahir }}" required />
                    {{-- Jenis Kelamin --}}
                    <label for="jenis_kelamin" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <div class="col-span-4">
                        <label class="text-xs bg-gray-50 border inline-flex items-center mr-3 p-3 rounded-lg">
                            <input type="radio" class="form-radio text-teal-600" name="jenis_kelamin" value="pria" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'pria' ? 'checked' : '' }} required>
                            <span class="ml-2 text-xs text-gray-900">Pria</span>
                        </label>
                        <label class="text-xs bg-gray-50 border inline-flex items-center mr-3 p-3 rounded-lg">
                            <input type="radio" class="form-radio text-teal-600" name="jenis_kelamin" value="wanita" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'wanita' ? 'checked' : '' }} required>
                            <span class="ml-2 text-xs text-gray-900">Wanita</span>
                        </label>
                    </div>
                    {{-- gol_darah --}}
                    <label for="gol_darah" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Golongan Darah</label>
                    <div class="col-span-4">
                        @foreach(['A', 'B', 'AB', 'O'] as $gol_darah)
                            <label class="text-xs bg-gray-50 border inline-flex items-center mr-3 p-3 rounded-lg">
                                <input type="radio" name="gol_darah" value="{{ $gol_darah }}" class="form-radio h-4 w-4 text-gray-600" 
                                    {{ (old('gol_darah') ?? $penduduk->gol_darah) == $gol_darah ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">{{ $gol_darah }}</span>
                            </label>
                        @endforeach
                    </div>
                    {{-- agama --}}
                    <label for="agama" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Agama</label>
                    <input type="text" name="agama" id="agama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Agama Warga" value="{{ $penduduk->agama }}" required />
                    {{-- No telpon --}}
                    <label for="no_telp" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Nomor telepon</label>
                    <div class="flex col-span-4">
                        <span class="text-gray-800 mr-2 pt-2">+62</span>
                        <input type="number" name="no_telp" id="no_telp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 w-full col-span-4 p-2.5 " placeholder="Masukkan nomor telepon" value="{{ $penduduk->no_telp }}"/>
                    </div>
                    <div id="no_telpError" class="hidden col-span-4 text-red-500 text-xs">Nomor Telpon diisi dengan 11 karakter setlah +62</div>
                    {{-- pekerjaan --}}
                    <label for="pekerjaan" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Pekerjaan Warga" value="{{ $penduduk->pekerjaan }}" required />
                    <div id="pekerjaError" class="hidden col-span-2 text-red-500 text-xs">Isi dengan "Tidak bekerja" jika belum bekerja</div>
                    {{-- status penduduk --}}
                    <label for="status_penduduk" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Status Penduduk</label>
                    <select name="status_penduduk" id="status_penduduk" class="block py-2.5 px-2.5 col-span-4 text-xs text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-slate-100 focus:bg-slate-100">
                        {{-- <option value="{{ $penduduk->status_penduduk }}">{{ $penduduk->status_penduduk }}</option> --}}
                        <option value="Tetap">Tetap</option>
                        <option value="Sementara">Sementara</option>
                    </select>
                    {{-- status data --}}
                    <label for="status_data" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">status_data</label>
                    <select name="status_data" id="status_data" class="block py-2.5 px-2.5 col-span-4 text-xs text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-slate-100 focus:bg-slate-100">
                        {{-- <option value="{{ $penduduk->status_data }}">{{ $penduduk->status_data }}</option>                             --}}
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak aktif">Tidak aktif</option>
                    </select>
                    {{-- Submit --}}
                    <div class="flex col-span-2">
                        <a href="{{ url('admin/penduduk') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                    </div>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>

@include('layout.end')
<script>
    // Script untuk mengunggah file menggunakan AJAX
    document.getElementById('form_penduduk').addEventListener('submit', function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Redirect atau tampilkan pesan sukses sesuai kebutuhan
                    window.location.href = '{{ url('admin/penduduk/' . $penduduk->id_penduduk . '/show') }}';
                } else {
                    // Tampilkan pesan error jika ada
                    console.error('Terjadi kesalahan:', xhr.responseText);
                }
            }
        };
        xhr.send(formData);
    });

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

    document.getElementById('no_telp').addEventListener('input', function() {
        var no_telpInput = this.value;
        var no_telpError = document.getElementById('no_telpError');
        
        if (no_telpInput.length !== 11) {
            no_telpError.classList.remove('hidden');
        } else {
            no_telpError.classList.add('hidden');
        }
    });

    const foto_ktp = document.getElementById('foto_ktp');
    
    const uploadIndicator_foto = document.getElementById('uploadIndicator_foto');
    foto_ktp.addEventListener('change', function() {
        if (foto_ktp.files.length > 0) {
            uploadIndicator_foto.classList.remove('hidden');
        } else {
            uploadIndicator_foto.classList.add('hidden');
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


    // Script untuk menambahkan awalan +62 pada nomor telepon 
    document.getElementById('no_telp').addEventListener('change', function() {
        var no_telp_input = document.getElementById('no_telp');
        var no_telp_value = no_telp_input.value;

        // Memastikan bahwa nomor telepon dimulai dengan +62
        if (!no_telp_value.startsWith('62')) {
            no_telp_input.value = '62' + no_telp_value;
        }
    });

    // Script nama gambar
    document.getElementById('foto_ktp').addEventListener('change', function(event) {
        const input = event.target;
        const fileName = input.files[0] ? input.files[0].name : '';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
