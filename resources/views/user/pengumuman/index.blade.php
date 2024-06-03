@include('layout.head')
@include('layout.u_navbar')

<section class="page-hero pt-16 pb-14">
    <div class="container">
        <div class="page-hero-content mx-auto max-w-[768px] text-center">
            <h1 class="mb-5 mt-8">Berita & Pengumuman</h1>
            <p>
                Selamat datang di halaman Berita dan Pengumuman <span class="font-bold">RW 3 Tlogomas.</span>
                <br>Temukan informasi terbaru tentang kegiatan dan layanan di lingkungan kami. Pantau terus untuk berita terbaru, kegiatan terbaru, dan pengumuman penting lainnya.
            </p>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        {{-- Pengumuman Teratas --}}
        @if(isset($topPengumuman))
            <h2 class="h4 mb-4">Pengumuman Teratas</h2>
            <div class="featured-posts row">
                @foreach ($topPengumuman as $pengumuman)
                    <div class="mb-8 md:col-6">
                        <div class="card">
                            <img class="card-img" src="{{ asset('pengumuman_thumbnail/' . $pengumuman->thumbnail) }}" alt="" />
                            <div class="card-content">
                                <h3 class="h4 card-title">
                                    <a href="{{ route('user.pengumuman.show', $pengumuman->id_pengumuman) }}" class="hover:text-primary hover:ease-in-out hover:duration-300">{{ $pengumuman->judul_pengumuman }}</a>
                                </h3>
                                <p>{{ Str::limit(strip_tags($pengumuman->deskripsi, '<p>'), 100) }}</p>
                                <div class="card-footer mt-6 flex space-x-4">
                                    <span class="inline-flex items-center text-xs text-[#666]">
                                        <i class="fas fa-calendar mr-1.5"></i>
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
        @endif
        {{-- end Pengumuman Teratas --}}

        {{-- Search bar --}}
        <h2 class="h4 mb-4">Semua Pengumuman</h2>
        @if (!session('error'))
            @if(isset($allPengumuman))
                <form class="mb-4" method="GET" action="{{ route('user.pengumuman') }}">
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
                                <input type="search" id="search-input" name="query" class="block w-full p-4 ps-10 text-sm border border-gray-300 rounded-lg focus:border-primary" placeholder="Cari berita dan pengumuman..." required />
                                <button type="submit" class="text-black absolute end-2.5 bottom-2.5 bg-primary focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        @endif
        {{-- end Search bar --}}

        {{-- Display error message if any --}}
        @if (session('error'))
            <div class="alert alert-danger">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Semua Pengumuman hanya jika tidak ada error --}}
        @if (!session('error'))
            @if(isset($allPengumuman))
                <div class="row">
                    @foreach ($allPengumuman as $pengumuman)
                        <div class="mb-8 md:col-6 lg:col-4">
                            <div class="card">
                                <img class="card-img" src="{{ asset('pengumuman_thumbnail/' . $pengumuman->thumbnail) }}" alt="" />
                                <div class="card-content">
                                    <h3 class="h4 card-title">
                                        <a href="{{ route('user.pengumuman.show', $pengumuman->id_pengumuman) }}">{{ $pengumuman->judul_pengumuman }}</a>
                                    </h3>
                                    <p>{{ Str::limit(strip_tags($pengumuman->deskripsi, '<p>'), 100) }}</p>
                                    <div class="card-footer mt-6 flex space-x-4">
                                        <span class="inline-flex items-center text-xs text-[#666]">
                                            <i class="fas fa-calendar mr-1.5"></i>
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
            @else
                <p class="text-center font-bold">Tidak ada pengumuman yang tersedia</p>
            @endif
        @endif
        {{-- end Semua Pengumuman --}}
    </div>
</section>

@include('layout.footer')
