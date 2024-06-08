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
            Bansos
        </h1>
        <p>
          Anda dapat menemukan informasi terkini mengenai program bantuan sosial yang tersedia bagi warga. Temukan detail tentang berbagai jenis bantuan, syarat dan cara pengajuan, serta jadwal distribusi bantuan sosial.
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
                <p class="font-medium leading-tight">Survey Kriteria</p>
            </span>
        </li>
      </ol>
      {{-- end navigasi form --}}

      {{-- Section 1: verifikasi data diri --}}
      <form class="px-0 lg:px-60" action="{{ route('verifyDataDiri') }}" method="POST" id="verifikasiForm">
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
          <label class="form-label mt-3" for="no_kk">Nomor Kartu Keluarga</label>
          <input
            class="form-control"
            type="number"
            id="no_kk"
            name="no_kk"
            placeholder="Masukkan Nomor Kartu Keluarga"
            value="{{ old('no_kk') }}"
          />
          <div id="no_kkError" class="hidden col-span-4 text-red-500 text-xs mt-4">Nomor KK harus diisi dengan 16 karakter</div>
          @error('no_kk')
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group mb-5">
          <label class="form-label mt-3" for="jenis_bansos">Jenis Bansos</label>
          <select name="jenis_bansos" id="jenis_bansos" class="form-select" required>
            @foreach ($jenis_bansos as $bansos)
              <option value="{{ $bansos->id_bansos }}">{{ $bansos->nama }}</option>
            @endforeach
          </select>
          @error('jenis_bansos')
            <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary block w-full" id="verifikasiButton">Verifikasi</button>
      </form>
      {{-- end verifikasi data diri --}}

      {{-- Survey form --}}
      <form class="hidden px-0 lg:px-60" action="{{ route('submitSurvey') }}" method="POST" id="surveyKriteria">
        {{-- menyimpan id_keluarga untuk kebutuhan form  --}}
        @if (session('data_pengaju'))
            <input type="hidden" name="id_kk" value="{{ session('data_pengaju') }}">
        @endif

        @if (session('jenis_bansos'))
            <input type="hidden" name="jenis_bansos" value="{{ session('jenis_bansos') }}">
        @endif

        @error('bansos')
          <div class="alert alert-error mb-5">
            <span>{{ $message }}</span>
          </div>
        @enderror

        @csrf

        <!-- Section 3: Survey Kriteria -->
        <div class="form-section" id="section-2" style="display:none;">
          <div class="form-group mb-5">
            <div class="card shadow-sm mb-4 border-l-4 border-primary">
              <div class="card-title mb-0 pb-0">
                <label class="form-label" for="kk_keluarga">Berapa banyak KK dalam satu rumah?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="kk1" name="kk_keluarga" value="1" required/>
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
                    <input type="radio" id="anggota1" name="anggota_keluarga" value="1" required/>
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
                    <input type="radio" id="pendidikan1" name="pendidikan_kk" value="1" required/>
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
                    <input type="radio" id="pendidikan_anggota1" name="pendidikan_anggota" value="1" required/>
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
                <label class="form-label mt-3" for="pengeluaran">Berapa total pengeluaran keluarga dalam satu bulan?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="pengeluaran1" name="pengeluaran" value="1" required/>
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
                <label class="form-label mt-3" for="penghasilan">Berapa total penghasilan keluarga dalam satu bulan?</label>
              </div>
              <div class="card-content mt-0 pt-0">
                <div class="grid grid-rows-4">
                  <div class="">
                    <input type="radio" id="penghasilan1" name="penghasilan" value="1" required/>
                    <label for="penghasilan1">< 400 ribu</label>
                  </div>
                  <div class="">
                    <input type="radio" id="penghasilan2" name="penghasilan" value="2"/>
                    <label for="penghasilan2">400 - 700 ribu</label>
                  </div>
                  <div class="">
                    <input type="radio" id="penghasilan3" name="penghasilan" value="3"/>
                    <label for="penghasilan3">700 ribu - 1 juta</label>
                  </div>
                  <div class="">
                    <input type="radio" id="penghasilan4" name="penghasilan" value="4"/>
                    <label for="penghasilan4">> 1 juta</label>
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
                    <input type="radio" id="status_rumah1" name="status_rumah" value="1" required/>
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
                    <input type="radio" id="sumber_air1" name="sumber_air" value="1" required/>
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
                    <input type="radio" id="penerangan1" name="penerangan" value="1" required/>
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
                    <input type="radio" id="transportasi1" name="transportasi" value="1" required/>
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
          </div>

          <button type="submit" class="btn btn-primary w-full">Submit</button>

          {{-- <div class="row w-full justify-between">
            <button type="button" class="ml-4 btn btn-outline-primary col-4" onclick="prevSection(2)">Sebelumnya</button>
            
          </div> --}}
        </div>
      </form>
      {{-- end Survey form --}}
    </div>
  </div>
</section>
{{-- end Bansos Form --}}

@push('js')

{{-- js buat pindah navigasi --}}
@if (session('success_verifikasi'))
  <script>
    document.getElementById('verifikasiForm').style.display = 'none';
    document.getElementById('surveyKriteria').style.display = 'block';
    document.getElementById('section-2').style.display = 'block';

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

<script>
  // Script tulisan merah dibawah inputan
  document.getElementById('no_kk').addEventListener('input', function() {
        var no_kkInput = this.value;
        var no_kkError = document.getElementById('no_kkError');
        
        if (no_kkInput.length !== 16) {
            no_kkError.classList.remove('hidden');
        } else {
            no_kkError.classList.add('hidden');
        }
    });
</script>
@endpush

@include('layout.footer')

