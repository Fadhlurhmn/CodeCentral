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
          <a class="filter-btn filter-btn-active btn btn-sm hover:filter-btn-active" href="#"
            >Semua Kategori</a
          >
        </li>
        <li>
          <a class="filter-btn btn btn-sm hover:filter-btn-active" href="#">FnB</a>
        </li>
        <li>
          <a class="filter-btn btn btn-sm hover:filter-btn-active" href="#">Fashion</a>
        </li>
        <li> 
          <a class="filter-btn btn btn-sm hover:filter-btn-active" href="#">Jasa</a>
        </li>
        <li>
          <a class="filter-btn btn btn-sm hover:filter-btn-active" href="#">Kerajinan</a>
        </li>
        <li>
          <a class="filter-btn btn btn-sm hover:filter-btn-active" href="#">Lainnya</a>
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
          <button data-modal-target="large-modal" data-modal-toggle="large-modal" class="" type="button">
          <img
            class="card-img hover:opacity-30"
            width="335"
            height="210"
            src="images/posts/post-5.png"
            alt=""
          />
        </button>
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

      <!-- UMKM Modal -->
      <div id="large-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden bg-black/30 overflow-y-auto ease-in-out duration-300 md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 lg:p-2 border-b rounded-t">
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="large-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                  <div class="row">
                    <div class="col-6">
                      <img
                      class="card-img"
                      width="335"
                      height="210"
                      src="images/posts/post-5.png"
                      alt=""
                    />
                    </div>
                    <div class="col-6">
                      <h3>Nama Usaha</h3>
                      <small class="mb-4">Kategori: Kerajinan</small>
                      <p>
                          HP pak budi bisa didapatkan di alamat berikut <a href="https://www.google.com">Google Maps</a>
                      </p>
                    </div>
                  </div>
                </div>
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
