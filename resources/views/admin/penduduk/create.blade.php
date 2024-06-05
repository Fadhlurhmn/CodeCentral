<style>
    /* For WebKit browsers (Chrome, Safari) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
    }
    
    /* For Firefox */
    .custom-scrollbar {
        scrollbar-width: none;  /* Remove scrollbar space */
        -ms-overflow-style: none;  /* IE and Edge */
    }
    
    /* To make sure the custom-scrollbar class is applied properly */
    .custom-scrollbar {
        overflow-y: auto;
    }
</style>

@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        
        <div class="p-5 flex flex-col">
            @include('layout.breadcrumb2')
        </div>

        <div class="w-full h-screen min-w-max p-5 overflow-y-auto custom-scrollbar">

            <form class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/penduduk') }}" method="POST" enctype="multipart/form-data">
                <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-4">
                    Isi data penduduk
                </h1>
                @csrf
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
                {{-- NIK --}}
                <label for="nik" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">NIK <span class="text-red-500">*</span></label>
                <input type="number" name="nik" id="nik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan NIK" value="{{ old('nik') }}" required />
                <div id="nikError" class="hidden col-span-4 text-red-500 text-xs">NIK harus diisi dengan 16 karakter</div>
                <div class="relative col-span-2 w-full h-full rounded-lg transition duration-300 ease-in-out mt-2">
                    <input type="file" name="foto_ktp" id="foto_ktp" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" value="{{old('foto_ktp')}}" required />
                    <label for="foto_ktp" class="text-xs font-medium cursor-pointer text-white text-center py-2 px-4 bg-teal-500 rounded-lg hover:bg-teal-600 transition duration-300 ease-in-out">
                        Submit Foto KTP (Max ukuran 2MB)
                    </label>
                    <span id="file-name" class="text-xs text-gray-700 mt-2 block"></span>
                </div>
                <div id="uploadIndicator_foto" class="hidden col-span-4">
                    <!-- Contoh: ikon atau pesan teks -->
                    <span class="text-green-500 text-sm">Gambar Terunggah</span>
                </div>
                {{-- Nama --}}
                <label for="nama" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nama warga" value="{{ old('nama') }}" required />
                {{-- Tempat Lahir --}}
                <label for="tempat_lahir" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" value="{{old('tempat_lahir')}}" required />
                {{-- Tanggal Lahir --}}
                <label for="tanggal_lahir" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tanggal Lahir" value="{{old('tanggal_lahir')}}" required />
                {{-- Jenis Kelamin --}}
                <label for="jenis_kelamin" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Jenis Kelamin <span class="text-red-500">*</span></label>
                <div class="col-span-4">
                    <label class="text-xs bg-gray-50 border inline-flex items-center mr-3 p-3 rounded-lg">
                        <input type="radio" class="form-radio text-teal-600" name="jenis_kelamin" value="pria" required>
                        <span class="ml-2 text-xs text-gray-900">Pria</span>
                    </label>
                    <label class="text-xs bg-gray-50 border inline-flex items-center mr-3 p-3 rounded-lg">
                        <input type="radio" class="form-radio text-teal-600" name="jenis_kelamin" value="wanita" required>
                        <span class="ml-2 text-xs text-gray-900">Wanita</span>
                    </label>
                </div>
                {{-- Alamat KTP --}}
                <label for="alamat_ktp" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Alamat KTP <span class="text-red-500">*</span></label>
                <input type="text" name="alamat_ktp" id="alamat_ktp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Alamat KTP" value="{{old('alamat_ktp')}}" required></input>
                {{-- Alamat Domisili --}}
                <label for="alamat_domisili" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Alamat Domisili <span class="text-red-500">*</span></label>
                <input type="text" name="alamat_domisili" id="alamat_domisili" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Alamat Domisili" value="{{old('alamat_domisili')}}" required></input>
                {{-- Rt & RW--}}
                <input type="hidden" name="rw" value="1" />
                <label for="rt" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">RT Domisili <span class="text-red-500">*</span></label>
                <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan nomer Rt" value="{{old('rt')}}" required />
                {{-- Agama --}}
                <label for="agama" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Agama <span class="text-red-500">*</span></label>
                <input type="text" name="agama" id="agama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Agama Warga" value="{{old('agama')}}" required />
                {{-- Golongan Darah --}}
                <label for="gol_darah" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Golongan Darah <span class="text-red-500">*</span></label>
                <div class="col-span-4">
                    @foreach(['A', 'B', 'AB', 'O'] as $gol_darah)
                        <label class="text-xs bg-gray-50 border inline-flex items-center mr-3 p-3 rounded-lg">
                            <input type="radio" name="gol_darah" value="{{ $gol_darah }}" class="form-radio h-4 w-4 text-gray-600" {{ old('gol_darah') == $gol_darah ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">{{ $gol_darah }}</span>
                        </label>
                    @endforeach
                </div>
                {{-- No telpon --}}
                <label for="no_telp" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Nomor telepon <span class="text-red-500">*</span></label>
                <div class="flex col-span-4">
                    <span class="text-gray-800 mr-2 pt-2">+62</span>
                    <input type="number" name="no_telp" id="no_telp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 w-full col-span-4 p-2.5 " value="{{old ('no_telp')}}" placeholder="Masukkan nomor telepon"/>
                </div>
                <div id="no_telpError" class="hidden col-span-4 text-red-500 text-xs">Nomor Telpon diisi dengan 11 karakter setlah +62</div>
                {{-- Pekerjaan --}}
                {{-- Tidak required untuk yg belum berkja --}}
                <label for="pekerjaan" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Pekerjaan <span class="text-red-500">*</span></label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " value="{{old ('pekerjaan')}}" placeholder="Pekerjaan Warga" required/>
                <div id="pekerjaError" class="hidden col-span-2 text-red-500 text-xs">Isi dengan "Tidak bekerja" jika belum bekerja</div>
                {{-- Status Data --}}
                <input type="hidden" name="status_data" value="Aktif" />
                {{-- Status Penduduk --}}
                <label for="status_penduduk" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Status Penduduk <span class="text-red-500">*</span></label>
                <select name="status_penduduk" id="status_penduduk" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" required>
                    <option value="Tetap">Tetap</option>
                    <option value="Sementara">Sementara</option>
                </select>
                <!-- Other form inputs here -->
                <div class="flex col-span-2">
                    <a href="{{ url('admin/penduduk') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                </div>
            </form>            
            
        </div>
    </div>
</div>

@include('layout.end')
<script>
    // Script tulisan merah dibawah inputan
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
    
    document.getElementById('pekerjaan').addEventListener('input', function() {
        var pekerjaanInput = this.value;
        var pekerjaError = document.getElementById('pekerjaError');
        
        if (pekerjaanInput.length !== 20) {
            pekerjaError.classList.remove('hidden');
        } else {
            pekerjaError.classList.add('hidden');
        }
    });
    // Script upload indicator
    const foto_ktp = document.getElementById('foto_ktp');
    
    const uploadIndicator_foto = document.getElementById('uploadIndicator_foto');
    foto_ktp.addEventListener('change', function() {
        if (foto_ktp.files.length > 0) {
            uploadIndicator_foto.classList.remove('hidden');
        } else {
            uploadIndicator_foto.classList.add('hidden');
        }
    });

    // Script nomor telepon 
    // Penambahan +62
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
