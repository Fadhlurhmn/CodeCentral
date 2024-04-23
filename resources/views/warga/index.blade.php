<div class="container max-w-4xl ">
    <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">Data Warga Rt.X</h1>
    </div>
    <div class="w-full min-w-max p-5 shadow">
        <!-- <table> -->
            <table class="mt-2 table-auto border w-full min-w-max cursor-default">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Data Warga Rt.X
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400"> Daftar data warga rt.x yang tersimpan dalam sistem</p>
                    {{-- Search bar --}}
                    <input type="text" class="my-5 mr-3 border border-gray-300 rounded-md text-gray-900 font-normal" placeholder="Cari...">
                    <button class="px-5 bg-gray-200 text-gray-700 rounded-md">Cari</button>
                    <div>
                        <a class="p-2 mr-5 mb-3 font-normal text-sm text-center bg-blue-300 text-blue-700 rounded-lg" href="{{route('create')}}" >Tambah Data Warga</a>
                    </div>
                </caption>
                <thead class="bg-gray-400">
                    <tr>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">ID</th>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">Nama</th>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">NIK</th>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">Tanggal Lahir</th>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">Telpon</th>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">Status Tinggal</th>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">Status Data</th>
                        <th class="p-3 text-xm font-normal justify-between tracking-wide text-white border-r">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="whitespace-nowrap">
                        {{-- ID --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            1
                        </td>
                        {{-- Nama Warga --}}
                        <td class="p-3 text-sm texy-left text-gray-700 border-r">
                                Fadhlurohman Al Farabi 
                        </td>
                        {{-- NIK --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                2341241312
                        </td>
                        {{-- Tanggal lahir --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                01-01-1985
                        </td>
                        {{-- Telp --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                0812345678
                        </td>
                        {{-- Status Tinggal --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            Sementara
                        </td>
                        {{-- Status Data --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            <span class="p-1.5 text-xs font-semibold tracking-wider text-green-800 bg-green-200 rounded-lg opacity-70">Aktif</span>
                        </td>
                        {{-- Action --}}
                        <td class="p-3 text-sm text-gray-700 border-r">
                            <a href="{{route('show')}}" class="px-4 py-1 text-sm bg-blue-500/20 text-blue-700 rounded">Detail</a>
                            <a href="{{route('edit')}}" class="px-4 py-1 text-sm bg-yellow-500/20 text-yellow-700 rounded">Edit</a>
                            <a href="#" class="px-4 py-1 text-sm bg-red-500/20 text-red-700 rounded">Non-Aktifkan</a>
                        </td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        {{-- ID --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            2
                        </td>
                        {{-- Nama Warga --}}
                        <td class="p-3 text-sm texy-left text-gray-700 border-r">
                                Wahyudi
                        </td>
                        {{-- NIK --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                2341241312
                        </td>
                        {{-- Tanggal lahir --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                01-01-1985
                        </td>
                        {{-- Telp --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                0812345678
                        </td>
                        {{-- Status Tinggal --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            Tetap
                        </td>
                        {{-- Status Data --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            <span class="p-1.5 text-xs font-semibold tracking-wider text-green-800 bg-green-200 rounded-lg opacity-70">Aktif</span>
                        </td>
                        {{-- Action --}}
                        <td class="p-3 text-sm text-gray-700 border-r">
                            <a href="{{route('show')}}" class="px-4 py-1 text-sm bg-blue-500/20 text-blue-700 rounded">Detail</a>
                            <a href="#" class="px-4 py-1 text-sm bg-yellow-500/20 text-yellow-700 rounded">Edit</a>
                            <a href="#" class="px-4 py-1 text-sm bg-red-500/20 text-red-700 rounded">Non-Aktifkan</a>
                        </td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        {{-- ID --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            3
                        </td>
                        {{-- Nama Warga --}}
                        <td class="p-3 text-sm texy-left text-gray-700 border-r">
                                Aleron Tsaqif Rakha Rajendra
                        </td>
                        {{-- NIK --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                2341241312
                        </td>
                        {{-- Tanggal lahir --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                01-01-1985
                        </td>
                        {{-- Telp --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                                0812345678
                        </td>
                        {{-- Status Tinggal --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            Tetap
                        </td>
                        {{-- Status Data --}}
                        <td class="p-3 text-sm text-center text-gray-700 border-r">
                            <span class="p-1.5 text-xs font-semibold tracking-wider text-red-800 bg-red-200 rounded-lg opacity-70">Tidak Aktif</span>
                        </td>
                        {{-- Action --}}
                        <td class="p-3 text-sm text-gray-700 border-r">
                            <a href="{{route('show')}}" class="px-4 py-1 text-sm bg-blue-500/20 text-blue-700 rounded">Detail</a>
                            <a href="#" class="px-4 py-1 text-sm bg-yellow-500/20 text-yellow-700 rounded">Edit</a>
                            <a href="#" class="px-4 py-1 text-sm bg-green-500/20 text-green-700 rounded">Aktifkan</a>
                        </td>
                    </tr>
                </tbody>
            </table>            
    </div>
    <!-- Coba Paginasi -->
    <div class="flex justify-center mt-5">
        {{-- {{ $data->links() }}  --}}
    </div>
</div>
