<div class="container h-full bg-white">
    {{-- <h1 class="py-5 ml-5 text-3xl font-bold text-gray-900 ">{{$breadcrumb->title}}</h1> --}}
    
    <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        {{-- <h1 class="pb-5 mb-3 mt-2 text-2xl font-extrabold text-gray-600 "> {{$page->title}}</h1> --}}
        @include('layout.breadcrumb2')
        <div class="mb-5 text-xs font-semibold flex justify-between">
            {{-- <a class="p-2 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('rw/keluarga/create')}}">Tambah Data Keluarga</a> --}}
            <div class="flex">
                <p class="py-1 mr-2">Filter Rt : </p>
                <select name="rt" id="rt" class="pl-2 py-1 font-semibold block appearance-none w-52 bg-transparent border-2 border-teal-400 text-gray-900 hover:shadow-md hover:shadow-teal-500 transition duration-300 ease-in-out focus:outline-teal-400 rounded-lg cursor-pointer">
                    <option value="all" selected>Semua RT</option>
                    <option value="1">Rt. 1</option>
                    <option value="2">Rt. 2</option>
                    <option value="3">Rt. 3</option>
                    <option value="4">Rt. 4</option>
                    <option value="5">Rt. 5</option>
                    <option value="6">Rt. 6</option>
                    <option value="7">Rt. 7</option>
                </select>
            </div>
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
        <div class="h-auto p-2 bg-slate-100/50 rounded-xl">
            <table id="table_keluarga_rw" class="table-auto text-center  w-full min-w-max cursor-default">
                <thead class="bg-teal-400">
                    <tr>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">No</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">No KK</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Jumlah Orang Kerja</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Jumlah Tanggungan</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Kendaraan</th>
                        {{-- <th class="p-3 text-sm font-normal justify-between tracking-normal">Luas Tanah</th> --}}
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Rt</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#table_keluarga_rw').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('rw/keluarga/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [{
                    data: "DT_RowIndex",
                    className: "text-center text-xs border-b",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nomor_keluarga",
                    className: "text-xs border-b",
                    orderable: false,
                    searchable: true
                },
                {
                    data: "jumlah_orang_kerja",
                    className: "text-xs border-b",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "jumlah_tanggungan",
                    className: "text-xs border-b",
                    orderable: true,
                },
                {
                    data: "jumlah_kendaraan",
                    className: "text-xs border-b",
                    orderable: true,
                    searchable: false
                },
                // {
                //     data: "luas_tanah",
                //     className: "text-xs border-b",
                //     orderable: true,
                //     searchable: false
                // },
                {
                    data: "rt",
                    className: "text-xs border-b",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "aksi",
                    className: "flex justify-evenly text-xs border-b",
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('#rt').on('change', function() {
                var selectedRt = $(this).val();
                if (selectedRt === 'all') {
                    // Jika dipilih "Semua", atur URL tanpa parameter rt
                    table.ajax.url("{{ url('rw/keluarga/list') }}").load();
                } else {
                    // Jika dipilih nilai lain, atur URL dengan parameter rt
                    table.ajax.url("{{ url('rw/keluarga/list') }}?rt=" + selectedRt).load();
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