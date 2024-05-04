@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">{{$page->title}}</h1>
        </div>
        <div class="w-full h-screen min-w-max p-5 shadow overflow-y-scroll">
            <form class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('penduduk') }}" method="POST" enctype="multipart/form-data">
                <h1 class="px-5 py-7 mb-5 font-semibold text-center text-3xl rtl:text-right text-gray-900 bg-slate-100 border-2 border-teal-500 col-span-4 rounded-lg">
                    Isi Data Penduduk
                </h1>
                @csrf
                {{-- NIK --}}
                <label for="nik" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" id="nik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan NIK" required />
                <div id="nikError" class="hidden col-span-2 text-red-500 text-sm">NIK harus diisi dengan 16 karakter</div>
                <div class="relative bg-teal-500 hover:bg-teal-600 col-span-4 rounded-lg transition duration-300 ease-in-out">
                    <input type="file" name="nik_photo" id="nik_photo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" required />
                    <label for="nik_photo" class="block text-sm font-medium cursor-pointer text-white py-2 px-4">
                        Submit Foto KTP (Max ukuran 2MB)
                    </label>
                </div>
                <div id="uploadIndicator_nik" class="hidden col-span-2">
                    <!-- Contoh: ikon atau pesan teks -->
                    <span class="text-green-500">Gambar Terunggah</span>
                </div>
                {{-- No KK --}}
                <label for="no_kk" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">No KK <span class="text-red-500">*</span></label>
                <input type="text" name="no_kk" id="no_kk" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nomor KK" required />
                <div id="kk_Error" class="hidden col-span-2 text-red-500 text-sm">No KK harus diisi dengan 16 karakter</div>
                <div class="relative bg-teal-500 hover:bg-teal-600 col-span-4 rounded-lg transition duration-300 ease-in-out">
                    {{-- Tempat Submit Foto untuk No KK (max ukuran 2MB) --}}
                    <input type="file" name="kk_photo" id="kk_photo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" required />
                    <label for="kk_photo" class="block text-sm font-medium cursor-pointer text-white py-2 px-4">
                        Submit Foto KK (Max ukuran 2MB)
                    </label>
                </div>
                <div id="uploadIndicator_kk" class="hidden col-span-2">
                    <!-- Contoh: ikon atau pesan teks -->
                    <span class="text-green-500">Gambar Terunggah</span>
                </div>
                {{-- Nama --}}
                <label for="nama" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nama warga" required />
                {{-- Tempat Lahir --}}
                <label for="tempat_lahir" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" required />
                {{-- Tanggal Lahir --}}
                <label for="tanggal_lahir" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tanggal Lahir" required />
                {{-- Peran dalam Keluarga --}}
                <label for="peran_keluarga" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Peran dalam Keluarga <span class="text-red-500">*</span></label>
                <select name="peran_keluarga" id="peran_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " required>
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Anggota Keluarga">Anggota Keluarga</option>
                </select>
                {{-- Alamat KTP --}}
                <label for="alamat_ktp" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat KTP <span class="text-red-500">*</span></label>
                <input type="text" name="alamat_ktp" id="alamat_ktp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Alamat KTP" required></input>
                {{-- Alamat Kota --}}
                <label for="kota" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat Kota / Kab (KTP) <span class="text-red-500">*</span></label>
                <input type="text" name="kota" id="kota" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Kota/Kab" required></input>
                {{-- Alamat Domisili --}}
                <label for="alamat_domisili" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat Domisili <span class="text-red-500">*</span></label>
                <input type="text" name="alamat_domisili" id="alamat_domisili" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Alamat Domisili" required></input>
                {{-- Rt & RW--}}
                <input type="hidden" name="rw" value="6" />
                <label for="rt" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">RT Domisili <span class="text-red-500">*</span></label>
                <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan nomer Rt" required />
                {{-- Golongan Darah --}}
                <label for="gol_darah" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Golongan Darah <span class="text-red-500">*</span></label>
                <input type="text" name="gol_darah" id="gol_darah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Golongan Darah Warga" required />
                {{-- Pekerjaan --}}
                <label for="pekerjaan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Pekerjaan <span class="text-red-500">*</span></label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Pekerjaan Warga" required />
                {{-- Agama --}}
                <label for="agama" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Agama <span class="text-red-500">*</span></label>
                <input type="text" name="agama" id="agama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Agama Warga" required />
                {{-- Status Data --}}
                <label for="status_data" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Status Data <span class="text-red-500">*</span></label>
                <select name="status_data" id="status_data" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
                {{-- Status Penduduk --}}
                <label for="status_penduduk" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Status Penduduk <span class="text-red-500">*</span></label>
                <select name="status_penduduk" id="status_penduduk" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " required>
                    <option value="Tetap">Tetap</option>
                    <option value="Sementara">Sementara</option>
                </select>
                <!-- Other form inputs here -->
                <div class="flex justify-between col-span-2">
                    <a href="{{ url('penduduk') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                </div>
            </form>            
            
        </div>
    </div>
</div>

@include('layout.end')
<script>
    document.getElementById('nik').addEventListener('input', function() {
        var nikInput = this.value;
        var nikError = document.getElementById('nikError');
        
        if (nikInput.length !== 16) {
            nikError.classList.remove('hidden');
        } else {
            nikError.classList.add('hidden');
        }
    });
    document.getElementById('no_kk').addEventListener('input', function() {
        var nikInput = this.value;
        var nikError = document.getElementById('kk_Error');
        
        if (nikInput.length !== 16) {
            nikError.classList.remove('hidden');
        } else {
            nikError.classList.add('hidden');
        }
    });


     // Dapatkan elemen input file
     const nik_photo = document.getElementById('nik_photo');
     const kk_photo = document.getElementById('kk_photo');
    // Dapatkan elemen untuk menampilkan visualisasi unggah gambar
    const uploadIndicator_nik = document.getElementById('uploadIndicator_nik');
    const uploadIndicator_kk = document.getElementById('uploadIndicator_kk');

    // Tambahkan event listener untuk perubahan pada input file
    nik_photo.addEventListener('change', function() {
        // Periksa apakah pengguna telah memilih gambar
        if (nik_photo.files.length > 0) {
            // Tampilkan elemen visualisasi unggah gambar
            uploadIndicator_nik.classList.remove('hidden');
        } else {
            // Sembunyikan elemen visualisasi unggah gambar jika tidak ada gambar yang dipilih
            uploadIndicator_nik.classList.add('hidden');
        }
    });
    kk_photo.addEventListener('change', function() {
        // Periksa apakah pengguna telah memilih gambar
        if (kk_photo.files.length > 0) {
            // Tampilkan elemen visualisasi unggah gambar
            uploadIndicator_kk.classList.remove('hidden');
        } else {
            // Sembunyikan elemen visualisasi unggah gambar jika tidak ada gambar yang dipilih
            uploadIndicator_kk.classList.add('hidden');
        }
    });
</script>
