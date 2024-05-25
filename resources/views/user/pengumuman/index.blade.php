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
            Berita & Pengumuman
        </h1>
        <p>
            Selamat datang di halaman Berita dan Pengumuman <span class="font-bold">RW 3 Tlogomas.</span> 
            <br>Temukan informasi terbaru tentang kegiatan dan layanan di lingkungan kami. Pantau terus untuk berita terbaru, kegiatan terbaru, dan pengumuman penting lainnya.
        </p>
    </div>
  </div>
</section>
<!-- end Common hero -->

<section class="section pt-0">
  <div class="container">
    {{-- Berita Teratas --}}
    <h2 class="h4 mb-4">Berita Teratas</h2>
    <div class="featured-posts row">
    @for ($i = 0; $i < 2; $i++)
    <div class="mb-8 md:col-6">
        <div class="card">
          <img
            class="card-img"
            width="235"
            height="304"
            src="images/posts/post-8.png"
            alt=""
          />
          <div class="card-content">
            <h3 class="h4 card-title ease-in-out duration-300 hover:text-primary"> 
              <a href="{{ route('user/pengumuman/show', ['id' => 1]) }}"
                >Menjemput Menuju Surga Dalam Kristen</a
              >
            </h3>
            <p>
              Jalan menuju surga bagi tiap agama pasti berbeda-beda. Ini hanya sebatas pada sebuah kepercayaan...
            </p>
            <div class="card-footer mt-6 flex space-x-4">
              <span class="inline-flex items-center text-xs text-[#666]">
                <svg
                  class="mr-1.5"
                  width="14"
                  height="16"
                  viewBox="0 0 14 16"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12.5 2H11V0.375C11 0.16875 10.8313 0 10.625 0H9.375C9.16875 0 9 0.16875 9 0.375V2H5V0.375C5 0.16875 4.83125 0 4.625 0H3.375C3.16875 0 3 0.16875 3 0.375V2H1.5C0.671875 2 0 2.67188 0 3.5V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V3.5C14 2.67188 13.3281 2 12.5 2ZM12.3125 14.5H1.6875C1.58438 14.5 1.5 14.4156 1.5 14.3125V5H12.5V14.3125C12.5 14.4156 12.4156 14.5 12.3125 14.5Z"
                    fill="#939393"
                  />
                </svg>
                21st Sep,2020
              </span>
              <span class="inline-flex items-center text-xs text-[#666]">
                <i class="fas fa-user ml-1.5 mr-2"></i>
                Pak Haji (RT)
              </span>
            </div>
          </div>
        </div>
      </div> 
    @endfor
    </div>
    {{-- end Berita Teratas --}}

    {{-- Semua Berita --}}
    <h2 class="h4 mb-4">Semua Berita</h2>
    <div class="row">
    @for ($i = 0; $i < 3; $i++)
    <div class="mb-8 md:col-6 lg:col-4">
        <div class="card">
          <img
            class="card-img"
            width="335"
            height="210"
            src="images/posts/post-10.png"
            alt=""
          />
          <div class="card-content">
            <h3 class="h4 card-title ease-in-out duration-300 hover:text-primary">
              <a href="{{ route('user/pengumuman/show', ['id' => 1]) }}">
                STOP GRATIFIKASI!!
              </a>
            </h3>
            <p>
              Topik gratifikasi sedang marak dikalangan masyarakat karena sebuah hadiah saja dapat diindikasikan sebagai gratifikasi.
            </p>
            <div class="card-footer mt-6 flex space-x-4">
              <span class="inline-flex items-center text-xs text-[#666]">
                <svg
                  class="mr-1.5"
                  width="14"
                  height="16"
                  viewBox="0 0 14 16"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M12.5 2H11V0.375C11 0.16875 10.8313 0 10.625 0H9.375C9.16875 0 9 0.16875 9 0.375V2H5V0.375C5 0.16875 4.83125 0 4.625 0H3.375C3.16875 0 3 0.16875 3 0.375V2H1.5C0.671875 2 0 2.67188 0 3.5V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V3.5C14 2.67188 13.3281 2 12.5 2ZM12.3125 14.5H1.6875C1.58438 14.5 1.5 14.4156 1.5 14.3125V5H12.5V14.3125C12.5 14.4156 12.4156 14.5 12.3125 14.5Z"
                    fill="#939393"
                  />
                </svg>
                21st Sep,2020
              </span>
              <span class="inline-flex items-center text-xs text-[#666]">
                <i class="fas fa-user ml-1.5 mr-2"></i>
                Pak Agung (RW)
              </span>
            </div>
          </div>
        </div>
      </div>
    @endfor
    </div>
  </div>
  {{-- end Semua Berita --}}
</section>
@include('layout.footer')

