<div class="container h-full bg-white">
    {{-- <h1 class="py-5 ml-5 text-3xl font-bold text-gray-900 ">{{$breadcrumb->title}}</h1> --}}
    
    <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        <h1 class="pb-5 mb-3 mt-2 text-2xl font-extrabold text-gray-600 "> {{$page->title}}</h1>
        <div class="mb-5 text-xs">
            <a class="p-2 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/keluarga/create')}}">Tambah Data Keluarga</a>
        </div>
        @if (session('success'))
        <div class="col-span-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
        @endif
        <div class="h-auto p-2">
            <table id="table_keluarga" class="table-auto text-center  w-full min-w-max cursor-default">
                <thead class="bg-teal-400">
                    <tr>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">No</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">No KK</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Jumlah Orang Kerja</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Jumlah Tanggungan</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Jumlah Kendaraan</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Luas Tanah</th>
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
        var table = $('#table_keluarga').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('admin/keluarga/list') }}",
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
                {
                    data: "luas_tanah",
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
    });
</script>
@endpush
@stack('js')
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>