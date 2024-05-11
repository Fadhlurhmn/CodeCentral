@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">
            @if(!$keluarga)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                    <p>Data yang Anda cari tidak ditemukan</p>
                    <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{url('keluarga')}}';">
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
                    <tr class="whitespace-nowrap ">
                        <th class="px-3 py-2 border-r w-40">Foto KK</th>
                        <td class="pl-3 py-2"><img src="{{ asset('data_nik/'. $keluarga->foto_kk) }}" class="img-thumbnail w-96" /></td>
                    </tr>
                    <tr class="whitespace-nowrap border-t">
                        <th class="px-3 py-2 border-r w-40">Nomer Kartu Keluarga</th>
                        <td class="pl-3">{{ $keluarga->nomor_keluarga }}</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="px-3 py-2 border-r">Jumlah Orang Kerja</th>
                        <td class="pl-3">{{ $keluarga->jumlah_orang_kerja }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="px-3 py-2 border-r">Jumlah Tanggungan</th>
                        <td class="pl-3">{{ $keluarga->jumlah_tanggungan}}</td>
                    </tr>
                    <tr class="bg-gray-100/50">
                        <th class="px-3 py-2 border-r">Jumlah Kendaraan</th>
                        <td class="pl-3">{{ $keluarga->jumlah_kendaraan }}</td>
                    </tr>
                    <tr class="whitespace-nowrap">
                        <th class="px-3 py-2 border-r">Luas Tanah</th>
                        <td class="pl-3">{{ $keluarga->luas_tanah }}</td>
                </tbody>
            </table>      
            <a href="{{ url('keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kembali</a>      
            @endif
        </div>
    </div>
</div>

@include('layout.end')
