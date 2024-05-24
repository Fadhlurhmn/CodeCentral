@include('layout.head')
@include('layout.header')
<!-- floating assets -->
<img
  class="floating-bubble-1 absolute right-0 top-0 -z-[1]"
  src="images/floating-bubble-1.svg"
  alt=""
/>
<img
  class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]"
  src="images/floating-bubble-2.svg"
  alt=""
/>
<img
  class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]"
  src="images/floating-bubble-3.svg"
  alt=""
/>
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero pt-16 pb-14">
  <div class="container">
    <div class="page-hero-content mx-auto max-w-[768px] text-center">
        <h1 class="mb-5 mt-8">
            UMKM
        </h1>
        <p>
          Selamat datang di halaman UMKM <span class="font-bold">RW 3 Tlogomas.</span> 
          <br>Di sini, Anda dapat menemukan berbagai produk dan layanan unggulan dari pelaku UMKM di lingkungan kami. Dukung usaha lokal untuk memperkuat perekonomian UMKM.
        </p>
        <a class="btn btn-primary mt-4" href="{{ route('user/umkm/create') }}">Promosikan Usaha Anda</a>
    </div>
  </div>
</section>
<!-- end Common hero -->

<section class="section pt-0">
  <div class="container">
    {{-- Categories --}}
    <div class="category-filter mb-10 mt-3 rounded-xl bg-[#EEEEEE] px-4">
      <ul class="filter-list">
        <li>
          <a class="filter-btn filter-btn-active btn btn-sm" href="#"
            >Semua Kategori</a
          >
        </li>
        <li>
          <a class="filter-btn btn btn-sm" href="#">FnB</a>
        </li>
        <li>
          <a class="filter-btn btn btn-sm" href="#">Fashion</a>
        </li>
        <li>
          <a class="filter-btn btn btn-sm" href="#">Jasa</a>
        </li>
        <li>
          <a class="filter-btn btn btn-sm" href="#">Kerajinan</a>
        </li>
        <li>
          <a class="filter-btn btn btn-sm" href="#">Lainnya</a>
        </li>
      </ul>
    </div>
    {{-- end Categories --}}

    {{-- Semua UMKM --}}
    <div class="row">
    @for ($i = 0; $i < 3; $i++)
    <div class="mb-8 md:col-6 lg:col-4">
        <div class="card">
          <img
            class="card-img"
            width="335"
            height="210"
            src="images/posts/post-5.png"
            alt=""
          />
          <div class="card-content">
            <div class="card-tags">
              <a class="tag" href="#">Kerajinan</a>
            </div>
            <h3 class="h4 card-title">
              <a href="{{ route('user/pengumuman/show', ['id' => 1]) }}">
                HP ODDO Pak Supri
              </a>
            </h3>
            <p>
              HP ASLI, DIJAMIN BUKAN KW, KWALITAS TOP!!
            </p>
          </div>
          <div class="card-footer mt-2 flex space-x-4">
            <span class="inline-flex items-center text-[#666]">
              <i class="fab fa-facebook text-md mr-2"></i>
              <p class="text-xs">hp.paksupri</p>
            </span>
          </div>
        </div>
      </div>
    @endfor
    </div>
  </div>
  {{-- end Semua UMKM --}}
</section>
@include('layout.footer')
@include('layout.foot')
