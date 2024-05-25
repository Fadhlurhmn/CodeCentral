@include('layout.head')
@include('layout.u_navbar')
<!-- floating assets -->
<img
  class="floating-bubble-1 absolute right-0 top-0 -z-[1]"
  src="{{ asset('images/floating-bubble-1.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]"
  src="{{ asset('images/floating-bubble-2.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]"
  src="{{ asset('images/floating-bubble-3.svg') }}"
  alt=""
/>
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero pt-16 pb-10">
  <div class="container">
    <div class="page-hero-content mx-auto max-w-[768px] text-center">
      <h1 class="mb-5 mt-8">
        Surat
      </h1>
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
    <div class="row mt-10 integration-tab-items">
    @for ($i = 0; $i < 3; $i++)
      <div class="mb-8 md:col-6 lg:col-4 integration-tab-item" data-groups='["social"]'>
        <div class="rounded-xl bg-white px-10 pt-11 pb-8 shadow-lg">
          <div class="integration-card-head flex items-center space-x-4">
            <div>
              <h4 class="h4">Surat Pengantar SKCK</h4>
            </div>
          </div>
          <div class="my-5 border-y border-border py-5">
            <p>
              Surat pengantar ini bisa digunakan untuk keperluan pengurusan SKCK pada kepolisian.
            </p>
          </div>
          <a
          class="btn btn-outline-primary block min-w-[20px] sm:inline-block"
          href="#">Unduh</a>
        </div>
      </div>
    @endfor
    </div>
  </div>
</section>
<!-- ./end Surat -->
@include('layout.footer')
