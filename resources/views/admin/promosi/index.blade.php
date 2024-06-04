@include('layout.start')

@include('layout.a_navbar')

<!-- start wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 md:mt-16 cursor-default">
    {{-- Start Kotak Judul --}}
    <div class="p-5 bg-white border-t-2 border-teal-500 text-xs flex flex-col">
      @include('layout.breadcrumb2')

      <div class="flex justify-between w-full">
        <a href="{{ url('admin/promosi/daftar') }}" class="p-2 mr-5 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg">cek daftar permintaan</a>
        {{-- Search form --}}
        <form action="{{ url()->current() }}" method="GET" class="text-sm font-medium">
          <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari nama usaha..." class="px-4 py-2 border border-gray-300 rounded-md text-xs">
          <button type="submit" class="px-4 py-2 bg-teal-400 text-xs text-teal-900 rounded-md ml-2">Cari</button>
        </form>
      </div>
      {{-- End kotak judul --}}
    </div>

    
    {{-- Bagian Promosi Usaha Warga --}}
    <div>

    </div>
    {{-- Pesan ketika tidak ada hasil pencarian --}}
    {{-- @if ($promosi->isEmpty())
      <div class="p-4 mb-5 bg-neutral-50 flex justify-center shadow-md rounded-md">
        <div class="flex-col text-center">
          <h1 class="text-xl font-bold text-gray-600">No Results Found</h1>
          <p class="text-xs text-gray-500">Tidak ada usaha yang sesuai dengan pencarian Anda.</p>
        </div>
      </div>
    @endif --}}
    <div class="grid grid-cols-6 md:grid-cols-3 lg:grid-cols-5 gap-5 p-6 mx-auto bg-white/50 border-t-2 border-teal-400 cursor-default">
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
              <span class="text-xs text-white px-2 py-1 rounded bg-{{ $umkm->status_pengajuan === 'tolak' ? 'red' : ($umkm->status_pengajuan === 'pending' ? 'yellow' : ($umkm->status_pengajuan === 'acc' ? 'teal' : 'gray')) }}-600/60 mr-2">{{ $umkm->status_pengajuan }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    {{-- End Bagian Promosi Usaha Warga --}}
  </div>
  <!-- end content -->
</div>
<!-- end wrapper -->
@include('layout.end')
