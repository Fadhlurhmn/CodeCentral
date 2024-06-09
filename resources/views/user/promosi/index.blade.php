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
              Temukan berbagai produk dan layanan unggulan dari pelaku UMKM di lingkungan kami. Dukung usaha lokal untuk memperkuat perekonomian masyarakat.
          </p>
          <a class="btn btn-primary mt-4" href="{{ route('user.promosi.create') }}">Promosikan Usaha Anda</a>
          <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="btn btn-outline-primary mt-4" type="button">Periksa Status Pengajuan Promosi</button>

          <!-- Main modal -->
          <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden bg-black/30 fixed top-0 right-0 left-0 z-50 justify-center text-left items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
              <div class="relative p-4 w-full max-w-md max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow">
                      <!-- Modal header -->
                      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                          <h4 class="text-xl font-semibold text-gray-900">
                              Cek Status Pengajuan Promosi
                          </h4>
                          <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="authentication-modal">
                              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                              </svg>
                              <span class="sr-only">Close modal</span>
                          </button>
                      </div>
                      <!-- Modal body -->
                      <div class="p-4 md:p-5">
                          <form method="POST" action="{{ route('user.cekStatusPengajuan') }}">
                              @csrf
                              <div>
                                  <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">Gunakan NIK untuk mengecek status</label>
                                  <input type="number" name="nik" id="nik" maxlength="16" value="{{ old('nik') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-primary block w-full p-2.5" placeholder="Masukkan NIK" required />
                              </div>
                              <div id="nikError" class="hidden col-span-4 text-red-500 text-xs mt-4">NIK harus diisi dengan 16 karakter</div>

                              <button type="submit" class="mt-4 w-full text-white bg-primary hover:bg-teal-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cek Status</button>
                          </form>
                          @if(session('status_pengajuan'))
                              <div class="mt-4 text-center text-sm font-medium text-gray-900">
                                  {{ session('status_pengajuan') }}
                              </div>
                          @endif
                          @error('nik')
                            <div class="mt-4 text-center text-sm font-medium text-gray-900">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                  </div>
              </div>
          </div>

      </div>
    </div>
  </section>
  <!-- end Common hero -->

<!-- Main -->
<section class="section pt-0">
  <div class="container">
    <!-- Categories -->
    <div class="category-filter mb-10 mt-3 rounded-xl bg-[#EEEEEE] px-4 ">
        <form method="GET" action="{{ route('user.promosi') }}">
        <ul class="filter-list">
          <li>
            <button type="submit" name="kategori" value="Semua" class="filter-btn @if($kategori == 'Semua') filter-btn-active @endif btn btn-sm hover:filter-btn-active">Semua Kategori</button>
          </li>
          <li>
            <button type="submit" name="kategori" value="Kuliner" class="filter-btn @if($kategori == 'Kuliner') filter-btn-active @endif btn btn-sm hover:filter-btn-active">Kuliner</button>
          </li>
          <li>
            <button type="submit" name="kategori" value="Fashion" class="filter-btn @if($kategori == 'Fashion') filter-btn-active @endif btn btn-sm hover:filter-btn-active">Fashion</button>
          </li>
          <li>
            <button type="submit" name="kategori" value="Retail" class="filter-btn @if($kategori == 'Retail') filter-btn-active @endif btn btn-sm hover:filter-btn-active">Retail</button>
          </li>
          <li>
            <button type="submit" name="kategori" value="Jasa" class="filter-btn @if($kategori == 'Jasa') filter-btn-active @endif btn btn-sm hover:filter-btn-active">Jasa</button>
          </li>
          <li>
            <button type="submit" name="kategori" value="Lainnya" class="filter-btn @if($kategori == 'Lainnya') filter-btn-active @endif btn btn-sm hover:filter-btn-active">Lainnya</button>
          </li>
        </ul>
        </form>
    </div>
    <!-- end Categories -->


    <!-- search bar -->
    <form class="mb-4" method="GET" action="{{ route('user.promosi') }}">
      <div class="row">
        <div class="bg-black opacity-0 lg:col-6"></div>

        <div class="col-12 lg:col-6">
          <label for="search-input" class="mb-2 text-sm font-medium sr-only">Search</label>
          <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                  </svg>
              </div>
              <input type="search" id="search-input" name="search" value="{{ $search }}" class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-lg focus:border-primary" placeholder="Cari UMKM lokal..." required />
              <button type="submit" class="text-black absolute end-2.5 bottom-2.5 bg-primary focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Search</button>
          </div>
        </div>
      </div>
    </form>
    <!-- end search bar -->

    @if ($promosis->isEmpty())
      <p class="text-xl text-center font-bold text-gray-600">Promosi Tidak Tersedia</p>
    @else
    <!-- Semua promosi -->
    <div class="row">
        @foreach ($promosis as $promosi)
        <div class="mb-8 md:col-6 lg:col-4">
          <div class="card">
            <button data-modal-target="large-modal-{{ $promosi->id_promosi }}" data-modal-toggle="large-modal-{{ $promosi->id_promosi }}" class="" type="button">
              <img class="card-img hover:opacity-30" width="335" height="210" src="{{ asset('promosi_thumbnail/' . $promosi->gambar) }}" alt="{{ $promosi->nama_usaha }}" />
            </button>
            <div class="card-content">
              <div class="card-tags">
                <div class="tag">{{ $promosi->kategori }}</div>
              </div>
              <h3 class="h4 card-title">{{ $promosi->nama_usaha }}</h3>
              <p>{{ $promosi->deskripsi }}</p>
            </div>
            <div class="card-footer mt-2">
              <div class="mb-2">
                <span class="inline-flex items-center text-[#666]">
                  <i class="fas fa-phone-alt text-md mr-2"></i>
                  <p class="text-xs">{{ $promosi->no_telp }}</p>
                </span>
              </div>
              <div>
                <span class="inline-flex items-center text-[#666]">
                  <i class="fas fa-map-marker-alt text-md mr-2"></i>
                  <p class="text-xs">{{ $promosi->alamat }}</p>
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Promosi Modal -->
        <div id="large-modal-{{ $promosi->id_promosi }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden bg-black/30 overflow-y-auto ease-in-out duration-300 md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-4xl max-h-full">
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 lg:p-2 border-b rounded-t">
                      <div class="flex items-center">
                          <small class="text-black bg-gray-200 rounded-full px-3 py-1">{{ $promosi->kategori }}</small>
                      </div>
                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="large-modal-{{ $promosi->id_promosi }}">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                  </div>
                  <!-- Modal body -->
                  <div class="p-4 md:p-5 space-y-4">
                      <div class="row">
                      <div class="col-6">
                          <img class="card-img" width="335" height="210" src="{{ asset('promosi_thumbnail/' . $promosi->gambar) }}" alt="{{ $promosi->nama_usaha }}" />
                      </div>
                      <div class="col-6">
                          <h3>{{ $promosi->nama_usaha }}</h3>
                          <p>{{ $promosi->deskripsi }}</p>
                          <p><i class="fas fa-phone-alt text-md mr-2"></i> {{ $promosi->no_telp }}</p>
                          <p><i class="fas fa-map-marker-alt text-md mr-2"></i> {{ $promosi->alamat }}</p>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        @endforeach
      </div>
    @endif
    <!-- end Semua promosi -->
  </div>
</section>
<!-- end Main -->

@include('layout.footer')

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

  document.getElementById('promosi_show').addEventListener('click', function() {
    var backdrop = document.getElementById('backdrop');

    backdrop.classList.remove('hidden');
  });
</script>
@endpush
