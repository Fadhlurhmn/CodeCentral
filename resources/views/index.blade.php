@include('layout.head')
@include('layout.u_navbar')

<!-- floating assets -->
<img class="floating-bubble-1 absolute right-0 top-0 -z-[1]" src="images/floating-bubble-1.svg" alt="" />
<img class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]" src="images/floating-bubble-2.svg" alt="" />
<img class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]" src="images/floating-bubble-3.svg" alt="" />
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
                <div class="swiper pengumuman-carousel py-7">
                    <div class="swiper-wrapper">
                        @foreach ($pengumumanTerkini as $pengumuman)
                            <div class="swiper-slide">
                                <div class="card">
                                    <img class="card-img" width="235" height="304" src="{{ asset('pengumuman_thumbnail/' . $pengumuman->thumbnail) }}" alt="{{ $pengumuman->judul_pengumuman }}" />
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
          <h2>UMKM Unggulan</h2>
        </div>
      </div>
      <div class="row mt-10">
          <div class="col-12">
            <div class="swiper umkm-carousel py-7">
              <div class="swiper-wrapper">
              {{-- max 5 ajah buat umkm di home --}}
              @for ($i = 0; $i < 3; $i++)
                <div class="swiper-slide">
                    <div class="card">
                        <img
                        class="card-img"
                        width="335"
                        height="210"
                        src="images/posts/post-5.png"
                        alt=""
                        />
                        <div class="card-content">
                        <div class="card-tags">
                            <a class="tag" href="#">Kerajinan</a>
                        </div>
                        <h3 class="h4 card-title">
                            HP ODDO Pak Supri
                        </h3>
                        <p>
                            HP ASLI, DIJAMIN BUKAN KW, KWALITAS TOP!!
                        </p>
                        </div>
                        <div class="card-footer mt-2 flex space-x-4">
                        <span class="inline-flex items-center text-[#666]">
                            <i class="fab fa-facebook text-md mr-2"></i>
                            <p class="text-xs">hp.paksupri</p>
                        </span>
                        </div>
                    </div>
                </div>
              @endfor
              </div>
              <!-- If we need pagination -->
              <div
                class="swiper-pagination umkm-carousel-pagination !bottom-0"
              ></div>
            </div>
          </div>
        </div>
    </div>
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
                <div class="block duration-300 ease-in-out" id="jadwal_keamanan">
                    @if(isset($jadwal_keamanan))
                        <table class="table-auto border-collapse border w-full">
                            <thead>
                                <tr class="bg-primary border-b md:text-sm">
                                    <th class="px-4 py-2 md:px-2 md:py-1">Hari</th>
                                    <th class="px-4 py-2 md:px-2 md:py-1">Waktu</th>
                                    <th class="px-4 py-2 md:px-2 md:py-1">Nama</th>
                                    <th class="px-4 py-2 md:px-2 md:py-1">Telepon</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($jadwal_keamanan->hari as $indexHari => $hari)
                                    @foreach ($jadwal_keamanan->waktu as $indexWaktu => $waktu)
                                        <tr class="bg-white border-b md:text-sm">
                                            <td class="px-4 py-2 md:px-2 md:py-1">{{ $hari }}</td>
                                            <td class="px-4 py-2 md:px-2 md:py-1">{{ $waktu }}</td>
                                            <td class="px-4 py-2 md:px-2 md:py-1">{{ $jadwal_keamanan->nama[$indexHari][$indexWaktu] }}</td>
                                            <td class="px-4 py-2 md:px-2 md:py-1">{{ $jadwal_keamanan->telepon[$indexHari][$indexWaktu] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">Tidak ada jadwal keamanan yang tersedia</p>
                    @endif
                </div>
                <div class="hidden duration-300 ease-in-out" id="jadwal_kebersihan">
                    @if(isset($jadwal_kebersihan))
                        <table class="table-auto border-collapse border w-full">
                            <thead>
                                <tr class="bg-primary border-b md:text-sm">
                                    <th class="px-4 py-2 md:px-2 md:py-1">Hari</th>
                                    <th class="px-4 py-2 md:px-2 md:py-1">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($jadwal_kebersihan->hari as $index => $hari)
                                    <tr class="bg-white border-b md:text-sm">
                                        <td class="px-4 py-2 md:px-2 md:py-1">{{ $hari }}</td>
                                        <td class="px-4 py-2 md:px-2 md:py-1">{{ $jadwal_kebersihan->waktu[$index % count($jadwal_kebersihan->waktu)] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">Tidak ada jadwal kebersihan yang tersedia</p>
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
