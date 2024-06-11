@include('layout.start')

@include('layout.rw_navbar')

<!-- Container utama dengan tampilan flex -->
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.rw_sidebar') <!-- Menyertakan sidebar -->

    <!-- Bagian konten utama -->
    <div class="px-5 pt-5 flex-grow bg-white border-t-2 border-teal-500">
        {{-- start breadcrumb --}}
        @include('layout.breadcrumb2')
        {{-- end breadcrumb --}}

        <div class="w-full h-fit p-5">
            <form id="form_profil_edit" action="{{ url('rw/profil') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->
                @method('POST') <!-- Metode POST untuk update data -->

                <div class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-4">
                        {{ $page->title }}
                    </h1>

                    <!-- Display success message -->
                    @if (session('success'))
                    <div class="col-span-4">
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif

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

                    <!-- Input untuk Username -->
                    <label for="username" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Username<span class="text-red-500">*</span></label>
                    <input type="text" name="username" id="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Username" value="{{ $user->username }}" required />


                    <!-- Input untuk Nomor telepon -->
                    <label for="no_telp" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nomor telepon<span class="text-red-500">*</span></label>
                    <input type="number" name="no_telp" id="no_telp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan nomor telepon" value="{{ $penduduk->no_telp }}" required />

                    <!-- Input untuk Password -->
                    <label for="password" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Password</label>
                    <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Password (Kosongkan jika tidak ingin mengubah)"/>

                    <!-- Tombol Batal dan Simpan -->
                    <div class="flex col-span-2 mt-4">
                        <a href="{{ url('rw') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')
