@include('base.start')

@include('base.navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">Detail Warga</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">
            {{-- @empty($user) --}}
                <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                    <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                    <p>Data yang Anda cari tidak ditemukan</p>
                    <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{route('warga')}}';">
                        close <span aria-hidden="true">&times;</span>
                    </button>
                </div>            
            {{-- @else --}}
            <table class="mt-2 mb-5 table-auto w-full min-w-max cursor-default text-left border">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Detail Warga
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"> Detail warga rt.x yang tersimpan dalam sistem</p>
                </caption>
                <tbody class="bg-white">
            
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Nama</th>
                        <td class="pl-3">User_nama</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">NIK</th>
                        <td class="pl-3">User_NIk</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Alamat</th>
                        <td class="pl-3">User_alamat</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">Telfon</th>
                        <td class="pl-3">No_telp_user</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Tempat, Tanggal lahir</th>
                        <td class="pl-3">tempat_lahir_user, tanggal_lahir_user</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">Agama</th>
                        <td class="pl-3">Agama_user</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Pekerjaan</th>
                        <td class="pl-3">Pekerjaan_user</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">Golongan Darah</th>
                        <td class="pl-3">Goldar_user</td>
                    </tr>
                </tbody>
            </table>      
            <a href="{{ route('warga') }}" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Kembali</a>      
            {{-- @endempty --}}
        </div>
    </div>
</div>

@include('base.end')
