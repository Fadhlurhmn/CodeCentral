@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16 cursor-default"> 
    <div class="container p-5 mb-5 bg-white border-t-4 border-teal-500 text-lg flex flex-col items-start">
      <h1 class="py-5 text-3xl text-gray-900 font-bold">{{$breadcrumb->title}}</h1>
        <p class="mb-3 text-xl">{{$page->title}}</p>
        <div class="flex justify-between w-full">
          <a href="{{ url('admin/promosi/') }}" class="px-2 py-1 mb-5 bg-teal-400 text-teal-900 text-center text-sm font-medium rounded-lg transition duration-300 ease-in-out hover:bg-teal-500">Kembali</a>
          {{-- Search form --}}
          <form action="{{ url()->current() }}" method="GET" class="text-sm font-medium ">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari nama usaha..." class="px-4 py-2 border border-gray-300 rounded-md">
            <button type="submit" class="px-4 py-2 bg-teal-400 text-teal-900 rounded-md ml-2">Cari</button>
          </form>
        </div>
    </div>

    {{-- Bagian Daftar Promosi Usaha Warga --}}
    <div class="grid grid-cols-6 md:grid-cols-3 lg:grid-cols-5 gap-5 p-6 mx-auto bg-white/50 border-t-4 border-teal-400 cursor-default shadow-lg">
        @foreach ($promosi as $umkm)
          <div class="rounded-lg shadow-md flex flex-col">
              <div class="relative">
                  <img src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                       alt="Gambar Usaha"
                       class="w-full h-48 object-cover rounded-t-lg">
                  <div class="mb-2 absolute inset-0 flex items-end justify-center">
                      <form action="{{ url('admin/promosi/'.$umkm->id_umkm.'/show') }}">
                          <button type="submit" class="bg-teal-500/70 py-2 px-4 text-sm font-normal rounded-full text-white transition duration-300 ease-in-out hover:bg-teal-600">
                              Lihat Detail
                          </button>
                      </form>
                  </div>
              </div>
              <div class="p-4 flex-1">
                  <h2 class="text-lg font-semibold text-gray-900">{{ $umkm->nama_usaha }}</h2>
                  <div class="mb-2">
                      <p class="text-xs text-gray-600">Lokasi: {{ $umkm->alamat }}</p>
                      <span class="text-xs text-white px-2 py-1 rounded bg-{{ $umkm->status_pengajuan === 'tidak aktif' ? 'red' : ($umkm->status_pengajuan === 'pending' ? 'yellow' : ($umkm->status_pengajuan === 'aktif' ? 'teal' : 'gray')) }}-600/60 mr-2">{{ $umkm->status_pengajuan }}</span>
                  </div>
              </div>
          </div>
      @endforeach
        {{-- End Bagian Usaha Warga --}}
    </div>
  <!-- end content -->
</div>
<!-- end wrapper -->

@include('layout.end')
