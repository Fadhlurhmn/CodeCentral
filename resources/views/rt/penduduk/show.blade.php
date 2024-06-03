@include('layout.start')

@include('layout.rt_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.rt_sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <?php
            // @dd($page);
            ?>
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$page->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5">
            @if(!$penduduk)
                <div class="my-5 bg-red-200/30 border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                    <h5 class="font-semibold text-xl text-center"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                    <p class="text-center">Data yang Anda cari tidak ditemukan</p>
                    <div class="flex justify-center mt-2">
                        <button type="button" class="mt-7 px-5 close text bg-red-300/30 hover:bg-red-400/30 rounded-lg" data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{url('rw/penduduk')}}';">
                            close <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @else
                <table class="mt-2 mb-5 table-auto w-full min-w-max cursor-default text-left border outline-none outline-teal-400 rounded-xl">
                    <caption class="p-5 text-2xl font-semibold text-left rtl:text-right text-gray-900 bg-teal-400 border-b-2 border-black rounded-t-xl">
                        {{ $page->title }}
                        <p class="mt-1 text-lg font-normal text-slate-100"> {{ $page->title }} dalam sistem</p>
                    </caption>
                    <tbody class="bg-white grid grid-cols-2">
                        <tr class="whitespace-nowrap col-span-2 ">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Foto KTP</th>
                            <td class="pl-3 py-2"><img src="{{ asset('storage/'. $penduduk->foto_ktp) }}" class="img-thumbnail w-96" /></td>
                        </tr>
                        <tr class="bg-gray-200/50 grid-cols-1 border-t border-gray-400">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">NIK</th>
                            <td class="pl-3 text-sm">{{ $penduduk->nik }}</td>
                        </tr>
                        <tr class="bg-gray-200/50 grid-cols-1 border-t border-gray-400">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Nama</th>
                            <td class="pl-3 text-sm">{{ $penduduk->nama }}</td>
                        </tr>
                        <tr class="whitespace-nowrap grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Alamat KTP</th>
                            <td class="pl-3 text-sm">{{ $penduduk->alamat_ktp}}</td>
                        </tr>
                        <tr class="whitespace-nowrap grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Alamat Domisili</th>
                            <td class="pl-3 text-sm">{{ $penduduk->alamat_domisili }}</td>
                        </tr>
                        <tr class="bg-gray-200/50 grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Rt</th>
                            <td class="pl-3 text-sm">{{ $penduduk->rt }}</td>
                        </tr>
                        <tr class="bg-gray-200/50 grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">RW</th>
                            <td class="pl-3 text-sm">{{ $penduduk->rw }}</td>
                        </tr>
                        <tr class="whitespace-nowrap grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">No Telp</th>
                            <td class="pl-3 text-sm">{{ $penduduk->no_telp }}</td>
                        </tr>
                        <tr class="whitespace-nowrap grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Tempat lahir</th>
                            <td class="pl-3 text-sm">{{ $penduduk->tempat_lahir }}</td>
                        </tr>
                        <tr class="bg-gray-200/50 grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Tanggal lahir</th>
                            <td class="pl-3 text-sm">{{ $penduduk->tanggal_lahir }}</td>
                        </tr>
                        <tr class="bg-gray-200/50 grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Agama</th>
                            <td class="pl-3 text-sm">{{ $penduduk->agama }}</td>
                        </tr>
                        <tr class="whitespace-nowrap grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Pekerjaan</th>
                            <td class="pl-3 text-sm">{{ $penduduk->pekerjaan }}</td>
                        </tr>
                        <tr class="whitespace-nowrap grid-cols-1">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Golongan Darah</th>
                            <td class="pl-3 text-sm">{{ $penduduk->gol_darah }}</td>
                        </tr>
                        <tr class="bg-gray-200/50">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Status Data</th>
                            <td class="pl-3 text-sm">{{ $penduduk->status_data }}</td>
                        </tr>
                        <tr class="bg-gray-200/50">
                            <th class="px-3 py-2 border-l border-r border-gray-400 w-36 font-semibold text-sm">Status Penduduk</th>
                            <td class="pl-3 text-sm">{{ $penduduk->status_penduduk }}</td>
                        </tr>
                    </tbody>
                </table>
                
            <a href="{{ url('rt/penduduk') }}" class=" shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-caret-left"></i>  Halaman data penduduk</a>      
            @endif
        </div>
    </div>
</div>

@include('layout.end')
