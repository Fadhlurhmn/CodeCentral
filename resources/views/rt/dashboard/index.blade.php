@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <h1 class="pb-5 my-2 text-2xl font-extrabold text-black-600">Dashboard RT</h1>
        

    <div class="grid grid-cols-3 gap-6 xl:grid-cols-1">

    <!-- start dashboard -->
    <div class="report-card">
        <div class="card">
            <div class="card-body card border border-teal-500  flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fas fa-users text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Total Kartu Keluarga</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>

    <div class="report-card">
        <div class="card">
            <div class="card-body card border border-teal-500 flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fas fa-user text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Total Penduduk</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>

    <div class="report-card">
        <div class="card">
            <div class="card-body card border border-teal-500  flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fas fa-flag text-md mr-2"></i>
        
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Total RT</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    </div>

    <!-- Tabel Penduduk -->
    <h2 class="mt-20 font-extrabold text-black-600">Tabel Data Penduduk</h2>
    <div class="h-auto p-2">
        <table id="table_penduduk" class="w-full min-w-max cursor-default">
            <thead class="bg-teal-400 px-10 text-center justify-between">
                <tr>
                    <th class="p-3 text-sm font-normal">No</th>
                    <th class="p-3 text-sm font-normal">NIK</th>
                    <th class="p-3 text-sm font-normal">Nama</th>
                    <th class="p-3 text-sm font-normal">Alamat Domisili</th>
                    <th class="p-3 text-sm font-normal">Rt</th>
                    <th class="p-3 text-sm font-normal">Status data</th>
                    <th class="p-3 text-sm font-normal">Status penduduk</th>
                    <th class="p-3 text-sm font-normal">Aksi</th>
                </tr>
            </thead>
            <tbody class=" justify-between ">
                <!-- Data akan dimasukkan di sini -->
                <tr>
                    <td class="border border-gray-300 px-4 py-2">1</td>
                    <td class="border border-gray-300 px-4 py-2">123456789</td>
                    <td class="border border-gray-300 px-4 py-2">Lina</td>
                    <td class="border border-gray-300 px-4 py-2">Jl. Remujung 12</td>
                    <td class="border border-gray-300 px-4 py-2">01</td>
                    <td class="border border-gray-300 px-4 py-2">Aktif</td>
                    <td class="border border-gray-300 px-4 py-2">Tetap</td>
                </tr>
            </tbody>
        </table>
    </div>


    
    

  





</div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#table_penduduk').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('admin/penduduk/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                { data: "DT_RowIndex",
                 className: "text-xs border-b border-gray-500/40",
                  orderable: false, 
                  searchable: false },
                { data: "nik",
                 className: "text-xs border-b border-gray-500/40",
                  orderable: true,
                 searchable: true },
                { data: "nama",
                 className: "text-xs border-b border-gray-500/40", 
                 orderable: true, 
                 searchable: true },
                { data: "alamat_domisili",
                 className: "text-xs border-b border-gray-500/40", 
                 orderable: true },
                { data: "rt",
                 className: "text-xs border-b border-gray-500/40", 
                 orderable: true, 
                 searchable: false },
                { 
                    data: "status_data",
                    className: "text-xs border-b border-gray-500/40 text-center",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        if (data === 'Aktif') {
                            return '<div class="rounded-full bg-emerald-500/60 text-emerald-800 py-1 px-2">' + data + '</div>';
                        } else {
                            return '<div class="rounded-full bg-red-500/60 text-red-900 py-1 px-2">' + data + '</div>';
                        }
                    }
                },
                { data: "status_penduduk",
                 className: "text-xs border-b border-gray-500/40 text-center", 
                 orderable: true, 
                 searchable: true },
                { data: "aksi",
                 className: "flex text-xs border-b border-gray-500/40", 
                 orderable: false, 
                 searchable: false },
            ]
        });

        $('#rt').on('change', function() {
            var selectedRt = $(this).val();
            if (selectedRt === 'all') {
                // Jika dipilih "Semua", atur URL tanpa parameter rt
                table.ajax.url("{{ url('admin/penduduk/list') }}").load();
            } else {
                // Jika dipilih nilai lain, atur URL dengan parameter rt
                table.ajax.url("{{ url('admin/penduduk/list') }}?rt=" + selectedRt).load();
            }
        });
    });
</script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>

<!-- end content -->

<!-- end wrapper -->

@include('layout.end')
