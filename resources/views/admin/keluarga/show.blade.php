@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-2xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow-md">
            @if(!$keluarga)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                    <p>Data yang Anda cari tidak ditemukan</p>
                    <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{url('admin/keluarga')}}';">
                        close <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @else
                {{-- Tabel data keluarga 1 --}}
                <table class="mt-2 mb-5 table-auto w-full min-w-max cursor-default text-left border outline-none outline-gray-700">
                    <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-teal-400">
                        {{ $page->title }}
                        <p class="mt-1 text-lg font-normal text-slate-100"> {{ $page->title }} dalam sistem</p>
                    </caption>
                <tbody class="bg-white grid grid-cols-3">
                    <tr class="whitespace-nowrap border-t border-gray-400 col-span-3">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Foto KK</th>
                        <td class="pl-3 text-sm py-2"><img src="{{ asset('data_kk/'. $keluarga->foto_kk) }}" class="img-thumbnail w-96" /></td>
                    </tr>
                    <tr class="bg-gray-100/50 border-t border-gray-400 col-span-3">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Nomer Kartu Keluarga</th>
                        <td class="pl-3 text-sm">{{ $keluarga->nomor_keluarga }}</td>
                    </tr>
                    <tr class="whitespace-nowrap border-t border-gray-400 col-span-2">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Alamat KK</th>
                        <td class="pl-3 text-sm">{{ $keluarga->alamat }}</td>
                    </tr>
                    <tr class="whitespace-nowrap border-t border-gray-400 col-span-1">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Rt</th>
                        <td class="pl-3 text-sm">{{ $keluarga->rt }}</td>
                    </tr>
                    <tr class="bg-gray-100/50  border-t border-gray-400 col-span-full">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Luas Tanah</th>
                        <td class="pl-3 text-sm">{{ $keluarga->luas_tanah }}</td>
                    </tr>
                    <tr class="whitespace-nowrap border-t border-gray-400 col-span-1">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Kelurahan</th>
                        <td class="pl-3 text-sm">{{ $keluarga->kelurahan }}</td>
                    </tr>
                    <tr class="whitespace-nowrap border-t border-gray-400 col-span-1">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Kecamatan</th>
                        <td class="pl-3 text-sm">{{ $keluarga->kecamatan }}</td>
                    </tr>
                    <tr class="whitespace-nowrap border-t border-gray-400 col-span-1">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-40">Kota</th>
                        <td class="pl-3 text-sm">{{ $keluarga->kota }}</td>
                    </tr>
                    
                </tbody>
                </table>
            {{-- End Tabel Data Keluarga 1  --}}
            {{-- Start Data Anggota Keluarga --}}
            <table class="mt-2 mb-5 table-auto w-full min-w-max cursor-default text-left border outline-none outline-gray-700">
                <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-teal-400">
                    Detail anggota keluarga "{{$keluarga->nomor_keluarga}}"
                </caption>
                <tbody class="bg-white grid grid-cols-3">
                    <tr class="whitespace-nowrap col-span-3">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-36">Kepala Keluarga</th>
                        <td class="pl-3 text-sm">
                            @if($kepala_keluarga->isNotEmpty())
                                {{ $kepala_keluarga->first()->penduduk->nama }}
                                @else
                                Data Tidak Ditemukan
                            @endif
                        </td>
                    </tr>
                    <tr class="bg-gray-100/50 col-span-3 border-t border-gray-400">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-36">Istri</th>
                        <td class="pl-3 text-sm">
                            @php $nomer = 1; @endphp
                            @foreach ($istri as $member)
                                {{$nomer}}. {{ $member->penduduk->nama }} <br>
                                @php $nomer++; @endphp    
                            @endforeach
                        </td>
                    </tr>
                    <tr class="whitespace-nowrap col-span-3 border-t border-gray-400">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-36">Anggota</th>
                        <td class="pl-3 text-sm">
                            @php $nomer = 1; @endphp
                            @foreach ($anggota as $member)
                                {{$nomer}}. {{ $member->penduduk->nama }} <br>
                                @php $nomer++; @endphp    
                            @endforeach
                        </td>
                    </tr>
                    <tr class="bg-gray-100/50 col-span-1 border-t border-gray-400">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-36">Jumlah Orang Kerja</th>
                        <td class="pl-3 text-sm">{{ $keluarga->jumlah_orang_kerja }}</td>
                    </tr>
                    <tr class="bg-gray-100/50 col-span-1 border-t border-gray-400">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-36">Jumlah Tanggungan</th>
                        <td class="pl-3 text-sm">{{ $keluarga->jumlah_tanggungan}}</td>
                    </tr>
                    <tr class="bg-gray-100/50 col-span-1 border-t border-gray-400">
                        <th class="px-3 py-2 border-l border-r border-gray-400 w-36">Jumlah Kendaraan</th>
                        <td class="pl-3 text-sm">{{ $keluarga->jumlah_kendaraan }}</td>
                    </tr>
                </tbody>
            </table>
            {{-- End Data Anggota Keluarga --}}
            <a href="{{ url('admin/keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-caret-left"></i> Kembali</a>      
            @endif
        </div>
    </div>
</div>

@include('layout.end')
