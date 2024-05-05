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
                {{-- Nama --}}
                <label for="nama" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nama <span class="text-red-500">*</span></label>
                <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nama warga" required />
                {{-- Tempat Lahir --}}
                <label for="tempat_lahir" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tempat Lahir" required />
                {{-- Tanggal Lahir --}}
                <label for="tanggal_lahir" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Tanggal Lahir" required />
                {{-- Jenis Kelamin --}}
                <label for="jenis_kelamin" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " required>
                    <option value="laki_laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                {{-- Alamat KTP --}}
                <label for="alamat_ktp" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat KTP <span class="text-red-500">*</span></label>
                <input type="text" name="alamat_ktp" id="alamat_ktp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Alamat KTP" required></input>
                {{-- Alamat Domisili --}}
                <label for="alamat_domisili" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat Domisili <span class="text-red-500">*</span></label>
                <input type="text" name="alamat_domisili" id="alamat_domisili" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Alamat Domisili" required></input>
                {{-- Rt & RW--}}
                <input type="hidden" name="rw" value="6" />
                <label for="rt" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">RT Domisili <span class="text-red-500">*</span></label>
                <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan nomer Rt" required />
                {{-- Agama --}}
                <label for="agama" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Agama <span class="text-red-500">*</span></label>
                <input type="text" name="agama" id="agama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Agama Warga" required />
                {{-- Golongan Darah --}}
                {{-- Tidak required incase warganya lupa/tdk pernah cek --}}
                <label for="gol_darah" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Golongan Darah <span class="text-red-500">*</span></label>
                <input type="text" name="gol_darah" id="gol_darah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Golongan Darah Warga"/>
                {{-- No telpon --}}
                <label for="no_telp" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nomor telepon <span class="text-red-500">*</span></label>
                <div class="flex">
                    <span class="text-gray-500 mr-2">+62</span>
                    <input type="tel" name="no_telp" id="no_telp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan nomor telepon"/>
                </div>
                {{-- Pekerjaan --}}
                {{-- Tidak required untuk yg belum berkja --}}
                <label for="pekerjaan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Pekerjaan <span class="text-red-500">*</span></label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Pekerjaan Warga" required/>
                <div id="pekerjaError" class="hidden col-span-2 text-red-500 text-sm">Isi dengan "Tidak bekerja" jika belum bekerja</div>
                {{-- Status Data --}}
                <input type="hidden" name="status_data" value="Aktif" />
                {{-- Status Penduduk --}}
                <label for="status_penduduk" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Status Penduduk <span class="text-red-500">*</span></label>
                <select name="status_penduduk" id="status_penduduk" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " required>
                    <option value="Tetap">Tetap</option>
                    <option value="Sementara">Sementara</option>
                </select>
                <!-- Other form inputs here -->
                <div class="flex justify-between col-span-2">
                    <a href="{{ url('penduduk') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
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
    
    document.getElementById('pekerjaan').addEventListener('input', function() {
        var pekerjaanInput = this.value;
        var pekerjaError = document.getElementById('pekerjaError');
        
        if (pekerjaanInput.length !== 16) {
            pekerjaError.classList.remove('hidden');
        } else {
            pekerjaError.classList.add('hidden');
        }
    });
    // Script upload indicator
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
