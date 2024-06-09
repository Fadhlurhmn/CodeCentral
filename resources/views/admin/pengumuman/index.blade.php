@include('layout.start')

@include('layout.a_navbar')

<!-- Start wrapper -->
<div class="h-screen flex flex-row flex-wrap">

    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="bg-white flex-1 md:mt-16 cursor-default">
        <div class="p-5 pb-0 flex flex-col border-t-2 border-teal-500">
            @include('layout.breadcrumb2')
        </div>

        <div class="container p-5 bg-white text-xs flex flex-col items-start">
            <div class="flex justify-between w-full mb-4">
                <a class="p-2 text-sm font-normal text-center shadow-md bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/pengumuman/create')}}">Tambah Pengumuman</a>

                {{-- Search form --}}
                <form action="{{ url()->current() }}" method="GET" class="text-sm font-medium flex items-center relative">
                    <div class="relative flex items-center w-full">
                        <input type="text" name="query" id="searchInput" value="{{ request('query') }}" placeholder="Cari pengumuman" class="search-input px-4 py-2 border border-gray-300 rounded-md w-full">
                        <span id="clearSearch" class="clear-search absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400 hover:text-gray-600 text-2xl">&times;</span>
                    </div>
                    <select name="status" id="status" class="ml-2 px-4 py-2 border border-gray-300 rounded-md">
                        <option value="">Semua Status</option>
                        <option value="Publikasi" {{ request('status') == 'Publikasi' ? 'selected' : '' }}>Publikasi</option>
                        <option value="Draf" {{ request('status') == 'draf' ? 'selected' : '' }}>Draf</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-teal-400 text-teal-900 rounded-md ml-2">Cari</button>
                </form>
            </div>
        </div>

        @if (session('success'))
        <!-- Menampilkan pesan sukses jika ada session 'success' -->
        <div class="col-span-4 mb-4 px-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        {{-- Bagian pengumuman Warga --}}
        <div class="h-fit grid grid-cols-1 gap-5 p-6 mx-auto bg-white/50 border-t-2 border-teal-500 cursor-default">
            @if($pengumuman->isEmpty())
                <p class="text-gray-600 text-center">Pengumuman tidak tersedia</p>
            @else
                @foreach ($pengumuman as $pengumumans)
                <div id="pengumuman-{{$pengumumans->id_pengumuman}}" class="rounded-lg shadow-md flex flex-row border-b-2 border-teal-500">
                    @if($pengumumans->thumbnail)
                        <div class="p-4">
                            <img src="{{ asset('pengumuman_thumbnail/'. $pengumumans->thumbnail) }}" alt="{{ $pengumumans->judul_pengumuman }}" class="w-16 h-16 object-cover rounded-lg">
                        </div>
                    @endif
                    <div class="p-4 flex-1">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $pengumumans->judul_pengumuman }}</h2>
                        <p class="text-xs text-gray-600">Penulis: {{ $pengumumans->user->username }}</p>
                        <div class="mb-2">
                            <p class="text-xs text-gray-600">Tanggal penulisan: {{ $pengumumans->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i:s') }}</p>
                        </div>
                    </div>
                    <div class="mr-4 flex flex-row items-center justify-center">
                        <span class="text-xs font-bold px-4 py-2 rounded-full {{ $pengumumans->status_pengumuman == 'Publikasi' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">{{ $pengumumans->status_pengumuman }}</span>
                    </div>
                    <div class="mr-4 flex flex-row items-center justify-center">
                        <form action="{{ url('admin/pengumuman/'.$pengumumans->id_pengumuman.'/show') }}">
                            <button type="submit" class="bg-teal-500/70 py-2 px-4 mr-2 text-sm font-normal rounded-full text-white transition duration-300 ease-in-out hover:bg-teal-600">
                                Preview
                            </button>
                        </form>
                        <form action="{{ url('admin/pengumuman/'.$pengumumans->id_pengumuman.'/edit') }}">
                            <button type="submit" class="bg-yellow-200 py-2 px-4 text-sm font-normal rounded-full text-yellow-500 transition duration-300 ease-in-out hover:bg-yellow-300 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                        <button onclick="deletePengumuman({{ $pengumumans->id_pengumuman }})" class="bg-red-500 py-2 px-4 text-sm font-normal rounded-full text-white transition duration-300 ease-in-out hover:bg-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        @push('js')
        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const searchInput = document.getElementById('searchInput');
            const clearSearch = document.getElementById('clearSearch');

            // Ketika ikon clearSearch diklik, bersihkan input pencarian dan fokuskan kembali
            clearSearch.addEventListener('click', () => {
                searchInput.value = '';
                searchInput.focus();
            });

            // Tampilkan ikon clearSearch hanya jika ada teks di kotak pencarian
            searchInput.addEventListener('input', () => {
                if (searchInput.value) {
                    clearSearch.style.display = 'block';
                } else {
                    clearSearch.style.display = 'none';
                }
            });

            // Sembunyikan ikon clearSearch secara awal jika kotak pencarian kosong
            if (!searchInput.value) {
                clearSearch.style.display = 'none';
            }
        });

        // Fungsi untuk menghapus pengumuman
        function deletePengumuman(id) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus pengumuman ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#38b2ac',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/pengumuman/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Pengumuman berhasil dihapus.',
                                icon: 'success',
                                confirmButtonColor: '#38b2ac'
                            }).then(() => {
                                document.getElementById(`pengumuman-${id}`).remove();
                            });
                        } else {
                            Swal.fire('Gagal!', 'Pengumuman gagal dihapus.', 'error');
                        }
                    });
                }
            });
        }
        </script>
        @endpush

        {{-- End Bagian pengumuman Warga --}}
    <!-- End content -->
    </div>
</div>
<!-- End wrapper -->
@include('layout.end')
