@include('layout.head')
@include('layout.u_navbar')

<!-- floating assets -->
<img class="floating-bubble-1 absolute right-0 top-0 -z-[1]" src="{{ asset('images/floating-bubble-1.svg') }}" alt="Bubble 1" />
<img class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]" src="{{ asset('images/floating-bubble-2.svg') }}" alt="Bubble 2" />
<img class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]" src="{{ asset('images/floating-bubble-3.svg') }}" alt="Bubble 3" />
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero pt-16 pb-14">
    <div class="container">
      <div class="page-hero-content mx-auto max-w-[768px] text-center">
          <h1 class="mb-5 mt-8">
              Bansos
          </h1>
          <p>
              Anda dapat menemukan informasi terkini mengenai program bantuan sosial yang tersedia bagi warga. Temukan detail tentang berbagai jenis bantuan, syarat dan cara pengajuan, serta jadwal distribusi bantuan sosial.
          </p>
      </div>
    </div>
</section>
<!-- end Common hero -->

<!-- List Kategori Bansos -->
<section class="section pt-0">
  <div class="container">
    {{-- Menampilkan semua list_kategori --}}
    <div class="row mt-10 integration-tab-items">
      @forelse($list_kategori as $item)
        <div class="mb-8 md:col-4 lg:col-3 integration-tab-item" data-groups='["social"]'>
            <div class="rounded-xl bg-white px-10 pt-11 pb-8 shadow-lg">
                <div class="integration-card-head flex items-center space-x-4">
                    <div>
                        <a href="{{ route('user.bansos.list.detail', $item->id_kategori_bansos) }}" class="text-black">
                            <h4 class="hover:text-primary ease-in-out duration-300">{{ $item->nama_kategori }}</h4>
                        </a>
                    </div>
                </div>
                <p>Pengirim:<br> {{ $item->pengirim }}</p>
            </div>
        </div>
      @empty
        <p class="text-xl text-center font-bold text-gray-600">Tidak ada Bansos yang Tersedia</p>
      @endforelse
    </div>
  </div>
</section>
<!-- end List Kategori Bansos -->
@include('layout.footer')
