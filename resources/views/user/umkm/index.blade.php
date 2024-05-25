@include('layout.head')
@include('layout.u_navbar')
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

{{-- Main --}}
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

    {{-- search bar --}}
    <form class="mb-4">
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
              <input type="search" id="search-input" class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-lg focus:border-primary" placeholder="Cari UMKM lokal..." required />
              <button type="submit" class="text-black absolute end-2.5 bottom-2.5 bg-primary focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Search</button>
          </div>
        </div>
      </div>
    </form>
    {{-- end search bar --}}

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
              HP ODDO Pak Supri
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
{{-- end Main --}}
@include('layout.footer')

