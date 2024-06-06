<div class="container h-full bg-white">
    
    <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        <!-- Bagian breadcrumb -->
        @include('layout.breadcrumb2')
        <!-- Menampilkan judul halaman -->
        {{-- <h1 class="mb-3 text-xl"> {{$page->title}}</h1> --}}

        <!-- Bagian untuk tombol tambah data akun dan filter level akun -->
        <div class="mb-5 text-xs flex justify-between">
            <a class="p-2 mr-5 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/akun/create')}}">Tambah Data Akun</a>

            <!-- Filter Level Akun -->
            <div class="flex items-center space-x-3">
                <div class="flex items-center">
                    <p class="py-1 mr-2">Filter Jabatan: </p>
                    <select name="id_level" id="id_level" class="pl-2 py-1 font-semibold block appearance-none w-52 bg-transparent border-2 border-teal-400 text-gray-900 hover:shadow-md hover:shadow-teal-500 transition duration-300 ease-in-out focus:outline-teal-400 rounded-lg cursor-pointer">
                        <option value="">Semua</option>
                        @foreach ($level as $item)
                            <option value="{{ $item->id_level }}">{{ $item->nama_level }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative">
                    <svg class="absolute pointer-events-none inset-y-0 right-0 flex items-center px-2 text-gray-700" width="20" height="20" viewBox="0 0 20 20">
                        <path fill="none" stroke="currentColor" stroke-width="2" d="M8 9l4 4 4-4"></path>
                    </svg>
                </div>
            </div>
        </div>

        @if (session('success'))
        <!-- Menampilkan pesan sukses jika ada session 'success' -->
        <div class="col-span-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
        @endif
        <!-- Bagian tabel untuk menampilkan data akun -->
        <div class="h-auto p-2 bg-slate-100/50 rounded-xl">
            <table id="table_akun" class="border w-full min-w-max cursor-default">
                <thead class="bg-teal-400 text-center">
                    <tr>
                        <th class="p-3 text-lg font-normal tracking-wide border-r text-left">No</th>
                        <th class="p-3 text-lg font-normal tracking-wide border-r">Username</th>
                        <th class="p-3 text-lg font-normal tracking-wide border-r">Warga</th>
                        <th class="p-3 text-lg font-normal tracking-wide border-r">Jabatan</th>
                        <th class="p-3 text-lg font-normal tracking-wide border-r">Status</th>
                        <th class="p-3 text-lg font-normal tracking-wide border-r">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <!-- Data akan dimasukkan di sini oleh DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
    // Inisialisasi DataTables hanya jika belum diinisialisasi
    if (!$.fn.DataTable.isDataTable('#table_akun')) {
        var table = $('#table_akun').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('admin/akun/list') }}",  // URL untuk mengambil data
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d.id_level = $('#id_level').val();  // Mengirim parameter filter level
                }
            },
            columns: [
                { data: "DT_RowIndex",
                  className: "text-sm border-b border-r border-l border-gray-500/40 text-left",
                  orderable: false,
                  searchable: false },
                { data: "username",
                  className: "text-sm border-b border-r border-l border-gray-500/40",
                  orderable: true,
                  searchable: true },
                { data: "penduduk.nama",
                  className: "text-sm border-b border-r border-l border-gray-500/40",
                  orderable: false,
                  searchable: false },
                { data: "level.nama_level",
                  className: "text-sm border-b border-r border-l border-gray-500/40",
                  orderable: false,
                  searchable: false },
                { data: "status_akun",
                  className: "text-sm border-b border-r border-l border-gray-500/40",
                  orderable: true,
                  searchable: true,
                  render: function(data, type, row) {
                    // Menampilkan status akun dengan warna yang berbeda
                    if (data === 'Aktif') {
                        return '<div class="rounded-full bg-emerald-500/60 text-emerald-800 py-1 px-2">' + data + '</div>';
                    } else {
                        return '<div class="rounded-full bg-red-500/60 text-red-900 py-1 px-2">' + data + '</div>';
                    }
                  }
                },
                { data: "aksi",
                  className: "flex text-sm border-b border-r border-l border-gray-500/40",
                  orderable: false,
                  searchable: false },
            ],
            order: [[1, 'asc']]  // Mengurutkan berdasarkan kolom kedua (Username) secara default
        });

        // Mengupdate tabel ketika filter level berubah
        $('#id_level').on('change', function() {
            var selectedLevel = $(this).val();
            if (selectedLevel === 'all') {
                // Jika dipilih "Semua", atur URL tanpa parameter level
                table.ajax.url("{{ url('admin/akun/list') }}").load();
            } else {
                // Jika dipilih nilai lain, atur URL dengan parameter level
                table.ajax.url("{{ url('admin/akun/list') }}?id_level=" + selectedLevel).load();
            }
        });
    }
    });

</script>
@endpush

@stack('js')

<script>
    // Mengatur AJAX setup untuk menyertakan token CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
