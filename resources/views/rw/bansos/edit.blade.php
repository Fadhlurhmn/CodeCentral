@include('layout.start')
@include('layout.rw_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.rw_sidebar')
    <div class="flex-grow bg-white">
        <div class="w-full h-fit min-w-max p-5">
            <form id="form" action="{{ url('rw/bansos/' . $bansos->id_bansos) }}" method="POST">
                @csrf
                <div class="px-10 py-10 text-xs bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-full">
                        Form Edit Bantuan Sosial
                    </h1>
                    
                    <div class="col-span-2">
                        <label for="nama_bansos" class="block text-sm font-bold text-gray-900">Nama Bantuan Sosial</label>
                        <input type="text" name="nama_bansos" id="nama_bansos" value="{{ $bansos->nama }}" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="col-span-2">
                        <label for="tanggal_bansos" class="block text-sm font-bold text-gray-900">Tanggal Pemberian Bantuan</label>
                        <input type="date" name="tanggal_bansos" id="tanggal_bansos" value="{{ $bansos->tanggal_pemberian }}" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="col-span-2">
                        <label for="pengirim" class="block text-sm font-bold text-gray-900">Pengirim</label>
                        <input type="text" name="pengirim" id="pengirim" value="{{ $bansos->pengirim }}" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="col-span-2">
                        <label for="jumlah_penerima" class="block text-sm font-bold text-gray-900">Jumlah Penerima</label>
                        <input type="number" name="jumlah_penerima" id="jumlah_penerima" value="{{ $bansos->jumlah_penerima }}" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="col-span-2">
                        <label for="bentuk_pemberian" class="block text-sm font-bold text-gray-900">Bentuk Pemberian</label>
                        <input type="text" name="bentuk_pemberian" id="bentuk_pemberian" value="{{ $bansos->bentuk_pemberian }}" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="col-span-2">
                        <label for="kode" class="block text-sm font-bold text-gray-900">Kode</label>
                        <input type="text" name="kode" id="kode" value="{{ $bansos->kode }}" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                    </div>

                    <div class="flex py-2 px-3 mt-5 justify-start group col-span-2">
                        <a href="{{ url('rw/bansos') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')
