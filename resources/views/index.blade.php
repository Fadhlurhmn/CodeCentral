@include('layout.head')
@include('layout.u_navbar')

<!-- floating assets -->
<img class="floating-bubble-1 absolute right-0 top-0 -z-[1]" src="{{ asset('images/floating-bubble-1.svg') }}" alt="" />
<img class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]" src="{{ asset('images/floating-bubble-2.svg') }}" alt="" />
<img class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]" src="{{ asset('images/floating-bubble-3.svg') }}" alt="" />
<!-- ./end floating assets -->

<!-- Pengumuman -->
<section class="section key-feature relative">
    <div class="container">
        <div class="row justify-between text-center lg:text-start">
            <div class="lg:col-5">
                <h2>Pengumuman Terkini</h2>
            </div>
        </div>
        <div class="row mt-10">
            <div class="col-12">
                @if(isset($pengumumanTerkini) && count($pengumumanTerkini) > 0)
                <div class="swiper pengumuman-carousel py-7">
                    <div class="swiper-wrapper">
                        @foreach ($pengumumanTerkini as $pengumuman)
                            <div class="swiper-slide">
                                <div class="card">
                                    <img class="card-img" width="235" height="304" src="{{ asset('storage/' . $pengumuman->thumbnail) }}" alt="{{ $pengumuman->judul_pengumuman }}" />
                                    <div class="card-content">
                                        <h3 class="h4 card-title ease-in-out duration-300 hover:text-primary">
                                            <a href="{{ route('user.pengumuman.show', ['id' => $pengumuman->id_pengumuman]) }}" class="text-black hover:text-primary hover:ease-in-out hover:duration-300">{{ $pengumuman->judul_pengumuman }}</a>
                                        </h3>
                                        <p>{{ Str::limit(strip_tags($pengumuman->deskripsi, '<p>'), 100) }}</p>
                                        <div class="card-footer mt-6 flex space-x-4">
                                            <span class="inline-flex items-center text-xs text-[#666]">
                                                <svg class="mr-1.5" width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.5 2H11V0.375C11 0.16875 10.8313 0 10.625 0H9.375C9.16875 0 9 0.16875 9 0.375V2H5V0.375C5 0.16875 4.83125 0 4.625 0H3.375C3.16875 0 3 0.16875 3 0.375V2H1.5C0.671875 2 0 2.67188 0 3.5V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V3.5C14 2.67188 13.3281 2 12.5 2ZM12.3125 14.5H1.6875C1.58438 14.5 1.5 14.4156 1.5 14.3125V5H12.5V14.3125C12.5 14.4156 12.4156 14.5 12.3125 14.5Z" fill="#939393" />
                                                </svg>
                                                {{ $pengumuman->created_at->format('d M, Y') }}
                                            </span>
                                            <span class="inline-flex items-center text-xs text-[#666]">
                                                <i class="fas fa-user ml-1.5 mr-2"></i>
                                                {{ $pengumuman->user->username }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination pengumuman-carousel-pagination !bottom-0"></div>
                </div>
                @else
                <p class="text-xl text-center font-bold text-gray-600">Tidak ada Pengumuman Terkini</p>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- end Pengumuman -->

<!-- Promosi UMKM -->
<section class="section key-feature relative">
    <div class="container">
      <div class="row justify-between text-center lg:text-start">
        <div class="lg:col-5">
          <h2>Rekomendasi UMKM</h2>
        </div>
      </div>
      <div class="row mt-10">
          <div class="col-12">
            @if(isset($promosiTerkini) && count($promosiTerkini) > 0)
            <div class="swiper promosi-carousel py-7">
              <div class="swiper-wrapper">
              {{-- max 5 ajah buat promosi di home --}}
              @foreach($promosiTerkini as $promosi)
                <div class="swiper-slide">
                    <div class="card">
                        <button data-modal-target="large-modal-{{ $promosi->id_promosi }}" data-modal-toggle="large-modal-{{ $promosi->id_promosi }}" class="" type="button">
                          <img class="card-img hover:opacity-30" width="335" height="210" src="{{ asset('storage/' . $promosi->gambar) }}" alt="{{ $promosi->nama_usaha }}" />
                        </button>
                        <div class="card-content">
                          <div class="card-tags">
                            <div class="tag">{{ $promosi->kategori }}</div>
                          </div>
                          <h3 class="h4 card-title">{{ $promosi->nama_usaha }}</h3>
                          <p class="fixed-height mb-4">{{ Str::limit($promosi->deskripsi, 34) }}</p>
                        </div>
                        <div class="card-footer mt-2">
                          <div class="mb-2">
                            <span class="inline-flex items-center text-black">
                              <i class="fas fa-phone-alt text-md mr-2"></i>
                              <p class="text-xs">{{ $promosi->no_telp }}</p>
                            </span>
                          </div>
                          <div>
                            <span class="inline-flex items-center text-black">
                              <i class="fas fa-map-marker-alt text-md mr-2"></i>
                              <p class="text-xs">{{ $promosi->alamat }}</p>
                            </span>
                          </div>
                        </div>
                      </div>
                </div>
              @endforeach
              </div>
              <!-- If we need pagination -->
              <div class="swiper-pagination promosi-carousel-pagination !bottom-0"></div>
            </div>
            @else
            <p class="text-xl text-center font-bold text-gray-600">Tidak ada Promosi Tersedia</p>
            @endif
          </div>
        </div>
    </div>
</section>

{{-- promosi Modal Only --}}
<section>
    @foreach ($promosiTerkini as $promosi)
        <!-- Promosi Modal -->
        <div id="large-modal-{{ $promosi->id_promosi }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden bg-black/30 overflow-y-auto ease-in-out duration-300 md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-4xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 lg:p-4 border-b rounded-t">
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
                    <div class="p-4 md:p-6 space-y-6">
                        <div class="row">
                            <div class="col-6">
                                <img class="card-img" width="335" height="210" src="{{ asset('storage/' . $promosi->gambar) }}" alt="{{ $promosi->nama_usaha }}" />
                            </div>
                            <div class="col-6">
                                <h3 class="mb-3">{{ $promosi->nama_usaha }}</h3>
                                <p class="mb-3">{{ $promosi->deskripsi }}</p>
                                <p class="text-black mb-2"><i class="fas fa-phone-alt text-md mr-2"></i> {{ $promosi->no_telp }}</p>
                                <p class="text-black"><i class="fas fa-map-marker-alt text-md mr-2"></i> {{ $promosi->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>
<!-- end Promosi UMKM -->

<!-- Jadwal -->
<section class="section key-feature relative">
    <div class="container">
        <div class="row justify-between text-center lg:text-start">
            <div class="lg:col-5">
                <h2>Jadwal Petugas</h2>
            </div>
        </div>
        <!-- Jadwal Petugas -->
        <div class="mt-10" id="jadwal">
            <div class="grid grid-cols-1 text-black">
                <div class="grid grid-cols-2 gap-4 text-lg text-center font-bold border-gray-200 shadow mb-4 rounded-full">
                    <button id="btn-keamanan" class="p-2 bg-primary rounded-full duration-300 ease-in-out hover:bg-primary md:text-sm" onclick="changeJadwal('keamanan')">Jadwal Keamanan</button>
                    <button id="btn-kebersihan" class="p-2 rounded-full duration-300 ease-in-out hover:bg-primary md:text-sm" onclick="changeJadwal('kebersihan')">Jadwal Kebersihan</button>
                </div>
                {{-- jadwal keamanan --}}
                <div id="jadwal_keamanan" class="h-auto p-2 mb-10">
                    <table class="w-full min-w-max cursor-default border-collapse">
                        <thead class="bg-teal-400 text-center">
                            <tr>
                                <th class="p-3 text-sm font-normal border border-teal-300">Shift</th>
                                <th class="p-3 text-sm font-normal border border-teal-300">{{ ucfirst($hariIni) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $shift)
                                <tr>
                                    <td class="p-3 text-sm text-center border border-teal-300">{{ $shift }}</td>
                                    <td class="p-3 text-sm text-center border border-teal-300">
                                        @foreach ($schedule[$hariIni][$shift] as $entry)
                                            {{ $entry->nama }}<br>
                                            <span class="text-xs text-gray-500">({{ $entry->nomor_telepon }})</span><br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- jadwal kebersihan --}}
                <div id="jadwal_kebersihan" class="hidden h-auto">
                    @if(isset($jadwal_kebersihan) && count($jadwal_kebersihan) > 0)
                    <table class="w-full min-w-max cursor-default border-collapse">
                        <thead class="bg-teal-400 text-center">
                            <tr>
                                <th class="p-3 text-sm font-normal border border-teal-300">Hari</th>
                                <th class="p-3 text-sm font-normal border border-teal-300">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal_kebersihan as $jadwal)
                              @if($jadwal->waktu !== 'Tidak ada')
                              <tr>
                                  <td class="p-3 text-sm text-center border border-teal-300">{{ $jadwal->hari }}</td>
                                  <td class="p-3 text-sm text-center border border-teal-300">{{ $jadwal->waktu }}</td>
                              </tr>
                              @endif
                          @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-4 mb-5 border-2 border-teal-400 bg-neutral-50 flex justify-center shadow-md rounded-md" id="noResults">
                        <div class="flex-col text-center">
                            <h1 class="text-xl font-bold text-gray-600">Tidak ada Jadwal Kebersihan</h1>
                            <p class="text-xs text-gray-500">Jadwal Kebersihan Belum Dibuat.</p>
                        </div>
                    </div>
                    @endif
                  </div>
            </div>
        </div>
    </div>
</section>
<!-- end Jadwal -->

@push('js')
    <script>
        function changeJadwal(type) {
            const jadwalKeamanan = document.getElementById('jadwal_keamanan');
            const jadwalKebersihan = document.getElementById('jadwal_kebersihan');
            const btnKeamanan = document.getElementById('btn-keamanan');
            const btnKebersihan = document.getElementById('btn-kebersihan');
            if (type === 'keamanan') {
                jadwalKeamanan.classList.remove('hidden');
                jadwalKeamanan.classList.add('block');
                jadwalKebersihan.classList.remove('block');
                jadwalKebersihan.classList.add('hidden');
                btnKeamanan.classList.add('bg-primary');
                btnKebersihan.classList.remove('bg-primary');
            } else {
                jadwalKebersihan.classList.remove('hidden');
                jadwalKebersihan.classList.add('block');
                jadwalKeamanan.classList.remove('block');
                jadwalKeamanan.classList.add('hidden');
                btnKeamanan.classList.remove('bg-primary');
                btnKebersihan.classList.add('bg-primary');
            }
        }
    </script>
@endpush

@include('layout.footer')
