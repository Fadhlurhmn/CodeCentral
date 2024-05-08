@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap ">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 
    <h1 class="py-5 ml-5 text-3xl text-gray-900 font-bold">{{$breadcrumb->title}}</h1>

    <div class="container p-5 mb-5 bg-teal-600 text-lg grid grid-cols-2 items-center">
      <p class="mb-3 text-white text-xl">{{$page->title}}</p>
      <br>
      <a href="{{ url('admin/promosi/daftar') }}" class="px-3 py-1 bg-teal-400 text-teal-900 text-center text-sm font-medium rounded-full justify-self-start">cek daftar permintaan</a>
    </div>
  
    {{-- Search form --}}
    <form action="{{ url()->current() }}" method="GET" class="mb-4">
      <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari nama usaha..." class="px-4 py-2 border border-gray-300 rounded-md">
      <button type="submit" class="px-4 py-2 bg-teal-400 text-teal-900 rounded-md ml-2">Cari</button>
    </form>
  
    {{-- Place your code here --}}
    <div class="container bg-teal-500 text-lg grid grid-cols-6 gap-5 p-5 mx-auto overflow-y-auto">
        {{-- Bagian Promosi Usaha Warga --}}
          {{-- Usaha warga dari database --}}
            @foreach ($promosi as $umkm)
            <div class="flex flex-grow max-h-84">
              <a href="{{ url('admin/promosi/show/' . $umkm->id_umkm) }}" class="group relative block overflow-hidden rounded-md">
                <img
                  src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                  alt=""
                  class="h-48 w-48 object-cover transition duration-500 group-hover:scale-105 sm:h-72"/>
              
                <div class="relative border border-gray-100 bg-white p-2 h-full">
                  <h2 class="mt-2 text-sm font-semibold text-gray-900">{{$umkm->nama_usaha}}</h2>
                  {{-- <p class="mt-0.5 text-sm text-gray-700">{{$umkm->deskripsi}}</p>
                  <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
                  <p class="mt-0.5 text-xs text-gray-700">{{$umkm->alamat}}</p> --}}
                    {{-- Filter status pengajuan --}}
                      @php
                          $bgColor = '';
  
                          switch($umkm->status_pengajuan) {
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
                      {{-- End filter status --}}
                    <p class="mt-0.5 {{ $bgColor }} text-white px-2 rounded-full inline-block">{{ $umkm->status_pengajuan }}</p>
                  
                  <form action="{{ url('admin/promosi/'.$umkm->id_umkm.'/show') }}" class="my-auto justify-end">
                    <button type="submit" class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition duration-300 ease-in-out hover:bg-teal-500">
                      Lihat Detail
                    </button>
                  </form>
                </div>
              </a>
              {{-- End Usaha warga dari database --}}
              
            </div>
            @endforeach
    </div>
  <!-- end content -->
</div>
<!-- end wrapper -->
@include('layout.end')
