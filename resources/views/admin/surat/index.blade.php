<div class="container h-full bg-white">
  {{-- <h1 class="py-5 ml-5 text-3xl text-gray-900 font-bold">{{$breadcrumb->title}}</h1> --}}
  
  <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
      {{-- <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600"> {{$page->title}}</h1> --}}
      <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600"> Halaman Persuratan</h1>
      <div class="mb-5 text-xs flex justify-between">
      </div>
      <div class="h-auto p-2">
          <table id="table_penduduk" class="w-full min-w-max cursor-default">
              <thead class="bg-teal-400 px-10 text-center justify-between">
                  <tr>
                      <th class="p-3 text-sm font-normal">No</th>
                      <th class="p-3 text-sm font-normal">Nama Pelapor</th>
                      <th class="p-3 text-sm font-normal">Deskripsi</th>
                      <th class="p-3 text-sm font-normal">Tanggal Pengaduan</th>
                      <th class="p-3 text-sm font-normal">Aksi</th>
                  </tr>
              </thead>
              <tbody class=" justify-between text-center text-xs border-b border-gray-500/40 ">
                  <!-- Data akan dimasukkan di sini -->
                <tr>
                  <td>1</td>
                  <td>1</td>
                  <td>1</td>
                  <td>1</td>
                  <td class="flex justify-center">
                    <a href="#" class="btn btn-primary ml-1 flex-col"><i class="fas fa-info-circle"></i></i></a>
                    <a href="#" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a>
                  </td>
                </tr>
              </tbody>
          </table>
      </div>
  </div>
</div>

{{-- @push('js')
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
@endpush
@stack('js')
<script>
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script> --}}