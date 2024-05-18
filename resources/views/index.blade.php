@include('layout.start')


@include('layout.u_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.u_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 md:mt-16"> 

    <div style="padding-left: 50px; padding-right: 50px;">
        <div id="top"></div>
        <!-- carousel -->
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden md:h-96">
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/2.png" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="absolute bottom-0 left-0 w-full h-full flex items-end justify-start p-5" style="background-color: rgba(0, 0, 0, 0.3);">
                        <div class="flex-row">
                            <div class="text-white text-4xl font-semibold">Selamat Datang di SI-RW 3</div>
                            <div class="text-white text-lg mb-2 truncate">Akses informasi terkini tentang RW dan RT mu tanpa aplikasi.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/4.png" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="absolute bottom-0 left-0 w-full h-full flex items-end justify-start p-5" style="background-color: rgba(0, 0, 0, 0.3);">
                        <div class="flex-row">
                            <div class="text-white text-4xl font-semibold truncate">America Ya</div>
                            <div class="text-white text-lg mb-2 truncate">America Ya</div>
                            <div class="text-left text-sm mb-2 text-white">
                                <i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/gaco.png" class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <div class="absolute bottom-0 left-0 w-full h-full flex items-end justify-start p-5" style="background-color: rgba(0, 0, 0, 0.3);">
                        <div class="flex-row">
                            <div class="text-white text-4xl font-semibold truncate">TERSANGKA DITEMUKAN</div>
                            <div class="text-white text-lg mb-2 truncate">BERITAHU KELUARGAMU SEKARANG!</div>
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
            <div class="flex font-bold pt-4 bg-white w-full text-2xl">
                <div class="grow">BERITA & PENGUMUMAN</div> 
                <button class="bg-yellow-300 rounded-full py-2 px-4 text-sm font-semibold hover:bg-yellow-500">
                    Berita Lainnya
                    <i class="far fa-long-arrow-right"></i>
                </button>
            </div>
            <!-- line -->
            <div class="w-20 h-1 mb-4 bg-yellow-300"></div>

            <div class="grid grid-cols-2 text-center py-2 gap-2">

                <div class="bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg" src="img/4.png" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-xl text-left font-bold tracking-tight text-gray-900">Noteworthy technology acquisitions 2021</h5>
                        </a>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        <p class="mb-3 font-normal text-left text-gray-700">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                        <!-- <a href="#" class="flex justify-start bg-yellow-300 rounded-lg shadow-lg p-2 text-md font-semibold hover:bg-yellow-500">
                            Read more</a> -->
                    </div>
                </div>

                <div class="grid grid-rows-3 gap-2">
                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="grid grid-cols-3 flex-grow">
                        <div class="col-span-1 aspect-square"><img class="object-cover w-full h-full" src="img/dpr.png" alt=""></div>
                        <div class="col-span-2 flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        </div>
                    </div>
                    
                    </a>
                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="grid grid-cols-3 flex-grow">
                        <div class="col-span-1 aspect-square"><img class="object-cover w-full h-full" src="img/dpr.png" alt=""></div>
                        <div class="col-span-2 flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        </div>
                    </div>
                    </a>
                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="grid grid-cols-3 flex-grow">
                        <div class="col-span-1 aspect-square"><img class="object-cover w-full h-full" src="img/dpr.png" alt=""></div>
                        <div class="col-span-2 flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-clock mr-2"></i>Rabu, 12 Mei 2024</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- UMKM WARGA -->
        <div class="mb-8" id="umkm">
            <!-- title -->
            <div class="flex font-bold pt-4 bg-white w-full text-2xl">
                <div class="grow">UMKM WARGA</div> 
                <button class="bg-yellow-300 rounded-full py-2 px-4 text-sm font-semibold hover:bg-yellow-500">
                    UMKM Lainnya
                    <i class="far fa-long-arrow-right"></i>
                </button>
            </div>
            <!-- line -->
            <div class="w-20 h-1 mb-4 bg-yellow-300"></div>

            <div class="overflow-x-auto flex flex-nowrap gap-4 scroll-container">
                <div class="w-1/2 flex-none items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="flex-grow">
                        <div class="aspect-square"><img class="object-cover w-full h-full rounded-t-lg" src="img/4.png" alt=""></div>
                        <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900 dark:text-white">Siomay Pak Dudung</h5>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-store mr-2"></i>Jl. Kemangi No 12</p>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-usd-circle mr-3"></i></i>Mulai dari Rp 5.000</p>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex-none items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="flex-grow">
                        <div class="aspect-square"><img class="object-cover w-full h-full rounded-t-lg" src="img/dpr.png" alt=""></div>
                        <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900 dark:text-white">Siomay Pak Dudung</h5>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-store mr-2"></i>Jl. Kemangi No 12</p>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-usd-circle mr-3"></i></i>Mulai dari Rp 5.000</p>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 flex-none items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <div class="flex-grow">
                        <div class="aspect-square"><img class="object-cover w-full h-full rounded-t-lg" src="img/dpr.png" alt=""></div>
                        <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-left text-xl font-bold tracking-tight text-gray-900 dark:text-white">Siomay Pak Dudung</h5>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-store mr-2"></i>Jl. Kemangi No 12</p>
                        <p class="text-left mb-2 text-gray-700"><i class="far fa-usd-circle mr-3"></i></i>Mulai dari Rp 5.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bansos -->
        <div class="pb-10" id="bansos">
            <!-- title -->
            <div class="flex font-bold pt-4 bg-white w-full text-2xl">
                <div class="grow">BANTUAN SOSIAL</div> 
                <button class="bg-yellow-300 rounded-full py-2 px-4 text-sm font-semibold hover:bg-yellow-500">
                    Bansos Lainnya
                    <i class="far fa-long-arrow-right"></i>
                </button>
            </div>
            <!-- line -->
            <div class="w-20 h-1 mb-4 bg-yellow-300"></div>
            <div class="grid grid-cols-1 text-center">
                <a href="#" class="bg-white relative p-4 border-gray-200 shadow text-left rounded-lg hover:bg-gray-100">
                    <div class=" text-base text-left w-full mx-2">
                        <div class="text-2xl font-semibold truncate mb-2">
                            Bansos 1
                        </div>

                        <div class="text-base truncate">
                            Bansos yang diperuntukkan untuk masyarakat umum.
                        </div>
                    </div>
                    <span class="absolute inset-y-0 right-0 p-4 my-6 m-4 ">
                        <i class="far fa-long-arrow-right text-2xl"></i>
                    </span>
                </a>
                <a href="#" class="bg-white relative my-4 p-4 border-gray-200 shadow text-left rounded-lg hover:bg-gray-100">
                    <div class=" text-base text-left w-full mx-2">
                        <div class="text-2xl font-semibold truncate mb-2">
                            Bansos 2
                        </div>

                        <div class="text-base truncate">
                            Bansos yang diperuntukkan untuk masyarakat private.
                        </div>
                    </div>
                    <span class="absolute inset-y-0 right-0 p-4 my-6 m-4 ">
                        <i class="far fa-long-arrow-right text-2xl"></i>
                    </span>
                </a>
            </div>
        </div>
        
        <!-- Jadwal Petugas -->
        <div class=" pb-10" id="jadwal">
            <!-- title -->
            <div class="flex font-bold pt-4 bg-white w-full text-2xl">
                <div class="grow">JADWAL PETUGAS</div> 
            </div>
            <!-- line -->
            <div class="w-20 h-1 mb-4 bg-yellow-300"></div>

            <div class="py-5 grid grid-cols-1">
                <div class="grid grid-cols-2 text-lg text-center font-bold border-gray-200 shadow mb-4 rounded-full">
                    <button id="btn-keamanan" class="p-2 bg-yellow-300 rounded-full duration-300 ease-in-out hover:bg-yellow-300" onclick="changeJadwal('btn-keamanan')">Jadwal Keamanan</button>
                    <button id="btn-kebersihan" class="p-2  rounded-full duration-300 ease-in-out hover:bg-yellow-300" onclick="changeJadwal('btn-kebersihan')">Jadwal Kebersihan</button>
                </div>
                <div class="block duration-300 ease-in-out" id="jadwal-keamanan">
                    <table class="table-auto border-collapse border w-full">
                        <thead>
                        <tr class="bg-yellow-300 border-b">
                            <th class="px-4 py-2">Hari</th>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Telepon</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2">Senin</td>
                            <td class="px-4 py-2">Pagi</td>
                            <td class="px-4 py-2">Pak Fadhlu</td>
                            <td class="px-4 py-2">0812345678</td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2">Selasa</td>
                            <td class="px-4 py-2">Malam</td>
                            <td class="px-4 py-2">Pak Wahyudi</td>
                            <td class="px-4 py-2">0812345678</td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2">Rabu</td>
                            <td class="px-4 py-2">Siang</td>
                            <td class="px-4 py-2">Pak Rakha</td>
                            <td class="px-4 py-2">0812345678</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="hidden duration-300 ease-in-out" id="jadwal-kebersihan">
                    <table class="table-auto border-collapse border w-full">
                        <thead>
                        <tr class="bg-yellow-300 border-b">
                            <th class=" px-4 py-2">Hari</th>
                            <th class="px-4 py-2">Waktu</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2">Senin</td>
                            <td class="px-4 py-2">13.00</td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2">Selasa</td>
                            <td class="px-4 py-2">13.00</td>
                        </tr>
                        <tr class="bg-white border-b">
                            <td class="px-4 py-2">Minggu</td>
                            <td class="px-4 py-2">09.00</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Struktur Pengurus -->
        <div class=" pb-4" id="strukutr-pengurus">
            <!-- title -->
            <div class="flex font-bold pt-4 bg-white w-full text-2xl">
                <div class="grow">PENGURUS RW 3</div>
            </div>
            <!-- line -->
            <div class="w-20 h-1 mb-4 bg-yellow-300"></div>
            <div class="grid grid-cols-3 gap-2">
                <div class="bg-white relative my-4 py-4 border-gray-200 shadow rounded-lg">
                    <div class="flex text-base text-center px-8">
                        <div class="flex-row h-full w-full border border-red-500">
                            <img src="img/gaco.png" alt="" class="rounded-full">
                            
                            <div class="text-2xl font-semibold truncate mb-2">
                                Ketua RW
                            </div>

                            <div class="text-base truncate border-t">
                                <a href="wa.me/62812345678">+62812345678</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white relative my-4 py-4 border-gray-200 shadow rounded-lg">
                    <div class=" text-base w-full text-center">
                        <div class="w-24 mx-auto">
                            <img src="img/gaco.png" alt="" class="rounded-full">
                        </div>
                        
                        <div class="text-2xl font-semibold truncate mb-2">
                            Ketua RW
                        </div>

                        <div class="text-base truncate border-t">
                            <a href="wa.me/62812345678">+62812345678</a>
                        </div>
                    </div>
                </div>
                <div class="bg-white relative my-4 py-4 border-gray-200 shadow rounded-lg">
                    <div class=" text-base w-full text-center">
                        <div class="w-24 mx-auto">
                            <img src="img/gaco.png" alt="" class="rounded-full">
                        </div>
                        
                        <div class="text-2xl font-semibold truncate mb-2">
                            Ketua RW
                        </div>

                        <div class="text-base truncate border-t">
                            <a href="wa.me/62812345678">+62812345678</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer class="bg-yellow-300 p-8">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class="text-4xl font-bold mb-4">
                    SI-RW
                </div>
                <div>
                    Akses informasi terkini tentang RW dan RT mu tanpa aplikasi.
                </div>
            </div>
            
            <div>
                <div class="text-xl font-semibold mt-3 mb-4">
                    Menu
                </div>
                <div class="grid grid-cols-1">
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
    <div id="go-up-button" class="fixed bottom-0 right-0 m-4 z-50 bg-yellow-300 border rounded-full opacity-0 transition-opacity duration-300 pointer-events-none">
        <button type="button" class="flex items-center justify-center text-gray-800 hover:text-white p-5" onclick="scrollToSection('top')">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

  </div> 
</div>
@push('js')
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
