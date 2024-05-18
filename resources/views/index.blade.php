@include('layout.start')


@include('layout.u_navbar')

<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.u_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 px-12 mt-20 md:px-4 md:mt-16"> 
    <!-- carousel -->
    <div id="default-carousel" class="relative w-full z-10" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-96 overflow-hidden md:h-56">
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/user1.jpg') }}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                <div class="absolute bottom-0 left-0 w-full h-full flex items-end justify-start p-5" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="flex-row">
                        <div class="text-white text-4xl font-semibold md:text-sm">Selamat Datang di SI-RW 3</div>
                        <div class="text-white text-lg mb-2 md:text-xs">Akses informasi terkini tentang RW dan RT mu tanpa aplikasi.
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/user2.jpg') }}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                <div class="absolute bottom-0 left-0 w-full h-full flex items-end justify-start p-5" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="flex-row">
                        <div class="text-white text-4xl font-semibold truncate md:text-sm">America Ya</div>
                        <div class="text-white text-lg mb-2 truncate md:text-xs">America Ya</div>
                        <div class="text-left text-sm mb-2 text-white">
                            <i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('img/user3.jpg') }}" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                <div class="absolute bottom-0 left-0 w-full h-full flex items-end justify-start p-5" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="flex-row">
                        <div class="text-white text-4xl font-semibold truncate md:text-sm">TERSANGKA DITEMUKAN</div>
                        <div class="text-white text-lg mb-2 truncate md:text-xs">BERITAHU KELUARGAMU SEKARANG!</div>
                        <div class="text-left text-sm mb-2 text-white">
                            <i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- end carousel --> 

    <!-- menu layanan SI RW -->
    <div class="pb-5" id="layanan">
        <!-- title -->
        <div class="font-bold py-4 bg-white w-full text-2xl">
            LAYANAN SI RW
            <div class="w-20 h-1 bg-yellow-300"></div>
        </div>
        <div class="grid grid-cols-5 gap-2 text-center">
            <button class="p-4 border border-gray-200 rounded-lg shadow hover:bg-gray-100" onclick="scrollToSection('bansos')">
                <div class="grid grid-cols-1">
                    <i class="far fa-hands-heart text-4xl"></i>
                    <span class="font-bold">Bansos</span>
                </div>
            </button>

            <button class="p-4 border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <div class="grid grid-cols-1">
                    <i class="far fa-bullhorn text-4xl"></i>
                    <span class="font-bold">Pengaduan</span>
                </div>
            </button>

            <button class="p-4 border border-gray-200 rounded-lg shadow hover:bg-gray-100" onclick="scrollToSection('surat')">
                <div class="grid grid-cols-1">
                    <i class="far fa-envelope-open-text text-4xl"></i>
                    <span class="font-bold">Persuratan</span>
                </div>
            </button>

            <button class="p-4 border border-gray-200 rounded-lg shadow hover:bg-gray-100" onclick="scrollToSection('umkm')">
                <div class="grid grid-cols-1">
                    <i class="far fa-store text-4xl"></i>
                    <span class="font-bold">UMKM</span>
                </div>
            </button>

            <button class="p-4 border border-gray-200 rounded-lg shadow hover:bg-gray-100" onclick="scrollToSection('jadwal')">
                <div class="grid grid-cols-1">
                    <i class="far fa-user-shield text-4xl"></i>
                    <span class="font-bold">Jadwal Petugas</span>
                </div>
            </button>
        </div>
    </div>

    <!-- berita dan kegiatan -->
    <div class="pb-10" id="berita">
        <!-- title -->
        <div class="flex font-bold pt-4 bg-white w-full text-2xl md:text-base">
            <div class="grow">BERITA & PENGUMUMAN</div> 
            <button class="bg-yellow-300 rounded-full py-2 px-4 text-sm font-semibold hover:bg-yellow-400 md:py-1 md:px-2 md:text-xs">
                Berita Lainnya
                <i class="far fa-long-arrow-right"></i>
            </button>
        </div>
        <!-- line -->
        <div class="w-20 h-1 mb-4 bg-yellow-300"></div>

        <div class="grid grid-cols-3 text-center py-2 gap-2 md:grid-cols-1">

            <div class="block border col-span-2 border-gray-200 rounded-lg shadow md:hidden">
                <a href="#">
                    <img class="object-cover w-full h-52 rounded-t-lg" src="{{ asset('img/user1.jpg') }}" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-xl text-left font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                    </a>
                    <p class="text-left mb-2 text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                    <p class="mb-3 font-normal text-left text-gray-700">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                    <div class="flex justify-start">
                        <a href="#" class="bg-yellow-300 rounded-full p-2 text-sm font-semibold hover:bg-yellow-400">Read more</a>
                    </div>
                </div>
            </div>

            <div class="col-span-1 grid grid-rows-3 gap-2 md:grid-cols-1">
                {{-- berita utama dalam mode mobile --}}
                <a href="#" class="hidden flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 md:flex">
                    <div class="grid grid-cols-3 flex-grow">
                        <div class="col-span-1 aspect-square"><img class="object-cover w-full h-full" src="{{ asset('img/user1.jpg') }}" alt=""></div>
                        <div class="col-span-2 flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-left text-sm font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                            <p class="text-left text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        </div>
                    </div>
                </a>

                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="grid grid-cols-3 flex-grow">
                        <div class="col-span-1 aspect-square"><img class="object-cover w-full h-full" src="{{ asset('img/user2.jpg') }}" alt=""></div>
                        <div class="col-span-2 flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-left text-sm font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021 Lorem ipsum dolor sit amet.</h5>
                            <p class="text-left text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="grid grid-cols-3 flex-grow">
                        <div class="col-span-1 aspect-square"><img class="object-cover w-full h-full" src="{{ asset('img/user1.jpg') }}" alt=""></div>
                        <div class="col-span-2 flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-left text-sm font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                            <p class="text-left text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="grid grid-cols-3 flex-grow">
                        <div class="col-span-1 aspect-square"><img class="object-cover w-full h-full" src="{{ asset('img/user3.jpg') }}" alt=""></div>
                        <div class="col-span-2 flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-left text-sm font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                            <p class="text-left text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- UMKM WARGA -->
    <div class="mb-8" id="umkm">
        <!-- title -->
        <div class="flex font-bold pt-4 bg-white w-full text-2xl md:text-base">
            <div class="grow">UMKM WARGA</div> 
            <button class="bg-yellow-300 rounded-full py-2 px-4 text-sm font-semibold hover:bg-yellow-400 md:py-1 md:px-2 md:text-xs">
                UMKM Lainnya
                <i class="far fa-long-arrow-right"></i>
            </button>
        </div>
        <!-- line -->
        <div class="w-20 h-1 mb-4 bg-yellow-300"></div>

        <div class="h-52 overflow-x-auto flex flex-nowrap gap-4">
            <div class="h-52 flex-row">
                <div class="flex aspect-square"><img class="object-cover w-full h-full rounded-t-lg" src="{{ asset('img/kopi.jpg') }}" alt=""></div>
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900 md:text-sm">Siomay Pak Dudung</h5>
                    <p class="text-left mb-2 text-gray-700"><i class="far fa-store mr-2 md:text-xs"></i>Jl. Kemangi No 12</p>
                    <p class="text-left mb-2 text-gray-700"><i class="far fa-usd-circle mr-3 md:text-xs"></i></i>Mulai dari Rp 5.000</p>
                </div>
            </div>
            
            {{-- <div class="h-52 flex items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <div class="flex-grow">
                    <div class="flex aspect-square"><img class="object-cover w-full h-full rounded-t-lg" src="{{ asset('img/kopi.jpg') }}" alt=""></div>
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900">Siomay Pak Dudung</h5>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-store mr-2"></i>Jl. Kemangi No 12</p>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-usd-circle mr-3"></i></i>Mulai dari Rp 5.000</p>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="h-52 flex-none items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <div class="flex-grow">
                    <div class="aspect-square"><img class="object-cover w-full h-full rounded-t-lg" src="{{ asset('img/user1.jpg') }}" alt=""></div>
                    <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900">Siomay Pak Dudung</h5>
                    <p class="text-left mb-2 text-gray-700"><i class="far fa-store mr-2"></i>Jl. Kemangi No 12</p>
                    <p class="text-left mb-2 text-gray-700"><i class="far fa-usd-circle mr-3"></i></i>Mulai dari Rp 5.000</p>
                    </div>
                </div>
            </div>
            <div class="h-52 flex-none items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <div class="flex-grow">
                    <div class="aspect-square"><img class="object-cover w-full h-full rounded-t-lg" src="{{ asset('img/kopi.jpg') }}" alt=""></div>
                    <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900">Siomay Pak Dudung</h5>
                    <p class="text-left mb-2 text-gray-700"><i class="far fa-store mr-2"></i>Jl. Kemangi No 12</p>
                    <p class="text-left mb-2 text-gray-700"><i class="far fa-usd-circle mr-3"></i></i>Mulai dari Rp 5.000</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    
    <!-- Bansos -->
    <div class="pb-10" id="bansos">
        <!-- title -->
        <div class="flex font-bold pt-4 bg-white w-full text-2xl md:text-base">
            <div class="grow">BANTUAN SOSIAL</div> 
            <button class="bg-yellow-300 rounded-full py-2 px-4 text-sm font-semibold hover:bg-yellow-400 md:py-1 md:px-2 md:text-xs">
                Bansos Lainnya
                <i class="far fa-long-arrow-right"></i>
            </button>
        </div>
        <!-- line -->
        <div class="w-20 h-1 mb-4 bg-yellow-300"></div>

        <div class="grid grid-cols-1 text-center">
            <a href="#" class="bg-white relative p-4 border-gray-200 shadow text-left rounded-lg hover:bg-gray-100">
                <div class="text-left w-full mx-2">
                    <div class="text-2xl font-semibold truncate mb-2 md:text-sm">
                        Bansos 1
                    </div>

                    <div class="text-base truncate md:text-xs">
                        Bansos yang diperuntukkan untuk masyarakat umum.
                    </div>
                </div>
                <span class="absolute inset-y-0 right-0 p-4 my-6 m-4 ">
                    <i class="far fa-long-arrow-right text-2xl md:text-sm"></i>
                </span>
            </a>
            <a href="#" class="bg-white relative my-4 p-4 border-gray-200 shadow text-left rounded-lg hover:bg-gray-100">
                <div class="text-left w-full mx-2 ">
                    <div class="text-2xl font-semibold truncate mb-2 md:text-sm">
                        Bansos 2
                    </div>

                    <div class="text-base truncate md:text-xs">
                        Bansos yang diperuntukkan untuk masyarakat private.
                    </div>
                </div>
                <span class="absolute inset-y-0 right-0 p-4 my-6 m-4 ">
                    <i class="far fa-long-arrow-right text-2xl md:text-sm"></i>
                </span>
            </a>
        </div>
    </div>
    
    <!-- Jadwal Petugas -->
    <div class="pb-10" id="jadwal">
        <!-- title -->
        <div class="flex font-bold pt-4 bg-white w-full text-2xl md:text-base">
            <div class="grow">JADWAL PETUGAS</div> 
        </div>
        <!-- line -->
        <div class="w-20 h-1 mb-4 bg-yellow-300"></div>

        <div class="grid grid-cols-1">
            <div class="grid grid-cols-2 gap-4 text-lg text-center font-bold border-gray-200 shadow mb-4 rounded-full">
                <button id="btn-keamanan" class="p-2 bg-yellow-300 rounded-full duration-300 ease-in-out hover:bg-yellow-400 md:text-sm" onclick="changeJadwal('btn-keamanan')">Jadwal Keamanan</button>
                <button id="btn-kebersihan" class="p-2  rounded-full duration-300 ease-in-out hover:bg-yellow-400 md:text-sm" onclick="changeJadwal('btn-kebersihan')">Jadwal Kebersihan</button>
            </div>
            <div class="block duration-300 ease-in-out" id="jadwal-keamanan">
                <table class="table-auto border-collapse border w-full">
                    <thead>
                        <tr class="bg-yellow-300 border-b md:text-sm">
                            <th class="px-4 py-2 md:px-2 md:py-1">Hari</th>
                            <th class="px-4 py-2 md:px-2 md:py-1">Waktu</th>
                            <th class="px-4 py-2 md:px-2 md:py-1">Nama</th>
                            <th class="px-4 py-2 md:px-2 md:py-1">Telepon</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr class="bg-white border-b md:text-sm">
                            <td class="px-4 py-2 md:px-2 md:py-1">Senin</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">Pagi</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">Pak Fadhlu</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">0812345678</td>
                        </tr>
                        <tr class="bg-white border-b md:text-sm">
                            <td class="px-4 py-2 md:px-2 md:py-1">Selasa</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">Malam</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">Pak Wahyudi</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">0812345678</td>
                        </tr>
                        <tr class="bg-white border-b md:text-sm">
                            <td class="px-4 py-2 md:px-2 md:py-1">Rabu</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">Siang</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">Pak Rakha</td>
                            <td class="px-4 py-2 md:px-2 md:py-1">0812345678</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="hidden duration-300 ease-in-out" id="jadwal-kebersihan">
                <table class="table-auto border-collapse border w-full">
                    <thead>
                    <tr class="bg-yellow-300 border-b md:text-sm">
                        <th class="px-4 py-2 md:px-2 md:py-1">Hari</th>
                        <th class="px-4 py-2 md:px-2 md:py-1">Waktu</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <tr class="bg-white border-b md:text-sm">
                        <td class="px-4 py-2 md:px-2 md:py-1">Senin</td>
                        <td class="px-4 py-2 md:px-2 md:py-1">13.00</td>
                    </tr>
                    <tr class="bg-white border-b md:text-sm">
                        <td class="px-4 py-2 md:px-2 md:py-1">Selasa</td>
                        <td class="px-4 py-2 md:px-2 md:py-1">13.00</td>
                    </tr>
                    <tr class="bg-white border-b md:text-sm">
                        <td class="px-4 py-2 md:px-2 md:py-1">Minggu</td>
                        <td class="px-4 py-2 md:px-2 md:py-1">09.00</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Struktur Pengurus -->
    <div class="pb-10" id="struktur-pengurus">
        <!-- title -->
        <div class="flex font-bold pt-4 bg-white w-full text-2xl md:text-base">
            <div class="grow">PENGURUS RW 3</div>
        </div>
        <!-- line -->
        <div class="w-20 h-1 mb-4 bg-yellow-300"></div>
        <div class="flex flex-col">
            <div class="flex mb-4 justify-center">
                <div class="relative py-4 px-4 border-gray-200 shadow rounded-lg mb-2 md:py-2 md:px-2">
                    <div class="text-base w-full text-center">
                        <div class="aspect-square mx-auto w-32 mb-2 border-b border-gray-200 md:w-16">
                            <img src="{{ asset('img/user3.jpg') }}" alt="" class="object-cover w-full h-full rounded-full">
                        </div>
                        
                        <div class="text-xl font-semibold truncate md:text-sm">
                            Ketua RW
                        </div>

                        <div class="text-lg truncate md:text-xs">
                            Bu Supriadi
                        </div>
                    </div>
                </div> 
            </div>
            <div class="flex flex-wrap flex-row justify-center">
                @for ($i = 1; $i < 5; $i++)
                    <div class="relative py-4 px-4 border-gray-200 shadow rounded-lg mr-2 mb-2 md:py-2 md:px-2">
                        <div class="text-base w-full text-center">
                            <div class="aspect-square mx-auto w-32 mb-2 border-b border-gray-200 md:w-16">
                                <img src="{{ asset('img/user2.jpg') }}" alt="" class="object-cover w-full h-full rounded-full">
                            </div>
                            
                            <div class="text-xl font-semibold truncate md:text-sm">
                                Ketua RT {{ $i }}
                            </div>

                            <div class="text-lg truncate md:text-xs">
                                Pak Ahmed
                            </div>
                        </div>
                    </div> 
                @endfor
            </div>
        </div>
    </div>
</div>

@push('js')
<!-- footer -->
<footer class="w-full bg-yellow-300 p-8">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <div class="text-4xl font-bold w-full md:text-base">
                SI-RW
            </div>
            <div class="w-14 h-1 mb-4 bg-yellow-400"></div>
            <div class="text-base md:text-sm">
                Akses informasi terkini tentang RW dan RT mu tanpa aplikasi.
            </div>
        </div>
        
        <div>
            <div class="text-xl font-semibold w-full md:text-sm">
                Menu
            </div>
            <div class="w-12 h-1 mb-4 bg-yellow-400"></div>
            <div class="grid grid-cols-1 text-base md:text-sm">
                <a href="/public/landing.html" class="font-bold">Beranda</a>
                <a href="#">Pengaduan</a>
                <a href="#">Bansos</a>
                <a href="#">Persuratan</a>
                <a href="#">UMKM</a>
            </div>
        </div>
    </div>
    <div class="mt-10"></div>
</footer>

<!-- go up button -->
<div id="go-up-button" class="fixed bottom-0 right-0 m-4 z-50 bg-yellow-500 border rounded-full opacity-0 transition-opacity duration-300 pointer-events-none">
    <button type="button" class="flex items-center justify-center text-gray-800 hover:text-white p-5" onclick="scrollToSection('navbar')">
        <i class="fas fa-arrow-up"></i>
    </button>
</div> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    // navigation to desired section
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            window.scrollTo({
                top: section.offsetTop,
                behavior: "smooth"
            });
        }
    }

    // for go up button
    function toggleGoUpButton() {
        const goUpButton = document.getElementById('go-up-button');
        if (window.scrollY > 0) {
            goUpButton.classList.remove('opacity-0', 'pointer-events-none');
            goUpButton.classList.add('opacity-100', 'pointer-events-auto');
        } else {
            goUpButton.classList.remove('opacity-100', 'pointer-events-auto');
            goUpButton.classList.add('opacity-0', 'pointer-events-none');
        }
    }

    window.addEventListener('scroll', toggleGoUpButton);
    // end of navigation to desired section

    // change jadwal petugas
    function changeJadwal(btnId){
        const jadwalKeamanan = document.getElementById('jadwal-keamanan');
        const jadwalKebersihan = document.getElementById('jadwal-kebersihan');
        const btnKeamanan = document.getElementById('btn-keamanan');
        const btnKebersihan = document.getElementById('btn-kebersihan');
        if (btnId == 'btn-keamanan') {
            jadwalKeamanan.classList.remove('hidden');
            jadwalKeamanan.classList.add('block');
            jadwalKebersihan.classList.remove('block');
            jadwalKebersihan.classList.add('hidden');
            btnKeamanan.classList.add('bg-yellow-300');
            btnKebersihan.classList.remove('bg-yellow-300');
        } else {
            jadwalKebersihan.classList.remove('hidden');
            jadwalKebersihan.classList.add('block');
            jadwalKeamanan.classList.remove('block');
            jadwalKeamanan.classList.add('hidden');
            btnKeamanan.classList.remove('bg-yellow-300');
            btnKebersihan.classList.add('bg-yellow-300');
        }
    }
    // end of change jadwal petugas

    const scrollContainer = document.querySelector('.scroll-container');
    let isDragging = false;
    let startX = 0;

    // scroll logic for umkm
    scrollContainer.addEventListener('mousedown', (event) => {
        isDragging = true;
        startX = event.clientX;
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
    });

    document.addEventListener('mousemove', (event) => {
        if (!isDragging) return;
        const deltaX = event.clientX - startX;
        scrollContainer.scrollLeft += deltaX;
        startX = event.clientX;
    });
    // end of scroll logic for umkm
</script>
@endpush
<!-- end wrapper -->

@include('layout.end')
