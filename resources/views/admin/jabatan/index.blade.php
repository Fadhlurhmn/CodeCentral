@include('layout.start')
@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <div class="flex-col flex-grow">
        <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
            <!-- Breadcrumb -->
            @include('layout.breadcrumb2')

            <!-- Button to add new position data -->
            <div class="mb-5 text-sm flex justify-between">
                <a class="p-2 mr-5 font-normal text-center text-sm shadow-md bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{ url('admin/jabatan/create') }}">
                    Tambah Data Jabatan
                </a>
            </div>

            <!-- Display success message if any -->
            @if (session('success'))
                <div class="col-span-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Table to display position data -->
            <div class="h-auto p-2 bg-slate-100/50 rounded-xl">
                <table id="table_jabatan" class="border w-full min-w-max cursor-default">
                    <thead class="bg-teal-400 text-center">
                        <tr>
                            <th class="p-3 text-lg font-normal tracking-wide border-r text-left">No</th>
                            <th class="p-3 text-lg font-normal tracking-wide border-r">Kode Jabatan</th>
                            <th class="p-3 text-lg font-normal tracking-wide border-r">Nama Jabatan</th>
                            <th class="p-3 text-lg font-normal tracking-wide border-r">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layout.end')

@push('js')
<script>
    // Inisialisasi DataTable untuk tabel jabatan
    $(document).ready(() => {
        if (!$.fn.DataTable.isDataTable('#table_jabatan')) {
            $('#table_jabatan').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('admin/jabatan/list') }}",
                    dataType: "json",
                    type: "POST"
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-sm border-b border-r border-l border-gray-500/40 text-left", orderable: false, searchable: false },
                    { data: "kode_level", className: "text-sm border-b border-r border-l border-gray-500/40", orderable: true, searchable: true },
                    { data: "nama_level", className: "text-sm border-b border-r border-l border-gray-500/40", orderable: true, searchable: true },
                    { data: "aksi", className: "flex text-sm border-b border-r border-l border-gray-500/40", orderable: false, searchable: false }
                ],
                order: [[1, 'asc']]
            });
        }
    });
</script>
@endpush

@stack('js')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
