@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full h-screen min-w-max p-5 shadow overflow-auto">

            <form id="form" class="px-10 py-10 bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('keluarga') }}" method="POST">
                <h1 class="px-5 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-4 ">
                    {{ $page->title }}
                </h1>
                @csrf
                {{-- Nomor Keluarga --}}
                    <label for="nomor_keluarga" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nomor Keluarga<span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_keluarga" id="nomor_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Nomor Keluarga" required />
                    <small id="nomor_keluarga_help" class="text-red-500 hidden col-span-4">Nomor keluarga harus terdiri dari 16 digit.</small>
                    <div class="relative bg-teal-500 hover:bg-teal-600 col-span-4 rounded-lg transition duration-300 ease-in-out">
                        <input type="file" name="kk_photo" id="kk_photo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" required />
                        <label for="kk_photo" class="block text-sm font-medium cursor-pointer text-white py-2 px-4">
                            Submit Foto KK (Max ukuran 2MB)
                        </label>
                    </div>
                    <div id="uploadIndicator_kk" class="hidden col-span-2">
                        <span class="text-green-500">Gambar Terunggah</span>
                    </div>
                {{-- Jumlah Kendaraan --}}
                    <label for="jumlah_kendaraan" class="block mb-2 text-sm font-bold text-gray-900">Jumlah Kendaraan<span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Jumlah Kendaraan" required />
                
                {{-- Alamat --}}
                    <label for="alamat" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Alamat KK<span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" id="alamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- Kelurahan --}}
                    <label for="kelurahan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kelurahan<span class="text-red-500">*</span></label>
                    <input type="text" name="kelurahan" id="kelurahan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- Kecamatan --}}
                    <label for="kecamatan" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kecamatan<span class="text-red-500">*</span></label>
                    <input type="text" name="kecamatan" id="kecamatan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- Kota --}}
                    <label for="kota" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kota<span class="text-red-500">*</span></label>
                    <input type="text" name="kota" id="kota" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Alamat" value="" required />
                
                {{-- RT ????????--}}
                    <label for="rt" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Rt<span class="text-red-500">*</span></label>
                    <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan nomer Rt" value="" required />
                    {{-- RW hidden --}}
                    <input type="hidden" name="rw" value="6" required/>
                
                {{-- Luas Tanah --}}
                    <label for="luas_tanah" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Luas Tanah<span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="luas_tanah" id="luas_tanah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Luas Tanah" required />
                
                {{-- Kepala Keluarga --}}
                    <div class="col-span-4">
                        <label for="kepala_keluarga" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kepala Keluarga<span class="text-red-500">*</span></label>
                        <select name="kepala_keluarga" id="kepala_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Kepala Keluarga" required >
                            <option value="">Pilih Kepala Keluarga</option>
                            @foreach ($penduduk as $daftarPenduduk)
                            <option value="{{$daftarPenduduk->nik}}">{{$daftarPenduduk->nama}}</option>    
                            @endforeach
                        </select>
                    </div>
                {{-- Anggota Keluarga --}}
                    <div id="anggota-keluarga" class="col-span-4">
                        <div class="anggota-keluarga">
                            <label for="anggota_keluarga_1" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Anggota Keluarga 1</label>
                            <select name="anggota_keluarga[]" id="anggota_keluarga_1" class="anggota-keluarga-input shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" required>
                                <option value="">Pilih Anggota Keluarga 1</option>
                                @foreach ($penduduk as $daftarPenduduk)
                                <option value="{{$daftarPenduduk->nik}}">{{$daftarPenduduk->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button id="tambah-anggota-button" class="bg-teal-500 text-sm text-left font-medium text-white py-2 px-4 rounded-lg mt-4 col-span-4">Tambah Anggota Keluarga</button>
                
                    {{-- Jumlah anggota keluarga, warga bekerja dan belum bekerja --}}
                    <input type="hidden" name="total_anggota_keluarga" id="total_anggota_keluarga" value="">
                    <input type="hidden" name="total_orang_kerja" id="total_orang_kerja" value="">
                    <input type="hidden" name="total_tanggungan" id="total_tanggungan" value="">       
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
    // Script tulisan dibawah
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

    // Script foto terunggah
    const foto_kk = document.getElementById('kk_photo');
    
    const uploadIndicator_kk = document.getElementById('uploadIndicator_kk');
    foto_kk.addEventListener('change', function() {
        if (foto_kk.files.length > 0) {
            uploadIndicator_kk.classList.remove('hidden');
        } else {
            uploadIndicator_kk.classList.add('hidden');
        }
    });

    // Fungsi untuk menambah isian anggota keluarga baru
    $(document).ready(function() {
        var anggotaCount = 1;

        $("#tambah-anggota-button").click(function() {
            anggotaCount++;

            var newAnggotaDiv = '<div class="anggota-keluarga col-span-4">' +
                                    '<label for="anggota_keluarga_' + anggotaCount + '" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Anggota Keluarga ' + anggotaCount + '</label>' +
                                    '<select name="anggota_keluarga[]" id="anggota_keluarga_' + anggotaCount + '" class="anggota-keluarga-input shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" required>' +
                                        '<option value="">Pilih Anggota Keluarga ' + anggotaCount + '</option>' +
                                        '@foreach ($penduduk as $daftarPenduduk)' +
                                            '<option value="{{$daftarPenduduk->nik}}">{{$daftarPenduduk->nama}}</option>' +
                                        '@endforeach' +
                                    '</select>' +
                                '</div>';

            $("#anggota-keluarga").append(newAnggotaDiv);
        });
    });

    // Script untuk menjumlahkan anggota keluarga, warga kerja dan tanggungan
    document.getElementById('form').addEventListener('submit', function(event) {
        event.preventDefault();

        // Hitung jumlah anggota keluarga
        var jumlahAnggotaKeluarga = document.querySelectorAll('.anggota-keluarga').length;
        document.getElementById('total_anggota_keluarga').value = jumlahAnggotaKeluarga;

        // Hitung jumlah orang yang bekerja dan tanggungan
        var jumlahOrangKerja = 0;
        var jumlahTanggungan = 0;
        var pendudukInputs = document.querySelectorAll('.pekerjaan-input');
        pendudukInputs.forEach(function(input) {
            if (input.value === 'Belum Bekerja') {
                jumlahTanggungan++;
            } else {
                jumlahOrangKerja++;
            }
        });
        document.getElementById('total_orang_kerja').value = jumlahOrangKerja;
        document.getElementById('total_tanggungan').value = jumlahTanggungan;

        // Kirim form
        this.submit();
    });

</script>