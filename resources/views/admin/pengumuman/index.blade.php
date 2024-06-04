@include('layout.start')

@include('layout.a_navbar')

<!-- Start wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  @include('layout.a_sidebar')

  <!-- Start content -->
  <div class="bg-white flex-1 md:mt-16 border-t-2 border-teal-500 cursor-default">
    <div class="p-5 pb-0 flex flex-col">
      @include('layout.breadcrumb2')
    </div>

    <div class="container p-5 mb-5 bg-white text-sm flex flex-col items-start">
      <p class="mb-3 text-lg">{{ $page->title }}</p>
      <div class="text-xs flex justify-between w-full">
        <a class="p-2 mr-5 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg" href="{{ url('admin/pengumuman/create') }}">Tambah Pengumuman</a>
        {{-- Search form --}}
        <form action="{{ url()->current() }}" method="GET" class="font-medium flex items-center relative">
          <div class="relative flex items-center w-full">
            <input type="text" name="query" id="searchInput" value="{{ request('query') }}" placeholder="Cari pengumuman" class="search-input px-4 py-2 border border-gray-300 rounded-md w-full">
            <span id="clearSearch" class="clear-search absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400 hover:text-gray-600 text-2xl">&times;</span>
          </div>
          <button type="submit" class="px-4 py-2 bg-teal-400 text-teal-900 rounded-md ml-2">Cari</button>
        </form>
      </div>
    </div>

    @if (session('success'))
    <!-- Menampilkan pesan sukses jika ada session 'success' -->
    <div class="col-span-4 mb-4 px-4">
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    </div>
    @endif
    {{-- Bagian pengumuman Warga --}}
    <div class="h-fit grid grid-cols-1 gap-5 p-6 mx-auto bg-white/50 border-t-2 border-teal-400 cursor-default">
      
      {{-- Pesan ketika tidak ada hasil pencarian --}}
      <div class="p-4 mb-5 bg-neutral-50 flex justify-center shadow-md rounded-md {{ $pengumuman->isEmpty() ? '' : 'hidden' }}" id="noResults">
        <div class="flex-col text-center">
              <h1 class="text-xl font-bold text-gray-600">No Results Found</h1>
              <p class="text-xs text-gray-500">Tidak ada Pengumuman yang sesuai dengan pencarian Anda.</p>
        </div>
      </div>
      
      @foreach ($pengumuman as $pengumumans)
      <div class="rounded-lg shadow-md flex flex-row border-b-2 border-teal-500">
        @if($pengumumans->thumbnail)
        <div class="p-4">
          <img src="{{ asset('pengumuman_thumbnail/' . $pengumumans->thumbnail) }}" alt="{{ $pengumumans->judul_pengumuman }}" class="w-16 h-16 object-cover rounded-lg">
        </div>
        @endif
        <div class="p-4 flex-1">
          <h2 class="text-lg font-semibold text-gray-900">{{ $pengumumans->judul_pengumuman }}</h2>
          <p class="text-xs text-gray-600">Penulis: {{ $pengumumans->user->username }}</p>
          <div class="mb-2">
            <p class="text-xs text-gray-600">Tanggal penulisan: {{ $pengumumans->created_at }}</p>
          </div>
        </div>
        <div class="mr-4 flex flex-row items-center justify-center">
          <form action="{{ url('admin/pengumuman/' . $pengumumans->id_pengumuman . '/show') }}">
            <button type="submit" class="bg-teal-500/70 py-2 px-4 mr-2 text-sm font-normal rounded-full text-white transition duration-300 ease-in-out hover:bg-teal-600">
              Preview
            </button>
          </form>
          <form action="{{ url('admin/pengumuman/' . $pengumumans->id_pengumuman . '/edit') }}">
            <button type="submit" class="bg-yellow-200 py-2 px-4 text-sm font-normal rounded-full text-yellow-500 transition duration-300 ease-in-out hover:bg-yellow-300">
              <i class="fas fa-edit"></i>
            </button>
          </form>
        </div>
      </div>
      @endforeach
    </div>

    @push('js')
    <script>
      document.addEventListener('DOMContentLoaded', (event) => {
        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');

        clearSearch.addEventListener('click', () => {
          searchInput.value = '';
          searchInput.focus();
        });

        // Tampilkan ikon hapus hanya jika ada teks di kotak pencarian
        searchInput.addEventListener('input', () => {
          clearSearch.style.display = searchInput.value ? 'block' : 'none';
        });

        // Sembunyikan ikon hapus secara awal jika kotak pencarian kosong
        if (!searchInput.value) {
          clearSearch.style.display = 'none';
        }
      });
    </script>
    @endpush
  </div>
  <!-- End content -->
</div>
<!-- End wrapper -->
@include('layout.end')
