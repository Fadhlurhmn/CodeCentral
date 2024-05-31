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
  <div class="container">
    <div class="col-12 md:order-1">
      {{-- verifikasi data diri --}}
      <form class="px-0 lg:px-60" action="{{ route('verifyDataDiri') }}" method="POST" id="verifikasiForm">
        @error('bansos')
          <div class="alert alert-error mb-5">
            <span>{{ $message }}</span>
          </div>
        @enderror
        @csrf

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
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
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
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary block w-full" id="verifikasiButton">Verifikasi</button>
      </form>
      {{-- end verifikasi data diri --}}

      {{-- Survey form --}}
      <form class="hidden px-0 lg:px-60" action="#" method="POST" id="jenisBansos">
        @error('bansos')
          <div class="alert alert-error mb-5">
            <span>{{ $message }}</span>
          </div>
        @enderror

        @csrf
        <!-- Section 2: Jenis Bansos -->
        <div class="form-section" id="section-2" style="display:none;">
          <div class="form-group mb-5">
            <label class="form-label" for="jenis_bansos">Jenis Bansos</label>
            <select name="jenis_bansos" id="jenis_bansos" class="form-select" required>
              <option value="">Pilih bansos</option>
              <option value="Bansos-1">Bansos-1</option>
              <option value="Bansos-2">Bansos 2</option>
              <option value="Bansos-3">Bansos 3</option>
            </select>
            @error('jenis_bansos')
              <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <button type="button" class="btn btn-primary w-full" onclick="nextSection(3)">Selanjutnya</button>
        </div>

        <!-- Section 3: Survey Kriteria -->
        <div class="form-section" id="section-3" style="display:none;">
          <div class="form-group mb-5">
            <label class="form-label" for="anggota_keluarga">Berapa banyak anggota keluarga?</label>
            <div class="row">
              <div class="col-4">
                <input type="radio" id="anggota1" name="anggota_keluarga" value="{{ old('anggota_keluarga') }}"/>
                <label for="anggota1">< 2</label>
              </div>
              <div class="col-4">
                <input type="radio" id="anggota2" name="anggota_keluarga" value="{{ old('anggota_keluarga') }}"/>
                <label for="anggota2">3</label>
              </div>
              <div class="col-4">
                <input type="radio" id="anggota3" name="anggota_keluarga" value="{{ old('anggota_keluarga') }}"/>
                <label for="anggota3">> 3</label>
              </div>
            </div>
            
            <label class="form-label" for="anggota_keluarga">Apa pendidikan terakhir kepala keluarga?</label>
            <div class="row">
              <div class="col-4">
                <input type="radio" id="anggota1" name="anggota_keluarga" value="{{ old('anggota_keluarga') }}"/>
                <label for="anggota1">< 2</label>
              </div>
              <div class="col-4">
                <input type="radio" id="anggota2" name="anggota_keluarga" value="{{ old('anggota_keluarga') }}"/>
                <label for="anggota2">3</label>
              </div>
              <div class="col-4">
                <input type="radio" id="anggota3" name="anggota_keluarga" value="{{ old('anggota_keluarga') }}"/>
                <label for="anggota3">> 3</label>
              </div>
            </div>

            @error('anggota_keluarga')
              <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <!-- Add other survey kriteria fields here -->

          <div class="row justify-between">
            <button type="button" class="btn btn-outline-primary col-4" onclick="prevSection(2)">Sebelumnya</button>
            <button type="submit" class="btn btn-primary col-4">Submit</button>
          </div>
        </div>
      </form>
      {{-- end Survey form --}}
    </div>
  </div>
</section>
{{-- end Bansos Form --}}

@push('js')
<script>
  document.getElementById('verifikasiForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = event.target;
    const formData = new FormData(form);

    fetch(form.action, {
      method: form.method,
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json',
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Hide verification form and show the next section
        form.style.display = 'none';
        document.getElementById('jenisBansos').style.display = 'block';
        document.getElementById('section-2').style.display = 'block';
      } else {
        // Handle validation errors
        alert(data.message);
      }
    })
    .catch(error => console.error('Error:', error));
  });

  function nextSection(section) {
    document.querySelector('.form-section:not([style*="display: none"])').style.display = 'none';
    document.getElementById(`section-${section}`).style.display = 'block';
  }

  function prevSection(section) {
    document.querySelector('.form-section:not([style*="display: none"])').style.display = 'none';
    document.getElementById(`section-${section}`).style.display = 'block';
  }
</script>
@endpush

@include('layout.footer')

