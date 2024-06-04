@include('layout.start')

@include('layout.a_navbar')

<!-- Container utama dengan tampilan flex -->
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar') <!-- Menyertakan sidebar -->

    <!-- Bagian konten utama -->
    <div class="flex-grow bg-white">
        
        <!-- Container untuk konten utama halaman -->
        <div class="w-full min-w-max p-5 bg-white">
            <!-- Menampilkan breadcrumb -->
            @include('layout.breadcrumb2')
            @if(!$user)
                <!-- Menampilkan pesan error jika data user tidak ditemukan -->
                <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                    <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                    <p>Data yang Anda cari tidak ditemukan</p>
                    <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg" data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/akun') }}';">
                        close <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <!-- Tabel untuk menampilkan detail user -->
                <table class="mt-2 mb-5 table-auto w-full min-w-max cursor-default text-left border outline-none outline-teal-400 rounded-xl">
                    <caption class="p-5 text-2xl font-semibold text-left rtl:text-right text-gray-900 bg-teal-400 border-b-2 border-black rounded-t-xl">
                        {{ $page->title }}
                    </caption>
                    <tbody class="bg-white">
                        <tr class="whitespace-nowrap bg-gray-200">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Username</th>
                            <td class="pl-3 text-sm">{{ $user->username }}</td>
                        </tr>
                        <tr class="whitespace-nowrap bg-gray-100">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Nama</th>
                            <td class="pl-3 text-sm">{{ $user->penduduk->nama }}</td>
                        </tr>
                        <tr class="whitespace-nowrap bg-gray-200">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Password</th>
                            <td class="pl-3 text-sm">
                                <input type="password" value="{{ $user->password }}" disabled>
                            </td>
                        </tr>
                        <tr class="whitespace-nowrap bg-gray-100">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Level Akun</th>
                            <td class="pl-3 text-sm">{{ $user->level->nama_level }}</td>
                        </tr>
                        <tr class="whitespace-nowrap bg-gray-200">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Status Akun</th>
                            <td class="pl-3 text-sm">{{ $user->status_akun }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol untuk kembali ke halaman daftar akun -->
                <a href="{{ url('admin/akun') }}" class="shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    <i class="fas fa-caret-left"></i> Kembali
                </a>
            @endif
        </div>
    </div>
</div>

@include('layout.end')
