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

<!-- blog single -->
<section class="section blog-single">
  <div class="container">
    <div class="row justify-center">
      <div class="mt-10 max-w-[810px] lg:col-9">
        <h1 class="h2">
            {{ $pengumuman->judul_pengumuman }}
        </h1>
        <div class="mt-6 mb-5 flex items-center space-x-2">
          <div class="">
            <p class="text-dark">{{ $pengumuman->user->username }}</p>
            <span class="text-sm">{{ $pengumuman->created_at->format('d M, Y') }}</span>
          </div>
        </div>
        <div class="content text-justify">
            {!! $pengumuman->deskripsi !!}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ./end blog-single -->
@include('layout.footer')


