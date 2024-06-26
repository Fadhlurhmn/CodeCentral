<div class="container mx-auto h-full bg-white cursor-default">
    {{-- Start Isi --}}
    <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        {{-- <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600"> {{$page->title}}</h1> --}}
        @include('layout.breadcrumb2')
        
        <div class="mb-5 text-xs flex justify-between">
            <a class="p-2 mr-5 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg" href="{{url('rt/penduduk/create')}}">Tambah Data Warga</a>
        </div>
        
        @if (session('success'))
        <div id="successMessage" class="col-span-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <button id="closeButton" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
                    <i class="fas fa-times-circle"></i>
                </button>
            </div>
        </div>
        @endif
        <div class="h-auto p-2">
            <table id="table_penduduk_rt" class="w-full min-w-max cursor-default">
                <thead class="bg-teal-400 px-10 text-center justify-between">
                    <tr>
                        <th class="p-3 text-sm font-normal">No</th>
                        <th class="p-3 text-sm font-normal">NIK</th>
                        <th class="p-3 text-sm font-normal">Nama</th>
                        <th class="p-3 text-sm font-normal">Alamat Domisili</th>
                        <th class="p-3 text-sm font-normal">Status Tinggal</th>
                        <th class="p-3 text-sm font-normal">Status Penduduk</th>
                        <th class="p-3 text-sm font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class=" justify-between ">
                    <!-- Data akan dimasukkan di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#table_penduduk_rt').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('rt/penduduk/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                { data: "DT_RowIndex",
                 className: "text-xs border border-gray-500/40",
                  orderable: false, 
                  searchable: false },
                { data: "nik",
                 className: "text-xs border border-gray-500/40",
                  orderable: true,
                 searchable: true },
                { data: "nama",
                 className: "text-xs border border-gray-500/40", 
                 orderable: true, 
                 searchable: true },
                { data: "alamat_domisili",
                 className: "text-xs border border-gray-500/40", 
                 orderable: true },
                { data: "status_penduduk",
                 className: "text-xs border border-gray-500/40 text-center", 
                 orderable: true, 
                 searchable: true },
                 { 
                    data: "status_data",
                    className: "text-xs text-center border border-gray-500/40",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        if (data === 'aktif'|| data === 'Aktif') {
                            return '<div class="rounded-full w-full bg-emerald-500/60 text-emerald-800 py-1 px-2">' + data + '</div>';
                        } else {
                            return '<div class="rounded-full w-full bg-red-500/60 text-red-900 py-1 px-2">' + data + '</div>';
                        }
                    }
                },
                { data: "aksi",
                 className: "flex text-xs border border-gray-500/40", 
                 orderable: false, 
                 searchable: false },
            ]
        });

        $('#rt').on('change', function() {
            var selectedRt = $(this).val();
            if (selectedRt === 'all') {
                // Jika dipilih "Semua", atur URL tanpa parameter rt
                table.ajax.url("{{ url('rt/penduduk/list') }}").load();
            } else {
                // Jika dipilih nilai lain, atur URL dengan parameter rt
                table.ajax.url("{{ url('rt/penduduk/list') }}?rt=" + selectedRt).load();
            }
        });
    });

    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('successMessage').style.display = 'none';
    });
</script>
@endpush
{{-- @stack('js') --}}
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>