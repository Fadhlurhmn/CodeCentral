@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-2xl font-bold">{{ $page->title }}</h1>
        </div>
        <div class="w-full h-fit min-w-max p-5">
            <form id="form" class="px-10 py-10 bg-white outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/jadwal/keamanan/create') }}" method="POST">
                <h1 class="pb-5 mb-10 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2">
                    Isi Jadwal Keamanan
                </h1>
                @csrf

                {{-- Hari --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="hari" class="block mb-2 text-xs font-bold text-gray-900">Hari<span class="text-red-500">*</span></label>
                        <select name="hari" id="hari" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                </div>
                
                {{-- Waktu --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="waktu" class="block mb-2 text-xs font-bold text-gray-900">Waktu<span class="text-red-500">*</span></label>
                        <select name="waktu" id="waktu" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required>
                            <option value="Pagi">Pagi</option>
                            <option value="Sore">Sore</option>
                            <option value="Malam">Malam</option>
                        </select>
                    </div>
                </div>

                {{-- Nama --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="nama" class="block mb-2 text-xs font-bold text-gray-900">Nama<span class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Nama" required />
                    </div>
                </div>

                {{-- Telepon --}}
                <div class="grid grid-cols-4 gap-x-20 gap-y-2 mb-5">
                    <div class="col-span-4">
                        <label for="telepon" class="block mb-2 text-xs font-bold text-gray-900">Telepon<span class="text-red-500">*</span></label>
                        <input type="number" name="telepon" id="telepon" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" placeholder="Masukkan Telepon" required />
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex col-span-1">
                    <a href="{{ url('admin/jadwal') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
        </div>
   
