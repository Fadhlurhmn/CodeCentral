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
                <p class="font-medium leading-tight">Pilih Bantuan Sosial</p>
            </span>
        </li>
        <li class="flex items-center text-gray-500 space-x-2.5" id="stepper-3">
            <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0" id="number-3">
                3
            </span>
            <span>
                <p class="font-medium leading-tight">Survey Kriteria</p>
            </span>
        </li>
      </ol>
      {{-- end navigasi form --}}

      @if (session('success'))
          <script>
              document.addEventListener('DOMContentLoaded', function() {
                  document.getElementById('verifikasiForm').style.display = 'none';
                  document.getElementById('jenisBansos').style.display = 'block';
                  document.getElementById('section-2').style.display = 'block';

                  document.getElementById('stepper-1').classList.remove('text-primary');
                  document.getElementById('stepper-1').classList.add('text-gray-500');
                  document.getElementById('stepper-2').classList.remove('text-gray-500');
                  document.getElementById('stepper-2').classList.add('text-primary');

                  document.getElementById('number-1').classList.remove('border-primary');
                  document.getElementById('number-1').classList.add('border-gray-500');
                  document.getElementById('number-2').classList.remove('border-gray-500');
                  document.getElementById('number-2').classList.add('border-primary');
              });
          </script>
      @elseif (session('error'))
          <div class="alert alert-error px-0 lg:px-60">
              {{ session('error') }}
          </div>
      @endif

      {{-- verifikasi data diri --}}
      <form class="px-0 lg:px-60" action="{{ route('verifyDataDiri') }}" method="POST" id="verifikasiForm">
        @error('bansos')
          <div class="alert alert-error mb-5">
            <span>{{ $message }}</span>
          </div>
        @enderror
        @csrf

        <div class="form-group mb-5">
          <label class="form-label mt-3" for="nama_kk">Nama Kepala Keluarga</label>
          <input
            class="form-control"
            type="text"
            id="nama_kk"
            name="nama_kk"
            placeholder="Masukkan Nama lengkap Kepala Keluarga" 
            value="{{ old('nama_kk') }}"
          />
          @error('nama_kk')
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group mb-5">
          <label class="form-label mt-3" for="no_kk">Nomor Kartu Keeluarga</label>
          <input
            class="form-control"
            type="number"
            id="no_kk"
            name="no_kk"
            placeholder="Masukkan Nomor Kartu Keluarga"
            value="{{ old('no_kk') }}"
          />
          @error('no_kk')
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
            <label class="form-label mt-3" for="jenis_bansos">Jenis Bansos</label>
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
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label" for="kk_keluarga">Berapa banyak KK dalam satu rumah?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="kk1" name="kk_keluarga" value="1"/>
                    <label for="kk1">1 KK</label>
                  </div>
                  <div class="">
                    <input type="radio" id="kk2" name="kk_keluarga" value="2"/>
                    <label for="kk2">2 KK</label>
                  </div>
                  <div class="">
                    <input type="radio" id="kk3" name="kk_keluarga" value="3"/>
                    <label for="kk3">3 KK</label>
                  </div>
                  <div class="">
                    <input type="radio" id="kk4" name="kk_keluarga" value="4"/>
                    <label for="kk4">> 3 KK</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="anggota_keluarga">Berapa banyak anggota keluarga dalam satu rumah?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="anggota1" name="anggota_keluarga" value="1"/>
                    <label for="anggota1">1 -3 Orang</label>
                  </div>
                  <div class="">
                    <input type="radio" id="anggota2" name="anggota_keluarga" value="2"/>
                    <label for="anggota2">4 Orang</label>
                  </div>
                  <div class="">
                    <input type="radio" id="anggota3" name="anggota_keluarga" value="3"/>
                    <label for="anggota3">5 Orang</label>
                  </div>
                  <div class="">
                    <input type="radio" id="anggota4" name="anggota_keluarga" value="4"/>
                    <label for="anggota4">≥ 6 Orang</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="pendidikan_kk">Apa pendidikan terakhir kepala keluarga?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="pendidikan1" name="pendidikan_kk" value="1"/>
                    <label for="pendidikan1">Tidak tamat sekolah/ Tidak tamat SD</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pendidikan2" name="pendidikan_kk" value="2"/>
                    <label for="pendidikan2">SD</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pendidikan3" name="pendidikan_kk" value="3"/>
                    <label for="pendidikan3">SMP</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pendidikan4" name="pendidikan_kk" value="4"/>
                    <label for="pendidikan4">SMA/ SMK/ PT</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="pendidikan_anggota">Berapa jumlah anggota keluarga yang masih bersekolah?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="pendidikan_anggota1" name="pendidikan_anggota" value="1"/>
                    <label for="pendidikan_anggota1">≥ 3 Orang</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pendidikan_anggota2" name="pendidikan_anggota" value="2"/>
                    <label for="pendidikan_anggota2">> 2 Orang</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pendidikan_anggota3" name="pendidikan_anggota" value="3"/>
                    <label for="pendidikan_anggota3">> 1 Orang</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pendidikan_anggota4" name="pendidikan_anggota" value="4"/>
                    <label for="pendidikan_anggota4">Tidak Ada</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="pengeluaran">Berapa pengeluaran keluarga dalam satu bulan?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="pengeluaran1" name="pengeluaran" value="1"/>
                    <label for="pengeluaran1">< 400 ribu</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pengeluaran2" name="pengeluaran" value="2"/>
                    <label for="pengeluaran2">400 - 700 ribu</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pengeluaran3" name="pengeluaran" value="3"/>
                    <label for="pengeluaran3">700 ribu - 1 juta</label>
                  </div>
                  <div class="">
                    <input type="radio" id="pengeluaran4" name="pengeluaran" value="4"/>
                    <label for="pengeluaran4">> 1 juta</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="status_rumah">Tempat tinggal sekarang milik siapa?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="status_rumah1" name="status_rumah" value="1"/>
                    <label for="status_rumah1">Magersari/ Pakai gratis</label>
                  </div>
                  <div class="">
                    <input type="radio" id="status_rumah2" name="status_rumah" value="2"/>
                    <label for="status_rumah2">Sewa < 1 juta</label>
                  </div>
                  <div class="">
                    <input type="radio" id="status_rumah3" name="status_rumah" value="3"/>
                    <label for="status_rumah3">Milik Orang Tua/ Warisan</label>
                  </div>
                  <div class="">
                    <input type="radio" id="status_rumah4" name="status_rumah" value="4"/>
                    <label for="status_rumah4">Milik Sendiri/ Sewa</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="sumber_air">Sumber air bersih didapat darimana?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="sumber_air1" name="sumber_air" value="1"/>
                    <label for="sumber_air1">Sumur Milik Tetangga</label>
                  </div>
                  <div class="">
                    <input type="radio" id="sumber_air2" name="sumber_air" value="2"/>
                    <label for="sumber_air2">Sumur Milik Sendiri</label>
                  </div>
                  <div class="">
                    <input type="radio" id="sumber_air3" name="sumber_air" value="3"/>
                    <label for="sumber_air3">PDAM Terbatas</label>
                  </div>
                  <div class="">
                    <input type="radio" id="sumber_air4" name="sumber_air" value="4"/>
                    <label for="sumber_air4">PDAM Bebas/ Air Kemasan</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="penerangan">Sumber Penerangan didapat darimana?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="penerangan1" name="penerangan" value="1"/>
                    <label for="penerangan1">Listrik Numpang</label>
                  </div>
                  <div class="">
                    <input type="radio" id="penerangan2" name="penerangan" value="2"/>
                    <label for="penerangan2">Listrik 450 Watt</label>
                  </div>
                  <div class="">
                    <input type="radio" id="penerangan3" name="penerangan" value="3"/>
                    <label for="penerangan3">Listrik 900 Watt</label>
                  </div>
                  <div class="">
                    <input type="radio" id="penerangan4" name="penerangan" value="4"/>
                    <label for="penerangan4">Listrik diatas 900 Watt</label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label mt-3" for="transportasi">Kendaraan/ transportasi apa yang dimiliki?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="transportasi1" name="transportasi" value="1"/>
                    <label for="transportasi1">Jalan Kaki/Sepeda/Sepeda Motor Seadanya</label>
                  </div>
                  <div class="">
                    <input type="radio" id="transportasi2" name="transportasi" value="2"/>
                    <label for="transportasi2">Sepeda Motor 1 Buah, Kondisi Baik</label>
                  </div>
                  <div class="">
                    <input type="radio" id="transportasi3" name="transportasi" value="3"/>
                    <label for="transportasi3">Sepeda Motor >1 Buah, Kondisi Baik</label>
                  </div>
                  <div class="">
                    <input type="radio" id="transportasi4" name="transportasi" value="4"/>
                    <label for="transportasi4">Mobil</label>
                  </div>
                </div>
              </div>
            </div>
            

            @error('anggota_keluarga')
              <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>

          <!-- Add other survey kriteria fields here -->

          <div class="row w-full justify-between">
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
  // document.getElementById('verifikasiForm').addEventListener('submit', function(event) {
  //   event.preventDefault(); // Prevent the default form submission

  //   const form = event.target;
  //   const formData = new FormData(form);

  //   fetch(form.action, {
  //     method: form.method,
  //     body: formData
  //   })
  //   .then(data => {
  //     if (data.success) {
  //       // Hide verification form and show the next section
  //       form.style.display = 'none';
  //       document.getElementById('jenisBansos').style.display = 'block';
  //       document.getElementById('section-2').style.display = 'block';

  //       document.getElementById(`stepper-${section-1}`).classList.remove('text-primary');
  //       document.getElementById(`stepper-${section-1}`).classList.add('text-gray-500');
  //       document.getElementById(`stepper-${section}`).classList.remove('text-gray-500');
  //       document.getElementById(`stepper-${section}`).classList.add('text-primary');
        
  //       document.getElementById(`number-${section-1}`).classList.remove('border-primary');
  //       document.getElementById(`number-${section-1}`).classList.add('border-gray-500');
  //       document.getElementById(`number-${section}`).classList.remove('border-gray-500');
  //       document.getElementById(`number-${section}`).classList.add('border-primary');
  //     } else {
  //       // Handle validation errors
  //       alert(data.message);
  //     }
  //   });
  // });

  function nextSection(section) {
      document.querySelector('.form-section:not([style*="display: none"])').style.display = 'none';
      document.getElementById(`section-${section}`).style.display = 'block';
      
      document.getElementById(`stepper-${section-1}`).classList.remove('text-primary');
      document.getElementById(`stepper-${section-1}`).classList.add('text-gray-500');
      document.getElementById(`stepper-${section}`).classList.remove('text-gray-500');
      document.getElementById(`stepper-${section}`).classList.add('text-primary');
      
      document.getElementById(`number-${section-1}`).classList.remove('border-primary');
      document.getElementById(`number-${section-1}`).classList.add('border-gray-500');
      document.getElementById(`number-${section}`).classList.remove('border-gray-500');
      document.getElementById(`number-${section}`).classList.add('border-primary');
  }

  function prevSection(section) {
      document.querySelector('.form-section:not([style*="display: none"])').style.display = 'none';
      document.getElementById(`section-${section}`).style.display = 'block';
      
      document.getElementById(`stepper-${section+1}`).classList.remove('text-primary');
      document.getElementById(`stepper-${section+1}`).classList.add('text-gray-500');
      document.getElementById(`stepper-${section}`).classList.remove('text-gray-500');
      document.getElementById(`stepper-${section}`).classList.add('text-primary');
      
      document.getElementById(`number-${section+1}`).classList.remove('border-primary');
      document.getElementById(`number-${section+1}`).classList.add('border-gray-500');
      document.getElementById(`number-${section}`).classList.remove('border-gray-500');
      document.getElementById(`number-${section}`).classList.add('border-primary');
  }
</script>
@endpush

@include('layout.footer')

