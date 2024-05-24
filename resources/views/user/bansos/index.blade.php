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
            Bansos
        </h1>
        <p>
            Selamat datang di halaman Bantuan Sosial <span class="font-bold">RW 3 Tlogomas.</span>  
            <br>Di sini Anda dapat menemukan informasi terkini mengenai program bantuan sosial yang tersedia bagi warga. Temukan detail tentang berbagai jenis bantuan, syarat dan cara pengajuan, serta jadwal distribusi bantuan sosial.
        </p>
    </div>
  </div>
</section>
<!-- end Common hero -->

{{-- Bansos Form --}}
<section class="section pt-0">
  <div class="flex container">
    <div class="justify-center md:col-6 md:order-1">
      <form class="" action="#" method="POST">
        <div class="form-group mb-5">
          <label class="form-label" for="nama">Nama</label>
          <input
            class="form-control"
            type="text"
            id="nama"
            name="nama"
            placeholder="Masukkan nama lengkap anda" 
            value="{{ old('nama') }}"
          />
          @error('nama')
              <small class="text-red-500 text-sm ml-3">Masukkan nama yg benar ajg</small>
          @enderror
        </div>
        <div class="form-group mb-5">
          <label class="form-label" for="nik">NIK</label>
          <input
            class="form-control"
            type="number"
            id="nik"
            name="nik"
            placeholder="Masukkan NIK anda"
            value="{{ old('nik') }}"
          />
          @error('nik')
              <small class="text-red-500 text-sm ml-3">Masukkan nama yg benar ajg</small>
          @enderror
        </div>
        <div class="form-group mb-5">
          <label class="form-label" for="jenis_bansos">Jenis Bansos</label>
          <select name="jenis_bansos" id="jenis_bansos" class="form-select" required>
            <option value="">Pilih bansos</option>
            <option value="Bansos-1">Bansos-1</option>
            <option value="Bansos-2">Bansos 2</option>
            <option value="Bansos-3">Bansos 3</option>
          </select>
          @error('jenis_bansos')
              <small class="text-red-500 text-sm ml-3">Masukkan nama yg benar ajg</small>
          @enderror
        </div>
        <button
          class="btn btn-primary block w-full"
          type="submit">
          Submit
        </button>
      </form>
    </div>
  </div>
</section>
{{-- end Bansos Form --}}

@include('layout.footer')
@include('layout.foot')
