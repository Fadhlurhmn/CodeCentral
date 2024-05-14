@extends('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-2xl font-bold">{{$page->title}}</h1>
        </div>
        <div class="w-full h-fit min-w-max p-5">
            <form id="form" class="px-10 py-10 bg-white outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/keluarga') }}" method="POST" enctype="multipart/form-data">
                <h1 class="pb-5 mb-10 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2">
                    Isi data keluarga
                </h1>
                @csrf

                {{-- Nomor Keluarga --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="nomor_keluarga" class="block mb-2 text-xs font-bold text-gray-900">Nomor Keluarga<span class="text-red-500">*</span></label>
                        <input type="text" name="nomor_keluarga" id="nomor_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Nomor Keluarga" required />
                        <small id="nomor_keluarga_help" class="text-red-500 hidden">Nomor keluarga harus terdiri dari 16 digit.</small>
                    </div>
                    <div class="relative col-span-2">
                        <input type="file" name="foto_kk" id="foto_kk" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" required />
                        {{-- <input type="file" name="foto_kk" id="foto_kk" accept="image/*" class="shadow bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required /> --}}
                        <label for="foto_kk" class="text-xs font-medium cursor-pointer text-white py-2 px-4 bg-teal-500 rounded-lg hover:bg-teal-600 transition duration-300 ease-in-out">
                            Submit Foto KK (Max ukuran 2MB)
                        </label>
                        <div id="uploadIndicator_kk" class="hidden mt-2">
                            <span class="text-green-500 text-sm">Gambar Terunggah</span>
                        </div>
                    </div>
                </div>
                
                {{-- Jumlah Kendaraan --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="jumlah_kendaraan" class="block mb-2 text-xs font-bold text-gray-900">Jumlah Kendaraan<span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Kendaraan" required />
                    </div>
                </div>

                {{-- Jumlah Tanggungan --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="jumlah_tanggungan" class="block mb-2 text-xs font-bold text-gray-900">Jumlah Tanggungan<span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Tanggungan" required />
                    </div>
                </div>

                {{-- Jumlah Orang Kerja --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="jumlah_orang_kerja" class="block mb-2 text-xs font-bold text-gray-900">Jumlah Orang Kerja<span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_orang_kerja" id="jumlah_orang_kerja" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Orang Kerja" required />
                    </div>
                </div>
                {{-- Luas Tanah --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="jumlah_orang_kerja" class="block mb-2 text-xs font-bold text-gray-900">Luas Tanah<span class="text-red-500">*</span></label>
                        <input type="number" name="luas_tanah" id="luas_tanah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Luas Tanah" required />
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="alamat" class="block mb-2 text-xs font-bold text-gray-900">Alamat KK<span class="text-red-500">*</span></label>
                        <input type="text" name="alamat" id="alamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Alamat" required />
                    </div>
                </div>

                {{-- Kelurahan, Kecamatan, Kota --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4 sm:col-span-2">
                        <label for="kelurahan" class="block mb-2 text-xs font-bold text-gray-900">Kelurahan<span class="text-red-500">*</span></label>
                        <input type="text" name="kelurahan" id="kelurahan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Kelurahan" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="kecamatan" class="block mb-2 text-xs font-bold text-gray-900">Kecamatan<span class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" id="kecamatan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Kecamatan" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="kota" class="block mb-2 text-xs font-bold text-gray-900">Kota<span class="text-red-500">*</span></label>
                        <input type="text" name="kota" id="kota" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Kota" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <label for="rt" class="block mb-2 text-xs font-bold text-gray-900">RT<span class="text-red-500">*</span></label>
                        <input type="number" name="rt" id="rt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan RT" required />
                    </div>
                    <div class="col-span-4 sm:col-span-2 hidden">
                        <label for="rw" class="block mb-2 text-xs font-bold text-gray-900">RW<span class="text-red-500">*</span></label>
                        <input type="hidden" value="1" name="rw" id="rw" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan RW" required />
                    </div>
                </div>
                {{-- Submit Button --}}
                <div class="flex col-span-1">
                    <a href="{{ url('admin/keluarga') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button id="submitBtn" type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nomorKeluargaInput = document.getElementById('nomor_keluarga');
        const nomorKeluargaHelp = document.getElementById('nomor_keluarga_help');

        // Validasi nomor keluarga harus 16 digit
        nomorKeluargaInput.addEventListener('input', function() {
            if (nomorKeluargaInput.value.length !== 16) {
                nomorKeluargaHelp.classList.remove('hidden');
            } else {
                nomorKeluargaHelp.classList.add('hidden');
            }
        });

        // Upload indicator
        const kkPhotoInput = document.getElementById('foto_kk');
        const uploadIndicatorKK = document.getElementById('uploadIndicator_kk');

        kkPhotoInput.addEventListener('change', function() {
            if (kkPhotoInput.files.length > 0) {
                uploadIndicatorKK.classList.remove('hidden');
            } else {
                uploadIndicatorKK.classList.add('hidden');
            }
        });

    });
</script>
