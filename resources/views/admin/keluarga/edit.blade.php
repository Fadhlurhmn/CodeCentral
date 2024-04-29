@include('base.start')

@include('base.navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{ $breadcrumb->title }}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">

            @if(!$keluarga)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('keluarga') }}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            <form class="px-10 py-10 min-w-full bg-white max-w-3xl grid grid-cols-2 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('keluarga/' . $keluarga->id_keluarga) }}" method="POST">
                <h1 class="p-5 mb-5 font-semibold text-left rtl:text-right text-gray-900 bg-teal-400 col-span-2 rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                @method('POST')
                <div class="relative z-0 w-full mb-5 group col-span-2">
                    <label for="nomor_keluarga" class="font-semibold">Nomor Kartu Keluarga</label>
                    <input type="text" name="nomor_keluarga" id="nomor_keluarga" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="-" value="{{ $keluarga->nomor_keluarga }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="jumlah_orang_kerja" class="font-semibold">Jumlah Orang Bekerja</label>
                    <input type="number" name="jumlah_orang_kerja" id="jumlah_orang_kerja" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="-" value="{{ $keluarga->jumlah_orang_kerja }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="jumlah_tanggungan" class="font-semibold">Jumlah Tanggungan</label>
                    <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="A-" value="{{ $keluarga->jumlah_tanggungan }}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="jumlah_kendaraan" class="font-semibold">Jumlah Kendaraan</label>
                    <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="-" value="{{ $keluarga->jumlah_kendaraan}}" required />
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="luas_tanah" class="font-semibold">Luas Tanah</label>
                    <input type="number" step="any" name="luas_tanah" id="luas_tanah" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100" placeholder="Luas tanah..." value="{{ $keluarga->luas_tanah}}" required />
                </div>
                <br>
                <!-- Other form inputs here -->
                <div class="flex justify-between grid-cols-1">
                    <a href="{{ url('keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
            @endif

        </div>
    </div>
</div>

@include('base.end')
