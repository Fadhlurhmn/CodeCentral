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
              Promosi
          </h1>
          <p>
            Daftarkan usaha Anda untuk mendapatkan kesempatan promosi produk dan layanan di komunitas kami. Bersama, kita bisa memperkuat perekonomian lokal.
          </p>
      </div>
    </div>
  </section>
  <!-- end Common hero -->

{{-- promosi Form --}}
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
      <form class="px-0 lg:px-60 @if($errors->secondForm->any()) hidden @endif" action="{{ route('verifyDataDiriPromosi') }}" method="POST" id="verifikasiForm">
        @if (session('error_verifikasi'))
          <div class="alert alert-error">
              {{ session('error_verifikasi') }}
          </div>
        @endif

        @if (session('success'))
          <!-- Menampilkan pesan sukses jika ada session 'success' -->
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
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

        <div class="flex justify-between">
          <a href="{{ route('user.promosi') }}" class="text-inherit"><button type="button" class="btn btn-outline-primary block">Kembali</button></a>
          <button type="submit" class="btn btn-primary block" id="verifikasiButton">Verifikasi</button>
        </div>
      </form>
      {{-- end verifikasi data diri --}}

      {{-- form promosi --}}
      @if (session('success_verifikasi') || $errors->secondForm->any())
      <form class="px-0 lg:px-60" action="{{ route('user.promosi.store') }}" method="POST" id="formPromosi" enctype="multipart/form-data">
        @if($errors->secondForm->any())
          <div class="alert alert-error mb-5">
            @foreach ($errors->secondForm->all() as $error)
                <span>{{ $error }}</span><br>
            @endforeach
          </div>
        @endif

        @csrf

        <div class="form-group mb-5">
          <input type="hidden" name="pengirim_promosi" value="{{ session('pengirim_promosi') }}">

          <div class="form-group mb-5">
            <label class="form-label" for="nama_usaha">Nama Usaha<span class="text-red-500">*</span></label>
            <input
              class="form-control"
              type="text"
              id="nama_usaha"
              name="nama_usaha"
              placeholder="Masukkan nama usaha anda"
              value="{{ old('nama_usaha') }}"
              maxlength="100"
              required
            />
            {{-- character counter --}}
            <div id="character-counter" class="text-right w-full">
              <span id="typed-characters">0</span>
              <span>/</span>
              <span id="maximum-characters">100</span>
            </div>
            @error('nama_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="deskripsi_usaha">Deskripsi Usaha<span class="text-red-500">*</span></label>
            <textarea
                    class="w-full rounded-lg border-border text-dark placeholder:text-[#B0B0B0] focus:border-primary focus:ring-transparent"
                    id="deskripsi_usaha"
                    name="deskripsi_usaha"
                    rows="10"
                    placeholder="Deskripsikan usaha anda"
                    value="{{ old('deskripsi_usaha') }}"
                    maxlength="500"
                    required
                >{{ old('deskripsi_usaha') }}</textarea>
                {{-- character counter --}}
                <div id="character-counter2" class="text-right w-full">
                  <span id="typed-characters2">0</span>
                  <span>/</span>
                  <span id="maximum-characters2">500</span>
                </div>
            @error('deskripsi_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="jenis_usaha">Kategori Usaha<span class="text-red-500">*</span></label>
            <select name="jenis_usaha" id="jenis_usaha" class="form-select" required>
              <option value="">Pilih kategori usaha</option>
              <option value="Kuliner">Kuliner</option>
              <option value="Fashion">Fashion</option>
              <option value="retail">Retail</option>
              <option value="Jasa">Jasa</option>
              <option value="Lainnya">Lainnya</option>
            </select>
            @error('jenis_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="no_telp">Nomor Telepon<span class="text-red-500">*</span></label>
            <input
              class="form-control"
              type="number"
              id="no_telp"
              name="no_telp"
              placeholder="Masukkan nomor telepon anda"
              value="{{ old('no_telp') }}"
              maxlength="20"
              required
            />
            <div id="character-counter-no-telp" class="text-right w-full">
              <span id="typed-characters-no-telp">0</span>
              <span>/</span>
              <span id="maximum-characters-no-telp">20</span>
            </div>
            @error('no_telp')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="alamat">Alamat Usaha<span class="text-red-500">*</span></label>
            <textarea
              class="w-full rounded-lg border-border text-dark placeholder:text-[#B0B0B0] focus:border-primary focus:ring-transparent"
              id="alamat"
              name="alamat"
              rows="3"
              placeholder="Masukkan alamat usaha anda"
              maxlength="100"
              required
            >{{ old('alamat') }}</textarea>
            <div id="character-counter-alamat" class="text-right w-full">
              <span id="typed-characters-alamat">0</span>
              <span>/</span>
              <span id="maximum-characters-alamat">100</span>
            </div>
            @error('alamat')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group mb-5">
            <label class="form-label" for="gambar">Foto Usaha (MAX 2MB)<span class="text-red-500">*</span></label>
            <input
                class="block h-[60px] w-full text-sm border border-gray-200 bg-white text-dark rounded-lg cursor-pointer focus:outline-none file:rounded-l-lg file:text-dark file:h-[60px] file:px-4 file:border-0"
                type="file"
                id="gambar"
                name="gambar"
                value="{{ old('gambar') }}">
            @error('gambar')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

        <div class="flex justify-between">
          <a href="{{ route('user.promosi.create') }}" class="text-inherit"><button type="button" class="btn btn-outline-primary block">Kembali</button></a>
          <button type="submit" class="btn btn-primary block">Kirim</button>
        </div>
      </form>
      @endif
      {{-- end form promosi --}}
    </div>
  </div>
</section>
{{-- end promosi Form --}}

@if (session('success_verifikasi'))
  <script>
    document.getElementById('verifikasiForm').style.display = 'none';
    document.getElementById('formPromosi').style.display = 'block';

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

  // Character counter untuk nama usaha
  const namaUsahaElement = document.querySelector("#nama_usaha");
  const characterCounterNamaUsaha = document.querySelector("#character-counter");
  const typedCharactersNamaUsaha = document.querySelector("#typed-characters");
  const maximumCharactersNamaUsaha = 100;

  namaUsahaElement.addEventListener("keyup", (event) => {
      const typedCharacters = namaUsahaElement.value.length;

      if (typedCharacters > maximumCharactersNamaUsaha) {
          return false;
      }

      typedCharactersNamaUsaha.textContent = typedCharacters;
      if (typedCharacters >= 90 && typedCharacters < 100) {
          characterCounterNamaUsaha.classList = "text-right w-full text-yellow-400";
      } else if (typedCharacters >= 100) {
          characterCounterNamaUsaha.classList = "text-right w-full text-red-400";
      } else {
          characterCounterNamaUsaha.classList = "text-right w-full text-inherit";
      }
  });

  // Character counter untuk deskripsi usaha
  const deskripsiUsahaElement = document.querySelector("#deskripsi_usaha");
  const characterCounterDeskripsiUsaha = document.querySelector("#character-counter2");
  const typedCharactersDeskripsiUsaha = document.querySelector("#typed-characters2");
  const maximumCharactersDeskripsiUsaha = 500;

  deskripsiUsahaElement.addEventListener("keyup", (event) => {
      const typedCharacters = deskripsiUsahaElement.value.length;

      if (typedCharacters > maximumCharactersDeskripsiUsaha) {
          return false;
      }

      typedCharactersDeskripsiUsaha.textContent = typedCharacters;
      if (typedCharacters >= 450 && typedCharacters < 500) {
          characterCounterDeskripsiUsaha.classList = "text-right w-full text-yellow-400";
      } else if (typedCharacters >= 500) {
          characterCounterDeskripsiUsaha.classList = "text-right w-full text-red-400";
      } else {
          characterCounterDeskripsiUsaha.classList = "text-right w-full text-inherit";
      }
  });

  // Character counter untuk nomor telepon
  const noTelpElement = document.querySelector("#no_telp");
  const characterCounterNoTelp = document.querySelector("#character-counter-no-telp");
  const typedCharactersNoTelp = document.querySelector("#typed-characters-no-telp");
  const maximumCharactersNoTelp = 20;

  noTelpElement.addEventListener("keyup", (event) => {
      const typedCharacters = noTelpElement.value.length;

      if (typedCharacters > maximumCharactersNoTelp) {
          return false;
      }

      typedCharactersNoTelp.textContent = typedCharacters;
      if (typedCharacters >= 15 && typedCharacters < 20) {
          characterCounterNoTelp.classList = "text-right w-full text-yellow-400";
      } else if (typedCharacters >= 20) {
          characterCounterNoTelp.classList = "text-right w-full text-red-400";
      } else {
          characterCounterNoTelp.classList = "text-right w-full text-inherit";
      }
  });
  
  // Character counter untuk alamat usaha
  const alamatElement = document.querySelector("#alamat");
  const characterCounterAlamat = document.querySelector("#character-counter-alamat");
  const typedCharactersAlamat = document.querySelector("#typed-characters-alamat");
  const maximumCharactersAlamat = 100;

  alamatElement.addEventListener("keyup", (event) => {
      const typedCharacters = alamatElement.value.length;

      if (typedCharacters > maximumCharactersAlamat) {
          return false;
      }

      typedCharactersAlamat.textContent = typedCharacters;
      if (typedCharacters >= 90 && typedCharacters < 100) {
          characterCounterAlamat.classList = "text-right w-full text-yellow-400";
      } else if (typedCharacters >= 100) {
          characterCounterAlamat.classList = "text-right w-full text-red-400";
      } else {
          characterCounterAlamat.classList = "text-right w-full text-inherit";
      }
  });
</script>
@endpush

@include('layout.footer')
