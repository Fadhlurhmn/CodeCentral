@include('layout.start')

@include('layout.a_navbar')

<!-- start wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 
    <h1 class="py-5 ml-5 text-3xl text-gray-900 font-bold">{{ $breadcrumb->title }}</h1>
    {{-- Alert ketika data tidak ditemukan --}}
    @if(!$promosi)
    <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
        <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
        <p>Data yang Anda cari tidak ditemukan</p>
        <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/promosi') }}';">
            close <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @else
    {{-- End bagian alert data --}}
    {{-- Start Detail Informasi usaha warga --}}
    <div class="container mx-auto mt-8 mb-5">
        <div class="bg-teal-600 px-4 py-2 rounded-t-lg">
            <h2 class="text-lg font-semibold text-white border-b-2 border-white pb-1">{{ $page->title }}</h2>
        </div>
        <div class="bg-white shadow-md rounded-b-lg overflow-hidden">
            <div class="flex">
                <div class="w-1/2 flex items-center justify-start">
                    <img src="{{ $promosi->image_url }}" alt="{{ $promosi->nama_usaha }}" class="max-w-full h-auto mx-auto mt-5 mb-5 ml-5 rounded-xl" style="max-width: 400px; max-height: 300px;">
                </div>
                <div class="w-1/2 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Nama Usaha: {{ $promosi->nama_usaha }}</h3>
                    <p class="text-gray-700 mb-2">Deskripsi Usaha: {{ $promosi->deskripsi }}</p>
                    <p class="text-gray-700 mb-2">Lokasi: {{ $promosi->alamat }}</p>
                    <p class="text-gray-700 mb-2">KK Pemilik Usaha: {{ $nomor_kk}}</p>
                    {{-- <p class="text-gray-700 mb-2">Nama Warga: {{ $promosi->nama_warga }}</p> --}}
                    {{-- <p class="text-gray-700 mb-2">NIK: {{ $promosi->nik }}</p> --}}
                    <div class="bg-transparent flex mb-2">
                        <p class="text-gray-700">Status :</p>
                        {{-- Filter status_pengajuan --}}
                        @php
                            $bgColor = '';
                            switch($promosi->status_pengajuan) {
                                case 'tidak aktif':
                                    $bgColor = 'bg-red-600/60';
                                    break;
                                case 'pending':
                                    $bgColor = 'bg-yellow-600/60';
                                    break;
                                case 'aktif':
                                    $bgColor = 'bg-teal-600/60';
                                    break;
                                default:
                                    $bgColor = 'bg-gray-600/60'; // Warna default jika tidak cocok dengan kondisi di atas
                                    break;
                            }
                        @endphp
                        {{-- End filter status_pengajuan --}}
                        <p class="mt-0.5 {{ $bgColor }} text-white px-2 rounded-full inline-block">{{ $promosi->status_pengajuan }}</p>
                    </div>
                    <div class="flex justify-start mt-4">
                        <button class="bg-teal-400 text-teal-900 text-center hover:bg-teal-700 hover:text-white text-sm font-medium px-3 py-1 rounded-full mr-2">Terima</button>
                        <button class="bg-red-400 text-red-900 text-center hover:bg-red-600 hover:text-white text-sm font-medium px-3 py-1 rounded-full">Tolak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ url('admin/promosi') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kembali</a>      
            
    {{-- End informasi usaha warga --}}
    
    @endif
    <!-- end content -->
  </div>
  <!-- end wrapper -->

@include('layout.end')
