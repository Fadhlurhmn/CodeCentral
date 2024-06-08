{{-- Styling tambahan manual --}}
<style>
    /* For WebKit browsers (Chrome, Safari) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
    }
    
    /* For Firefox */
    .custom-scrollbar {
        scrollbar-width: none;  /* Remove scrollbar space */
        -ms-overflow-style: none;  /* IE and Edge */
    }
    
    /* To make sure the custom-scrollbar class is applied properly */
    .custom-scrollbar {
        overflow-y: auto;
    }
</style>

{{-- End Styling tambahan manual--}}

{{-- Pembatas luar halaman dan background --}}
<div class="container h-full bg-white cursor-default">

    {{-- Kotak konten atas (Judul,Card & Search) --}}
    <div class="pt-5 px-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        @include('layout.breadcrumb2')
        
        {{-- Card Jumlah bansos & penerima --}}
        <div class="w-full h-auto grid grid-cols-6 gap-6 mb-5 mt-6">
            @if (session('success'))
            <div id="successMessage" class="col-span-full">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button id="closeButton" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
            </div>
            @endif

                {{-- Tabel Untuk Daftar Kategori  --}}
                <div class="col-span-4 p-3 border border-teal-500/20 rounded-md shadow-md shadow-teal-500/30">

                  <div class="mb-5 text-xs flex justify-between">
                    <h2 class="text-xl font-bold">Kategori Bantuan Sosial</h2>
                    <a  href="{{ url('admin/kategori_bansos/create') }}" class="p-2 font-normal text-center shadow-md hover:shadow-yellow-300 bg-teal-300 hover:bg-yellow-400 text-teal-700 hover:text-yellow-700 transition duration-300 ease-in-out rounded-lg">Ubah Kategori</a>
                  </div>

                  <div class="h-40 overflow-y-auto custom-scrollbar">                    
                    @if(isset($kategori_bansos)>0)
                    <table id="table_kebersihan" class="w-full min-w-max cursor-default border-collapse">
                        <thead class="bg-teal-400 text-center">
                            <tr>
                                <th class="p-3 text-sm font-semibold border border-teal-500">Kategori</th>
                                <th class="p-3 text-sm font-semibold border border-teal-500">Pengirim</th>
                                <th class="p-3 text-sm font-semibold border border-teal-500">Bentuk Pemberian</th>
                                <th class="p-3 text-sm font-semibold border border-teal-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($kategori_bansos as $kategori)
                            <tr>
                              <td class="p-3 text-sm text-center border border-teal-500">{{ $kategori->nama_kategori }}</td>
                              <td class="p-3 text-sm text-center border border-teal-500">{{ $kategori->pengirim }}</td>
                              <td class="p-3 text-sm text-center border border-teal-500">{{ $kategori->bentuk_pemberian }}</td>
                              <td class="p-3 text-sm text-center border border-teal-500">
                                <form action="{{ url('admin/kategori_bansos/'.$kategori->id_kategori_bansos) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="p-2 text-xs text-red-800 rounded-lg bg-red-400/30 hover:text-white hover:bg-red-600 transition duration-200 ease-in-out delete-button">Hapus <i class="fad fa-trash"></i></button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="p-4 mb-5 border-2 border-teal-400 bg-neutral-50 flex justify-center shadow-md rounded-md" id="noResults">
                        <div class="flex-col text-center">
                            <h1 class="text-xl font-bold text-gray-600">Tidak ada Kategori Bansos</h1>
                            <p class="text-xs text-gray-500">Daftar Kategori Tidak Ditemukan/Belum Dibuat</p>
                        </div>
                    </div>
                    @endif
                  </div>
                </div>
              {{-- End Tabel Jadwal Satpam --}}

            <div class="grid grid-rows-2 col-span-2 gap-5 text-md">
                {{-- Card Jumlah bansos --}}
                <div class="card py-3 row-span-1 border border-teal-500/20 shadow-md shadow-teal-500/30">
                    <div class="card-body flex items-center">
                        <div class="px-3 py-2 rounded bg-emerald-500 text-white mr-3">
                            <i class="fad fa-people-carry"></i>
                        </div>
                        <div class="flex flex-col">
                            <h1 class="font-semibold">{{$totalBansos}} Total Bantuan Sosial</h1>
                        </div>
                    </div>
                </div>
                
                {{-- Card jumlah warga penerima --}}
                <div class="card py-3 row-span-1 border border-teal-500/20 shadow-md shadow-teal-500/30">
                    <div class="card-body flex items-center">
                        <div class="px-4 py-2 rounded bg-teal-600 text-white mr-3">
                            <i class="fad fa-file-alt"></i>
                        </div>
                        <div class="flex flex-col">
                            <h1 class="font-semibold">{{$keluarga_yang_mengajukan}} Total Permintaan Ajuan</h1>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        {{-- End Card Jumlah bansos & penerima--}}

        {{-- Search --}}
        <div class="flex mb-3 text-xs">
            <a class="p-2 mr-5 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/bansos/create')}}">Tambah Bantuan Sosial</a>
            <a class="p-2 mr-5 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/bansos/histori')}}">Cek Histori Penerimaan</a>
            @if ($kriteriaExists)
                <a class="p-2 mr-5 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/kriteria/show')}}">Lihat Kriteria</a>
            @else
                <a class="p-2 mr-5 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/kriteria/update')}}">Tambah Kriteria</a>
            @endif
            <form action="javascript:void(0);" method="GET" class="text-sm font-medium ml-auto" id="searchForm">
                {{-- <input type="text" id="searchInput" name="query" placeholder="Cari nama bansos..." class="px-4 py-2 border border-gray-500 rounded-md text-xs"> --}}
                <select name="query" id="searchInput" class="text-xs font-medium ml-auto p-2 border border-gray-500 rounded-md">
                    <option value="" selected hidden>Filter Kategori Bantuan Sosial</option>
                    <option value="" class="bg-white">Semua Bantuan Sosial</option>
                    @foreach($bansos as $Bansos)
                    <option class="bg-white" value="{{$Bansos->nama}}">{{$Bansos->nama}}</option>
                    @endforeach
                </select>
            </form>
        </div>
        {{-- End Search --}}
    </div>
    {{-- End Kotak konten atas (Judul,Card & Search) --}}

    {{-- Start Macam bantuan sosial --}}
    <div class="p-5 mx-auto h-screen bg-white/50 border-t-2 border-teal-400 cursor-default overflow-y-auto custom-scrollbar">
        
        @foreach ($bansos as $Bansos)
        <div class="p-4 mb-5 bg-neutral-50 flex justify-between shadow-md rounded-md bansos-item" data-title="Bantuan Sosial {{ $Bansos->nama }}">
            <div class="flex-col">
                <h1>Bantuan sosial {{$Bansos->nama}}</h1>
                <p class="text-xs w-96 xl:w-56 md:w-64">Bantuan sosial {{ $Bansos->nama }} diberikan oleh {{$Bansos->pengirim}} dengan bentuk {{$Bansos->bentuk_pemberian}} untuk {{$Bansos->jumlah_penerima}} orang.</p>
            </div>

            {{-- Button detail bansos --}}
            <div class="flex justify-end gap-3">
                <div>
                    <p class="p-2 text-xs text-gray-700 rounded-lg bg-yellow-400/30 border border-yellow-500">
                        Total Permintaan: {{ $total_ajuan_per_bansos[$Bansos->id_bansos] ?? 0 }}
                    </p>
                </div>
                <a href={{ url('admin/bansos/'.$Bansos->id_bansos.'/show') }}>
                    <button class="p-2 text-xs text-gray-700 rounded-lg bg-gray-400/30 hover:text-teal-900/80 hover:bg-teal-500/30 transition duration-200 ease-in-out">Lihat Detail <i class="fad fa-info-circle"></i></button>
                </a>

                @if($Bansos->detail_bansos->isEmpty())

                    <a href={{ url('admin/bansos/'.$Bansos->id_bansos . '/edit') }}>
                        <button class="p-2 text-xs text-gray-700 rounded-lg bg-gray-400/30 hover:text-yellow-900/80 hover:bg-yellow-500/30 transition duration-200 ease-in-out">Edit <i class="fad fa-pencil-alt"></i></button>
                    </a>
                
                    <form action="{{ url('admin/bansos/'.$Bansos->id_bansos) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="p-2 text-xs text-gray-700 rounded-lg bg-gray-400/30 hover:text-red-900/80 hover:bg-red-500/30 transition duration-200 ease-in-out delete-button">Hapus <i class="fad fa-trash"></i></button>
                    </form>

                @endif
                
            </div>
        </div>
        @endforeach
        
        {{-- Pesan ketika tidak ada hasil pencarian --}}
        <div class="p-4 mb-5 bg-neutral-50 flex justify-center shadow-md rounded-md hidden" id="noResults">
            <div class="flex-col text-center">
                <h1 class="text-xl font-bold text-gray-600">No Results Found</h1>
                <p class="text-xs text-gray-500">Tidak ada bantuan sosial yang sesuai dengan pencarian Anda.</p>
            </div>
        </div>
    </div>
    {{-- End Macam bantuan sosial --}}
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Script searching
        const searchInput = document.getElementById('searchInput');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();
            const bansosItems = document.querySelectorAll('.bansos-item');
            let hasResults = false;

            bansosItems.forEach(function (item) {
                const title = item.getAttribute('data-title').toLowerCase();
                if (title.includes(query)) {
                    item.style.display = 'flex';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });

            if (hasResults) {
                noResults.classList.add('hidden');
            } else {
                noResults.classList.remove('hidden');
            }
        });
        // Script menutup halaman
        document.getElementById('closeButton').addEventListener('click', function () {
            document.getElementById('successMessage').style.display = 'none';
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
