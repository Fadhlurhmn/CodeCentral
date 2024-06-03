@include('layout.head')
@include('layout.u_navbar')

<!-- floating assets -->
<img class="floating-bubble-1 absolute right-0 top-0 -z-[1]" src="{{ asset('images/floating-bubble-1.svg') }}" alt="Bubble 1" />
<img class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]" src="{{ asset('images/floating-bubble-2.svg') }}" alt="Bubble 2" />
<img class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]" src="{{ asset('images/floating-bubble-3.svg') }}" alt="Bubble 3" />
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero pt-16 pb-10">
  <div class="container">
    <div class="page-hero-content mx-auto max-w-[768px] text-center">
      <h1 class="mb-5 mt-8">Surat</h1>
      <p>
        Selamat datang di halaman Surat <span class="font-bold">RW 3 Tlogomas</span>
        <br>Di sini Anda dapat menemukan berbagai jenis surat yang umum dibutuhkan di tingkat RW dan RT. Untuk kemudahan Anda, kami telah menyediakan file surat yang bisa langsung diunduh. Silakan pilih dan unduh surat yang Anda butuhkan.
      </p>
    </div>
  </div>
</section>
<!-- end Common hero -->

<!-- Surat -->
<section class="section pt-0">
  <div class="container">
    {{-- Menampilkan search bar jika ada surat --}}
    @if(!$surat->isEmpty())
      <form class="mb-4" method="GET" action="{{ route('user.surat') }}">
        <div class="row">
          <div class="bg-black opacity-0 lg:col-6"></div>
          <div class="col-12 lg:col-6">
            <label for="search-input" class="mb-2 text-sm font-medium sr-only">Search</label>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
              </div>
              <input type="search" id="search-input" name="query" class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-lg focus:border-primary" placeholder="Cari Surat..." required />
              <button type="submit" class="text-black absolute end-2.5 bottom-2.5 bg-primary focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
          </div>
        </div>
      </form>
    @endif
    {{-- end search bar --}}

    {{-- Menampilkan semua surat --}}
    <div class="row mt-10 integration-tab-items">
      @forelse($surat as $item)
        <div class="mb-8 md:col-6 lg:col-4 integration-tab-item" data-groups='["social"]'>
          <div class="rounded-xl bg-white px-10 pt-11 pb-8 shadow-lg">
            <div class="integration-card-head flex items-center space-x-4">
              <div>
                <h4 class="h4">{{ $item->nama_surat }}</h4>
              </div>
            </div>
            <div class="my-5 border-y border-border py-5">
              <p>{{ $item->deskripsi }}</p>
            </div>
            <a class="btn btn-outline-primary block min-w-[20px] sm:inline-block download-surat" href="{{ url('/surat/download/' . $item->id_surat) }}">Unduh</a>
          </div>
        </div>
      @empty
        <p class="text-center font-bold">Tidak ada surat yang tersedia</p>
      @endforelse
    </div>
  </div>
</section>
<!-- ./end Surat -->
@include('layout.footer')
