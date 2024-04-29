<div class="container h-full bg-slate-100">
    <h1 class="py-5 ml-5 text-3xl text-gray-900">{{$breadcrumb->title}}</h1>
    
    <div class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white outline-none outline-4 outline-teal-500 rounded-t-3xl">
        <p class="my-5 text-xl font-normal text-gray-600 "> {{$page->title}}</p>
        <div class="mb-5 font-medium text-lg ">
            <select name="rt" id="rt" class="pl-2 py-1 block appearance-none w-60 bg-gray-100 border-b-2 border-teal-400 text-gray-900 focus:outline-none focus:border-teal-600 rounded-t-lg">
                <option value="all" selected>Pilih Rt</option>
                <option value="1">Rt. 1</option>
                <option value="2">Rt. 2</option>
                <option value="3">Rt. 3</option>
                <option value="4">Rt. 4</option>
            </select>
            <svg class="absolute pointer-events-none inset-y-0 right-0 flex items-center px-2 text-gray-700" width="20" height="20" viewBox="0 0 20 20">
                <path fill="none" stroke="currentColor" stroke-width="2" d="M8 9l4 4 4-4"></path>
            </svg>
        </div>
        <a class="p-2 font-normal text-center text-sm bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 rounded-lg" href="{{url('penduduk/create')}}">Tambah Data Warga</a>
        <div class="relatives mt-5 h-80 overflow-x-auto p-5 shadow">
            <table id="table_penduduk" class="table-auto text-center border w-full min-w-max cursor-default">
                <thead class="bg-teal-400">
                    <tr>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">No</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">NIK</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Nama</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Alamat</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Rt</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Status data</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Status penduduk</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r bg-">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#table_penduduk').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('penduduk/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [{
                    data: "DT_RowIndex",
                    className: "text-center text-sm",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nik",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "alamat",
                    className: "text-sm",
                    orderable: false,
                },
                {
                    data: "rt",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                // {
                //     data: "keluarga.nomor_keluarga",
                //     className: "text-sm",
                //     orderable: true,
                // },
                {
                    data: "status_data",
                    className: "text-sm",
                    orderable: false,
                    render: function(data, type, row) {
                        if (data === 'Aktif') {
                            return '<div class="rounded-full bg-emerald-500/60 text-emerald-800 py-1 px-2">' + data + '</div>';
                        } else {
                            return '<div class="rounded-full bg-red-500/60 text-red-900 py-1 px-2">' + data + '</div>';
                        }
                    }
                },
                {
                    data: "status_penduduk",
                    className: "text-sm",
                    orderable: false,
                },
                {
                    data: "aksi",
                    className: "flex text-sm",
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#rt').on('change', function() {
            var selectedRt = $(this).val();
            if (selectedRt === 'all') {
                // Jika dipilih "Semua", atur URL tanpa parameter rt
                table.ajax.url("{{ url('penduduk/list') }}").load();
            } else {
                // Jika dipilih nilai lain, atur URL dengan parameter rt
                table.ajax.url("{{ url('penduduk/list') }}?rt=" + selectedRt).load();
            }
        });
    });
</script>
@endpush
