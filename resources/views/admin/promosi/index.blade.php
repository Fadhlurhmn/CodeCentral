@include('layout.start')

@include('layout.a_navbar')

<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap ">

  @include('layout.a_sidebar')

  <!-- start content -->
    <div class="bg-white flex-1 md:mt-16 cursor-default">
        {{-- Start Kotak Judul --}}
        <div class="container p-5 bg-white border-t-2 border-teal-500 text-xs flex flex-col items-start">
        @include('layout.breadcrumb2')
        
        <div class="flex justify-between w-full h-8">
            <a href="{{ url('admin/promosi/daftar') }}" class="flex justify-center items-center p-2 font-normal shadow-md bg-teal-300 hover:bg-teal-500 text-xs text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg">Daftar Permintaan</a>
            {{-- Search form --}}
            <form action="{{ url()->current() }}" method="GET" class="flex text-sm font-medium">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari nama usaha..." class="w-40 px-4 py-2 border border-gray-300 rounded-md text-xs">
                <select name="kategori" class="w-32 px-4 py-2 border border-gray-300 rounded-md text-xs ml-2">
                    <option value="Semua" {{ $kategori == 'Semua' ? 'selected' : '' }}>Semua</option>
                    <option value="Kuliner" {{ $kategori == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                    <option value="Fashion" {{ $kategori == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="Retail" {{ $kategori == 'Retail' ? 'selected' : '' }}>Retail</option>
                    <option value="Jasa" {{ $kategori == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                    <option value="Lainnya" {{ $kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-teal-400 text-xs text-teal-900 rounded-md ml-2">Cari</button>
            </form>
        </div>
        {{-- End kotak judul --}}
    </div>

      {{-- Bagian Promosi Usaha Warga --}}
      <div class="grid grid-cols-6 md:grid-cols-3 lg:grid-cols-5 gap-5 p-6 mx-auto bg-white/50 border-t-2 border-teal-400 cursor-default">
       {{-- Pesan ketika tidak ada hasil pencarian --}}
          @if ($promosi->isEmpty())
            <div class="p-4 mb-5 bg-neutral-50 flex justify-center shadow-md rounded-md col-span-full">
              <div class="flex-col text-center">
                <h1 class="text-xl font-bold text-gray-600">No Results Found</h1>
                <p class="text-xs text-gray-500">Tidak ada usaha yang sesuai dengan pencarian Anda.</p>
              </div>
            </div>
          @endif
       @foreach ($promosi as $promosi)
            <div class="rounded-lg shadow-md flex flex-col">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Gambar Usaha"
                        class="w-full h-48 object-cover rounded-t-lg">
                    <div class="mb-2 absolute inset-0 flex items-end justify-center">
                        <form action="{{ url('admin/promosi/'.$promosi->id_promosi.'/show') }}">
                            <button type="submit" class="bg-teal-500/70 py-2 px-4 text-sm font-normal rounded-full text-white transition duration-300 ease-in-out hover:bg-teal-600">
                                Lihat Detail
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-4 flex-1">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $promosi->nama_usaha }}</h2>
                    <div class="mb-2">
                        <p class="text-xs text-gray-600">Lokasi: {{ $promosi->alamat }}</p>
                        <span class="text-xs text-white px-2 py-1 rounded bg-{{ $promosi->status_pengajuan === 'Tolak' ? 'red' : ($promosi->status_pengajuan === 'Menunggu' ? 'yellow' : ($promosi->status_pengajuan === 'Terima' ? 'teal' : 'gray')) }}-600/60 mr-2">{{ $promosi->status_pengajuan }}</span>
                    </div>
                </div>
            </div>
        @endforeach
     </div>
     {{-- End Bagian Promosi Usaha Warga --}}

  <!-- end content -->
</div>
<!-- end wrapper -->
@include('layout.end')
