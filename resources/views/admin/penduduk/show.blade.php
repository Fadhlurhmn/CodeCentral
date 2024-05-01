@include('base.start')

@include('base.navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <?php
            // @dd($page);
            ?>
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">
            @if(!$penduduk)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                    <p>Data yang Anda cari tidak ditemukan</p>
                    <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{url('penduduk')}}';">
                        close <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @else
                <table class="mt-2 mb-5 table-auto w-full min-w-max cursor-default text-left border outline-none outline-gray-700">
                    <caption class="p-5 text-2xl font-semibold text-left rtl:text-right text-gray-900 bg-teal-400">
                        {{ $page->title }}
                        <p class="mt-1 text-lg font-normal text-slate-100"> {{ $page->title }} dalam sistem</p>
                    </caption>
                <tbody class="bg-white">
            
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">NIK</th>
                        <td class="pl-3">{{ $nomor_kk }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r w-40">Nama</th>
                        <td class="pl-3">{{ $penduduk->nama }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Alamat</th>
                        <td class="pl-3">{{ $penduduk->alamat }}</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">Rt</th>
                        <td class="pl-3">{{ $penduduk->rt }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">RW</th>
                        <td class="pl-3">{{ $penduduk->rw }}</td>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">No Telp</th>
                        <td class="pl-3">{{ $penduduk->no_telp }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Tempat lahir</th>
                        <td class="pl-3">{{ $penduduk->tempat_lahir }}</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">Tanggal lahir</th>
                        <td class="pl-3">{{ $penduduk->tanggal_lahir }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Agama</th>
                        <td class="pl-3">{{ $penduduk->agama }}</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">Pekerjaan</th>
                        <td class="pl-3">{{ $penduduk->pekerjaan }}</td>
                    </tr>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Golongan Darah</th>
                        <td class="pl-3">{{ $penduduk->gol_darah }}</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="pl-3 py-2 border-r">Status Data</th>
                        <td class="pl-3">{{ $penduduk->status_data }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="pl-3 py-2 border-r">Status Penduduk</th>
                        <td class="pl-3">{{ $penduduk->status_penduduk }}</td>
                    </tr>
                </tbody>
            </table>      
            <a href="{{ url('penduduk') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kembali</a>      
            @endif
        </div>
    </div>
</div>

@include('base.end')
