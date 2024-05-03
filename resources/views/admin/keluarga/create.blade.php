@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">

            <form class="px-10 py-10 min-w-full bg-white gap-x-20 gap-y-2 grid grid-cols-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('keluarga') }}" method="POST">
                <h1 class="px-5 pt-12 pb-5 mb-5 font-semibold text-center rtl:text-right text-gray-900 bg-teal-400 col-span-full rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                                {{-- Nomor Keluarga --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="nomor_keluarga" class="block mb-2 text-sm font-bold text-gray-900">Nomor Keluarga</label>
                    <input type="number" name="nomor_keluarga" id="nomor_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Nomor Keluarga" required />
                    <small id="nomor_keluarga_help" class="text-red-500 hidden">Nomor keluarga harus terdiri dari 10 digit.</small>
                </div>
                                {{-- Jumlah Orang Kerja --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="jumlah_orang_kerja" class="block mb-2 text-sm font-bold text-gray-900">Jumlah Orang Kerja</label>
                    <input type="number" name="jumlah_orang_kerja" id="jumlah_orang_kerja" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Jumlah Orang Kerja" required />
                </div>
                {{-- Jumlah Tanggungan --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="jumlah_tanggungan" class="block mb-2 text-sm font-bold text-gray-900">Jumlah Tanggungan</label>
                    <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Jumlah Tanggungan" required />
                </div>
                {{-- Jumlah Kendaraan --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="jumlah_kendaraan" class="block mb-2 text-sm font-bold text-gray-900">Jumlah Kendaraan</label>
                    <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Jumlah Kendaraan" required />
                </div>
                {{-- Luas Tanah --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="luas_tanah" class="block mb-2 text-sm font-bold text-gray-900">Luas Tanah</label>
                    <input type="number" step="any" name="luas_tanah" id="luas_tanah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Luas Tanah" required />
                </div>
                <br>
                <!-- Other form inputs here -->
                <div class="flex justify-between">
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
        var isValid = /^\d{10}$/.test(input);
        var errorMessage = document.getElementById("nomor_keluarga_help");

        if (isValid) {
            errorMessage.classList.add("hidden");
        } else {
            errorMessage.classList.remove("hidden");
        }
    });
</script>