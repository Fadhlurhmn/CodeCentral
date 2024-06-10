@include('layout.start')
@include('layout.a_navbar')

<!-- Container utama dengan tampilan flex -->
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <!-- Bagian konten utama -->
    <div class="flex-grow bg-white">

        <!-- Container untuk form input data jabatan -->
        <div class="w-full h-screen min-w-max p-5 overflow-y-auto custom-scrollbar">
            <!-- Menampilkan breadcrumb -->
            @include('layout.breadcrumb2')
            <form class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/jabatan') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <!-- Judul form -->
                <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-4">
                    {{ $page->title }}
                </h1>
                <!-- Display errors -->
                @if ($errors->any())
                <div class="col-span-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Ada yang salah!</strong>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Input untuk Kode Jabatan -->
                <label for="kode_level" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Kode Jabatan<span class="text-red-500">*</span></label>
                <select name="kode_level" id="kode_level" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Kode Level" required>
                    <option value="">Pilih Kode Jabatan</option>
                    <option value="ADM">ADM (Admin)</option>
                    <option value="RW">RW</option>
                    <option value="RT">RT</option>
                </select>

                <!-- Input untuk Nama Jabatan -->
                <label for="nama_level" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nama Jabatan<span class="text-red-500">*</span></label>
                <input type="text" name="nama_level" id="nama_level" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Nama Level" required>

                <!-- Tombol Batal dan Simpan -->
                <div class="flex mt-4 col-span-2">
                    <a href="{{ url('admin/jabatan') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')
