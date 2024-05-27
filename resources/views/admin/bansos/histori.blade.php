@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow">
        <div class="container h-full bg-white">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-b-2 border-teal-500">
                {{-- Detail --}}
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600">{{ $page->title }}</h1>
                {{-- <p class="pb-5 my-2 text-md text-gray-600">Bantuan Sosial {{ $bansos->nama }} diberikan oleh {{ $bansos->pengirim }} untuk {{ $bansos->jumlah_penerima }} orang.</p> --}}

                <!-- Filter Section -->
                <div class="flex justify-between">
                    <a href={{ url('admin/bansos/') }} class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                </div>
                <div class="flex px-2 justify-start items-center text-xs mb-4 mt-7">
                    <div class="flex items-center">
                        <label for="filter_bansos" class="mr-2 text-sm text-gray-700">Jenis Bantuan Sosial: </label>
                        <select id="filter_bansos" name="filter_bansos" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="" hidden>Pilih Jenis Bantuan Sosial</option>
                            @foreach($bansos as $Bansos)
                            <option value="{{$Bansos->id_bansos}}">{{$Bansos->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="h-auto p-2">
                    <table id="table_keluarga" class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-500 px-10">
                            <tr>
                                <th class="p-3 text-sm text-left">No</th>
                                <th class="p-3 text-sm text-left">No Keluarga</th>
                                <th class="p-3 text-sm text-left">Nama Kepala Keluarga</th>
                                <th class="p-3 text-sm text-left">Alamat</th>
                                <th class="p-3 text-sm text-left">Tanggal</th>
                            </tr>
                        </thead>                        
                        <tbody id="table-body" class="text-gray-700 text-left">
                            <!-- Data akan diisi oleh DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
</div>

@include('layout.end')

<script>
$(document).ready(function() {
    var table = $('#table_keluarga').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('bansos.data') }}",
        },
        columns: [
            { 
            data: 'DT_RowIndex',
            className: "text-xs border-b border-gray-500/40",
            name: 'DT_RowIndex', 
            orderable: false, 
            searchable: false 
            },
            { 
            data: 'nomor_keluarga', 
            className: "text-xs border-b border-gray-500/40",
            name: 'nomor_keluarga',
            orderable: false, 
            searchable: true 
            },
            { 
            data: 'nama_kepala_keluarga',
            className: "text-xs border-b border-gray-500/40", 
            name: 'nama_kepala_keluarga',
            orderable: false, 
            searchable: true 
            },
            {
            data: 'alamat',
            className: "text-xs border-b border-gray-500/40", 
            name: 'alamat',
            orderable: false,
            searchable: false 
            },
            { 
            data: 'tanggal_pemberian', 
            className: "text-xs border-b border-gray-500/40",
            name: 'tanggal_pemberian',
            orderable: false, 
            searchable: true 
            },
        ],
        columnDefs: [
            {
                targets: 0,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }
        ]
    });
    $('#filter_bansos').on('change', function() {
        var selectedBansos = $(this).val();
        var url = "{{ route('bansos.data') }}";
        if (selectedBansos !== '') {
            url += "?id_bansos=" + selectedBansos;
        }
        table.ajax.url(url).load();
    });
});
</script>
