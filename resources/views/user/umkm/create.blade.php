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
<section class="page-hero pt-16 pb-14">
    <div class="container">
      <div class="page-hero-content mx-auto max-w-[768px] text-center">
          <h1 class="mb-5 mt-8">
              UMKM
          </h1>
          <p>
            Anda dapat menemukan berbagai produk dan layanan unggulan dari pelaku UMKM di lingkungan kami. Dukung usaha lokal untuk memperkuat perekonomian UMKM.
          </p>
      </div>
    </div>
  </section>
  <!-- end Common hero -->

{{-- Umkm Form --}}
<section class="section pt-0">
  <div class="container">
    <div class="col-12 md:order-1">

      {{-- navigasi form --}}
      <ol class="items-center w-full space-y-4 mb-5 px-0 lg:px-60 sm:flex sm:space-x-8 sm:space-y-0">
        <li class="flex items-center text-primary space-x-2.5" id="stepper-1">
            <span class="flex items-center justify-center w-8 h-8 border border-primary rounded-full shrink-0" id="number-1">
                1
            </span>
            <span>
                <p class="font-medium leading-tight">Verifikasi Data Diri</p>
            </span>
        </li>
        <li class="flex items-center text-gray-500 space-x-2.5" id="stepper-2">
            <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0" id="number-2">
                2
            </span>
            <span>
                <p class="font-medium leading-tight">Pengisian Rincian Usaha</p>
            </span>
        </li>
      </ol>
      {{-- end navigasi form --}}

      {{-- Section 1: verifikasi data diri --}}
      <form class="px-0 lg:px-60" action="{{ route('verifyDataDiriUmkm') }}" method="POST" id="verifikasiForm">
        @if (session('error_verifikasi'))
          <div class="alert alert-error">
              {{ session('error_verifikasi') }}
          </div>  
        @endif
        
        @csrf

        <div class="form-group mb-5">
          <label class="form-label mt-3" for="nama_penduduk">Nama Pengirim</label>
          <input
            class="form-control"
            type="text"
            id="nama_penduduk"
            name="nama_penduduk"
            placeholder="Masukkan Nama lengkap" 
            value="{{ old('nama_penduduk') }}"
          />
          @error('nama_penduduk')
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group mb-5">
          <label class="form-label mt-3" for="nik">NIK</label>
          <input
            class="form-control"
            type="number"
            id="nik"
            name="nik"
            placeholder="Masukkan NIK"
            value="{{ old('nik') }}"
          />
          @error('nik')
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary block w-full" id="verifikasiButton">Verifikasi</button>
      </form>
      {{-- end verifikasi data diri --}}

      {{-- form Umkm --}}
      <form class="hidden px-0 lg:px-60" action="{{ route('user.umkm.store') }}" method="POST" id="formUmkm">
        @error('umkm')
          <div class="alert alert-error mb-5">
            <span>{{ $message }}</span>
          </div>
        @enderror

        @csrf

        <div class="form-group mb-5">
          <input type="hidden" name="pengirim" value="{{ session('pengirim_umkm') }}">

          <div class="form-group mb-5">
            <label class="form-label" for="nama_usaha">Nama Usaha</label>
            <input
              class="form-control"
              type="text"
              id="nama_usaha"
              name="nama_usaha"
              placeholder="Masukkan nama usaha anda"
              value="{{ old('nama_usaha') }}"
              required
            />
            @error('nama_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="deskripsi_usaha">Deskripsi Usaha</label>
            <textarea
                    class="w-full rounded-lg border-border text-dark placeholder:text-[#B0B0B0] focus:border-primary focus:ring-transparent"
                    id="deskripsi_usaha"
                    name="deskripsi_usaha"
                    rows="10"
                    placeholder="Deskripsikan usaha anda"
                    value="{{ old('deskripsi_usaha') }}" 
                    maxlength="200"
                    required
                ></textarea>
            @error('deskripsi_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="jenis_usaha">Jenis usaha</label>
            <select name="jenis_usaha" id="jenis_usaha" class="form-select" required>
              <option value="">Pilih jenis usaha</option>
              <option value="fnb">FnB</option>
              <option value="Fashion">Fashion</option>
              <option value="Jasa">Jasa</option>
              <option value="Kerajinan">Kerajinan</option>
              <option value="Lainnya">Lainnya</option>
            </select>
            @error('jenis_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="berkas_usaha">Foto Usaha (MAX 2MB)</label>
            <input
                class="block h-[60px] w-full text-sm border border-gray-200 bg-white text-dark rounded-lg cursor-pointer focus:outline-none file:rounded-l-lg file:text-dark file:h-[60px] file:px-4 file:border-0"
                type="file"
                id="berkas_usaha"
                name="berkas_usaha"
                value="{{ old('berkas_usaha') }}">
            @error('berkas_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
        </div>

        <button
          class="btn btn-primary block w-full"
          type="submit">
          Submit
        </button>
      </form>
      {{-- end form Umkm --}}
    </div>
  </div>
</section>
{{-- end Umkm Form --}}

@if (session('success_verifikasi'))
  <script>
    document.getElementById('verifikasiForm').style.display = 'none';
    document.getElementById('formUmkm').style.display = 'block';

    document.getElementById('stepper-1').classList.remove('text-primary');
    document.getElementById('stepper-1').classList.add('text-gray-500');
    document.getElementById('stepper-2').classList.remove('text-gray-500');
    document.getElementById('stepper-2').classList.add('text-primary');

    document.getElementById('number-1').classList.remove('border-primary');
    document.getElementById('number-1').classList.add('border-gray-500');
    document.getElementById('number-2').classList.remove('border-gray-500');
    document.getElementById('number-2').classList.add('border-primary');
  </script>
@endif

@include('layout.footer')

