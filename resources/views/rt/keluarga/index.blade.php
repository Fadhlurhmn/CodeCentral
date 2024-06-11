<div class="container mx-auto h-full bg-white cursor-default">
    {{-- Start Isi --}}
    <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
        @include('layout.breadcrumb2')
        <div class="mb-5 text-xs flex justify-between">
            <a class="p-2 mr-5 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg" href="{{url('rt/keluarga/create')}}">Tambah Data Keluarga</a>
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
            <table id="table_keluarga" class="table-auto text-center w-full min-w-max cursor-default">
                <thead class="bg-teal-400">
                    <tr>
                        <th class="p-3 text-sm font-normal tracking-normal">No</th>
                        <th class="p-3 text-sm font-normal tracking-normal">No KK</th>
                        <th class="p-3 text-sm font-normal tracking-normal">Nama Kepala Keluarga</th>
                        <th class="p-3 text-sm font-normal tracking-normal">Alamat</th>
                        <th class="p-3 text-sm font-normal tracking-normal">Jumlah Anggota Keluarga</th>
                        <th class="p-3 text-sm font-normal tracking-normal">Jumlah Kendaraan</th>
                        <th class="p-3 text-sm font-normal tracking-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#table_keluarga').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('rt/keluarga/list') }}",
                type: "POST",
                dataType: "json",
                data: function (d) {
                    d._token = "{{ csrf_token() }}";
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center text-xs border-b", orderable: false, searchable: false },
                { data: "nomor_keluarga", className: "text-xs border-b", orderable: true, searchable: true },
                { data: "nama_kepala_keluarga", className: "text-xs border-b", orderable: true, searchable: true },
                { data: "alamat", className: "text-xs border-b", orderable: true, searchable: true },
                { data: "jumlah_anggota_dalam_KK", className: "text-xs border-b", orderable: true, searchable: true },
                { data: "jumlah_kendaraan", className: "text-xs border-b", orderable: true, searchable: true },
                { data: "aksi", className: "flex justify-evenly text-xs border-b", orderable: false, searchable: false }
            ]
        });

        // Uncomment this section if you want to add filtering by RT
        // $('#rt').on('change', function() {
        //     var selectedRt = $(this).val();
        //     if (selectedRt === 'all') {
        //         table.ajax.url("{{ url('rt/keluarga/list') }}").load();
        //     } else {
        //         table.ajax.url("{{ url('rt/keluarga/list') }}?rt=" + selectedRt).load();
        //     }
        // });

        $('#closeButton').click(function() {
            $('#successMessage').fadeOut();
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endpush
{{-- @stack('js') --}}
