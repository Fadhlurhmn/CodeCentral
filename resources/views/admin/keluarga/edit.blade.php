@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{ $breadcrumb->title }}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">

            @if(!$keluarga)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/keluarga') }}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            <form class="px-10 py-10 min-w-full bg-white max-w-3xl grid grid-cols-4 gap-x-20 gap-y-4 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/keluarga/' . $keluarga->id_keluarga) }}" method="POST">
                <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-full">
                    {{ $page->title }}
                </h1>
                @csrf
                @method('POST')
            
                {{-- Nomor Keluarga --}}
                <div class="col-span-4">
                    <label for="nomor_keluarga" class="block mb-2 text-sm font-bold text-gray-900">Nomor Keluarga<span class="text-red-500">*</span></label>
                    <input type="text" name="nomor_keluarga" id="nomor_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Nomor Keluarga" value="{{ $keluarga->nomor_keluarga }}" required />
                    <small id="nomor_keluarga_help" class="text-red-500 hidden">Nomor keluarga harus terdiri dari 16 digit.</small>
                </div>
            
                {{-- Upload Foto KK --}}
                <div class="col-span-4">
                    <label for="kk_photo" class="block mb-2 text-sm font-bold text-gray-900">Foto KK<span class="text-red-500">*</span></label>
                    <input type="file" name="foto_kk" id="kk_photo" accept="image/*" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required />
                </div>
            
                {{-- Jumlah Tanggungan --}}
                <div class="col-span-4 sm:col-span-2">
                    <label for="jumlah_tanggungan" class="block mb-2 text-sm font-bold text-gray-900">Jumlah Tanggungan<span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Tanggungan" value="{{ $keluarga->jumlah_tanggungan }}" required />
                </div>
            
                {{-- Jumlah Kendaraan --}}
                <div class="col-span-4 sm:col-span-2">
                    <label for="jumlah_kendaraan" class="block mb-2 text-sm font-bold text-gray-900">Jumlah Kendaraan<span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Jumlah Kendaraan" value="{{ $keluarga->jumlah_kendaraan }}" required />
                </div>
            
                {{-- Luas Tanah --}}
                <div class="col-span-4 sm:col-span-2">
                    <label for="luas_tanah" class="block mb-2 text-sm font-bold text-gray-900">Luas Tanah<span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="luas_tanah" id="luas_tanah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Luas Tanah" value="{{ $keluarga->luas_tanah }}" required />
                </div>
                
                {{-- Alamat --}}
                <div class="col-span-4 sm:col-span-2">
                    <label for="alamat" class="block mb-2 text-sm font-bold text-gray-900">Alamat<span class="text-red-500">*</span></label>
                    <input type="number" step="any" name="alamat" id="alamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Alamat" value="{{ $keluarga->alamat }}" required />
                </div>
            
                {{-- Button --}}
                <div class="flex justify-between grid-cols-2">
                    <a href="{{ url('admin/keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
            
            @endif

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
