<div class="container h-full bg-slate-100">
    {{-- <h1 class="py-5 ml-5 text-3xl font-bold text-gray-900 ">{{$breadcrumb->title}}</h1> --}}
    
    <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        <h1 class="pb-5 my-5 text-3xl font-extrabold text-gray-600 "> {{$page->title}}</h1>
        <div class="mb-5 font-medium text-lg ">
            <svg class="absolute pointer-events-none inset-y-0 right-0 flex items-center px-2 text-gray-700" width="20" height="20" viewBox="0 0 20 20">
                <path fill="none" stroke="currentColor" stroke-width="2" d="M8 9l4 4 4-4"></path>
            </svg>
        </div>
        <a class="p-2 font-normal text-center text-sm bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('keluarga/create')}}">Tambah Data Keluarga</a>
        <div class="relatives mt-5 h-screen p-5 shadow-md">
            <table id="table_keluarga" class="table-auto text-center border w-full min-w-max cursor-default">
                <thead class="bg-teal-400">
                    <tr>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">No</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">No KK</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Jumlah Orang Kerja</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Jumlah Tanggungan</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Jumlah Kendaraan</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Luas Tanah</th>
                        <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Aksi</th>
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
                "url": "{{ url('keluarga/list') }}",
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
                    data: "nomor_keluarga",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jumlah_orang_kerja",
                    className: "text-sm",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "jumlah_tanggungan",
                    className: "text-sm",
                    orderable: true,
                },
                {
                    data: "jumlah_kendaraan",
                    className: "text-sm",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "luas_tanah",
                    className: "text-sm",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "aksi",
                    className: "flex text-sm",
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