@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full h-screen min-w-max p-5 shadow overflow-auto">

            <form class="px-10 py-10 min-w-full bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('keluarga') }}" method="POST">
                <h1 class="px-5 py-7 mb-5 font-semibold text-center text-3xl rtl:text-right text-gray-900 bg-slate-100 border-2 border-teal-500 col-span-4 rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                {{-- Nomor Keluarga --}}
                        <label for="nomor_keluarga" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nomor Keluarga</label>
                        <input type="text" name="nomor_keluarga" id="nomor_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nomor Keluarga" required />
                        <small id="nomor_keluarga_help" class="text-red-500 hidden col-span-4">Nomor keluarga harus terdiri dari 16 digit.</small>
                    
                {{-- Jumlah Kendaraan --}}
                        <label for="jumlah_kendaraan" class="block mb-2 text-sm font-bold text-gray-900">Jumlah Kendaraan</label>
                        <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Jumlah Kendaraan" required />
                
                {{-- Alamat --}}
                    <label for="alamat" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- Kelurahan --}}
                    <label for="kelurahan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kelurahan</label>
                    <input type="text" name="kelurahan" id="kelurahan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- Kecamatan --}}
                    <label for="kecamatan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- Kota --}}
                    <label for="kota" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kota</label>
                    <input type="text" name="kota" id="kota" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- RT --}}
                    <label for="rt" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Rt</label>
                    <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan nomer Rt" value="" required />
                    {{-- RW hidden --}}
                    <input type="hidden" name="rw" value="6" required/>
                
                {{-- Luas Tanah --}}
                        <label for="luas_tanah" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Luas Tanah</label>
                        <input type="number" step="any" name="luas_tanah" id="luas_tanah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Luas Tanah" required />
                
                {{-- Kepala Keluarga --}}
                        <label for="kepala_keluarga" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kepala Keluarga</label>
                        <select name="kepala_keluarga" id="kepala_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Kepala Keluarga" required >
                        {{-- @foreach ($penduduk as $daftarPenduduk)
                        <option value="{{$daftarPenduduk->nik}}">{{$daftarPenduduk->nama}}</option>    
                        @endforeach --}}
                        <option value="">penduduk->nama1</option>
                        <option value="">penduduk->nama1</option>
                        <option value="">penduduk->nama2</option>
                        </select>

                {{-- Anggota Keluarga --}}
                    <div id="anggota-keluarga" class="col-span-4">
                        <!-- Isian untuk anggota keluarga pertama -->
                        <div class="anggota-keluarga col-span-4">
                            <label for="anggota_keluarga_1" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Anggota Keluarga 1</label>
                            <input type="text" name="anggota_keluarga[]" id="anggota_keluarga_1" class="anggota-keluarga-input shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Anggota Keluarga 1" required>
                        </div>
                    </div>
                
                {{-- Jumlah Orang Kerja --}}
                        <label for="jumlah_orang_kerja" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Jumlah Orang Kerja</label>
                        <input type="number" name="jumlah_orang_kerja" id="jumlah_orang_kerja" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Jumlah Orang Kerja" required />
                    
                {{-- Jumlah Tanggungan --}}
                        <label for="jumlah_tanggungan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Jumlah Tanggungan</label>
                        <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Jumlah Tanggungan" required />
                        
                <!-- Other form inputs here -->
                    <div class="flex justify-between group col-span-2">
                        <a href="{{ url('keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
                        <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')
<script>
    document.getElementById("nomor_keluarga").addEventListener("input", function() {
        var input = this.value.trim();
        var isValid = /^\d{16}$/.test(input);
        var errorMessage = document.getElementById("nomor_keluarga_help");

        if (isValid) {
            errorMessage.classList.add("hidden");
        } else {
            errorMessage.classList.remove("hidden");
        }
    });


    // Fungsi untuk menambah isian anggota keluarga baru
    let anggotaKeluargaCount = 1; // Counter untuk jumlah anggota keluarga yang sudah ada

    // Fungsi untuk menambah isian anggota keluarga baru
    function tambahAnggotaKeluarga() {
        anggotaKeluargaCount++; // Menambah counter

        // Membuat elemen untuk isian anggota keluarga baru
        let newAnggotaKeluarga = document.createElement('div');
        newAnggotaKeluarga.classList.add('anggota-keluarga');
        newAnggotaKeluarga.innerHTML = `
            <label for="anggota_keluarga_${anggotaKeluargaCount}" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Anggota Keluarga ${anggotaKeluargaCount}</label>
            <input type="text" name="anggota_keluarga[]" id="anggota_keluarga_${anggotaKeluargaCount}" class="anggota-keluarga-input shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Anggota Keluarga ${anggotaKeluargaCount}" required>
        `;
        document.getElementById('anggota-keluarga').appendChild(newAnggotaKeluarga); // Menambah isian anggota keluarga baru ke dalam div anggota-keluarga
    }

    // Event listener untuk mendengarkan peristiwa input pada isian terakhir
    document.getElementById('anggota-keluarga').addEventListener('input', function(event) {
        let anggotaInputs = document.querySelectorAll('.anggota-keluarga-input');
        let lastInput = anggotaInputs[anggotaInputs.length - 1];

        // Jika pengguna sedang mengetik di isian terakhir
        if (event.target === lastInput) {
            // Jika isian terakhir kosong, tambahkan isian anggota keluarga baru
            if (lastInput.value.trim() !== '') {
                tambahAnggotaKeluarga();
            }
        }
    });

</script>