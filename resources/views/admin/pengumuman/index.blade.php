@csrf
<div class="container h-full bg-slate-100">
  {{-- start breadcrumb --}}
  <h1 class="py-5 ml-5 text-3xl text-gray-900">{{$breadcrumb->title}}</h1>
  {{-- end breadcrumb --}}
  <div class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white outline-none outline-4 outline-teal-500 rounded-t-3xl">
    {{-- box table title   --}}
    <p class="my-5 text-xl font-normal text-gray-600 ">{{$page->title}}</p>
      
      {{-- tombol create pengumuman --}}
      <a class="p-2 font-normal text-center text-sm bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 rounded-lg" href="{{url('pengumuman/create')}}">Tambah Pengumuman</a>
      
      <div class="relatives mt-5 h-80 overflow-x-auto p-5 shadow">
        {{-- start datatable --}}
          <table id="table_pengumuman" class="table-auto text-center border w-full min-w-max cursor-default">
              <thead class="bg-teal-400">
                  <tr>
                      <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">No</th>
                      <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Judul</th>
                      <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Tanggal publish</th>
                      <th class="p-3 text-lg font-normal justify-between tracking-wide border-r bg-">Aksi</th>
                  </tr>
              </thead>
          </table>
        {{-- end datatable --}}
      </div>
  </div>
</div>

@push('js')
<script>
  // datatable config
  $(document).ready(function() {
      var table = $('#table_pengumuman').DataTable({
          serverSide: true,
          ajax: {
              "url": "{{ url('pengumuman/list') }}",
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
                  data: "judul_pengumuman",
                  className: "text-sm",
                  orderable: true,
                  searchable: true
              },
              {
                  data: "created_at",
                  className: "text-sm",
                  orderable: true,
                  searchable: true
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