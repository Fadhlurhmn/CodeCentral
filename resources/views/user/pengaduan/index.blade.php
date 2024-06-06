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
            Pengaduan
        </h1>
        <p>
          Anda dapat mengajukan pengaduan atau keluhan terkait dengan lingkungan dan layanan di RW 3 Tlogomas. Silakan gunakan formulir pengaduan yang tersedia untuk bantuan lebih lanjut.
        </p>
    </div>
  </div>
</section>
<!-- end Common hero -->

{{-- Pengaduan Form --}}
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
                <p class="font-medium leading-tight">Isi Rincian Pengaduan</p>
            </span>
        </li>
      </ol>
      {{-- end navigasi form --}}

      {{-- Section 1: verifikasi data diri --}}
      <form class="px-0 lg:px-60" action="{{ route('verifyDataDiriPengaduan') }}" method="POST" id="verifikasiForm">
        @if (session('error_verifikasi'))
          <div class="alert alert-error">
              {{ session('error_verifikasi') }}
          </div>  
        @endif
        
        @if (session('success_submit'))
          <div class="alert alert-success">
              {{ session('success_submit') }}
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
          <div id="nikError" class="hidden col-span-4 text-red-500 text-xs mt-4">NIK harus diisi dengan 16 karakter</div>
          @error('nik')
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary block w-full" id="verifikasiButton">Verifikasi</button>
      </form>
      {{-- end verifikasi data diri --}}

      {{-- form Pengaduan --}}
      <form class="hidden px-0 lg:px-60" action="{{ route('user.pengaduan.store') }}" method="POST" id="formPengaduan">
        @error('pengaduan')
          <div class="alert alert-error mb-5">
            <span>{{ $message }}</span>
          </div>
        @enderror

        @csrf

        <div class="form-group mb-5">
          <input type="hidden" name="pengirim" value="{{ session('pengirim') }}">

          <div class="form-group mb-5">
            <label class="form-label" for="isi_pengaduan">Isi Pengaduan</label>
            <textarea
                    class="w-full rounded-lg border-border text-dark placeholder:text-[#B0B0B0] focus:border-primary focus:ring-transparent"
                    id="isi_pengaduan"
                    name="isi_pengaduan"
                    rows="10"
                    placeholder="Deskripsikan pengaduan anda"
                    value="{{ old('isi_pengaduan') }}" 
                    maxlength="500"
                    required
                ></textarea>
                {{-- character counter --}}
                <div id="character-counter" class="text-right w-full">
                  <span id="typed-characters">0</span>
                  <span>/</span>
                  <span id="maximum-characters">500</span>
                </div>
            @error('isi_pengaduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="tanggal_pengaduan">Tanggal Kejadian</label>
            <input
                    class="form-control"
                    type="date"
                    id="tanggal_pengaduan"
                    name="tanggal_pengaduan"
                    value="{{ old('tanggal_pengaduan') }}" 
                    required>
            @error('tanggal_pengaduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="penerima_aduan">Sampaikan aduan ke:</label>
            <select name="penerima_aduan" id="penerima_aduan" class="form-select" required>
              <option value="">Pilih penerima aduan</option>
              @foreach ($list_pengurus as $pengurus)
                <option value="{{ $pengurus->id_penduduk }}">{{ $pengurus->level->nama_level }}</option>
              @endforeach
            </select>
            @error('penerima_aduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

        <button
          class="btn btn-primary block w-full"
          type="submit">
          Submit
        </button>
      </form>
      {{-- end form Pengaduan --}}
    </div>
  </div>
</section>
{{-- end Pengaduan Form --}}

@if (session('success_verifikasi'))
  <script>
    document.getElementById('verifikasiForm').style.display = 'none';
    document.getElementById('formPengaduan').style.display = 'block';

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

@push('js')
<script>
  // Script tulisan merah dibawah inputan
  document.getElementById('nik').addEventListener('input', function() {
        var nikInput = this.value;
        var nikError = document.getElementById('nikError');
        
        if (nikInput.length !== 16) {
            nikError.classList.remove('hidden');
        } else {
            nikError.classList.add('hidden');
        }
    });

  // Character counter
  const textAreaElement = document.querySelector("#isi_pengaduan");
  
  const characterCounterElement = document.querySelector("#character-counter");
  
  const typedCharactersElement = document.querySelector("#typed-characters");
  
  const maximumCharacters = 500;
  
  textAreaElement.addEventListener("keyup", (event) => {
      const typedCharacters = textAreaElement.value.length;
      
      if (typedCharacters > maximumCharacters) {
          return false;
      }
      
      typedCharactersElement.textContent = typedCharacters;
      if (typedCharacters >= 450 && typedCharacters < 500) {
          characterCounterElement.classList = "text-yellow-400";
      } else if (typedCharacters >= 500) {
          characterCounterElement.classList = "text-red-400";
      } else {
          characterCounterElement.classList = "text-inherit";
      }
  });
</script>
@endpush

@include('layout.footer')

