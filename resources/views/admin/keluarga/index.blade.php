<div class="container mx-auto h-full bg-white cursor-default">
    {{-- Start Isi --}}
    <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        @include('layout.breadcrumb2')
        <div class="mb-5 text-xs flex justify-between">
            <a class="p-2 mr-5 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/keluarga/create')}}">Tambah Data Keluarga</a>
            <div class="flex">
                <p class="py-1 mr-2">Filter Rt : </p>
                <select name="rt" id="rt" class="pl-2 py-1 font-semibold block appearance-none w-52 bg-transparent border-2 border-teal-400 text-gray-900 hover:shadow-md hover:shadow-teal-500 transition duration-300 ease-in-out focus:outline-teal-400 rounded-lg cursor-pointer">
                    <option value="all" selected>Semua RT</option>
                    @foreach ($level as $rt)
                        @if (strpos($rt->nama_level, 'RT') !== false)
                            <?php $rt_value = str_replace('RT ', '', $rt->nama_level); ?>
                            <option value="{{ $rt_value }}">{{ $rt_value }}</option>
                        @endif
                    @endforeach
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
            <table id="table_keluarga" class="table-auto text-center  w-full min-w-max cursor-default">
                <thead class="bg-teal-400">
                    <tr>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">No</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">No KK</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Kepala Keluarga</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Alamat</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">RT</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Jumlah Anggota Keluarga</th>
                        <th class="p-3 text-sm font-normal justify-between tracking-normal">Kendaraan</th>
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
                "data": function(d) {
                    d.rt = $('#rt').val();
                }
            },
            columns: [{
                    data: "DT_RowIndex",
                    className: "text-center text-xs border",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nomor_keluarga",
                    className: "text-xs border",
                    orderable: false,
                    searchable: true
                },
                {
                    data: "nama_kepala_keluarga",
                    className: "text-xs border",
                    orderable: false,
                    searchable: true
                },
                {
                    data: "alamat",
                    className: "text-xs border",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "rt",
                    className: "text-xs border",
                    orderable: true,
                    searchable: false,
                },
                {
                    data: "jumlah_anggota_dalam_KK",
                    className: "text-xs border",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "jumlah_kendaraan",
                    className: "text-xs border",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "aksi",
                    className: "flex justify-evenly text-xs border",
                    orderable: false,
                    searchable: false
                },
            ]
        });
        // $('#rt').on('change', function() {
        //         var selectedRt = $(this).val();
        //         if (selectedRt === 'all') {
        //             table.ajax.url("{{ url('admin/keluarga/list') }}").load();
        //         } else {
        //             table.ajax.url("{{ url('admin/keluarga/list') }}?rt=" + selectedRt).load();
        //         }
        // });
        $('#rt').on('change', function() {
            table.ajax.reload();
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