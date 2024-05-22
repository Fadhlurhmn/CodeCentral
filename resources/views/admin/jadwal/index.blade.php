<div class="container h-full bg-white cursor-default">
  {{-- <h1 class="py-5 ml-5 text-3xl text-gray-900 font-bold">{{$breadcrumb->title}}</h1> --}}
  
  <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
    <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600">{{$page->title}}</h1>

    {{-- Data dummy --}}
    @php
      $jadwal_kebersihan = [
          'hari' => 'Senin',
          'waktu' => '08:00 - 12:00'
      ];
      $jadwal_keamanan = [
          'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
          'waktu' => ['Pagi', 'Sore', 'Malam'],
          'nama' => ['Budi', 'Adi', 'Dedi'],
          'telepon' => ['08123456789', '082122222222', '08211111111'],
      ];
    @endphp

    <!-- Tabel Jadwal Keamanan -->
    {{-- Button --}}
    <div class="mb-5 text-xs">
      <a class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{ url('admin/jadwal/update_keamanan') }}">Ubah Jadwal Keamanan</a>
    </div>
    {{-- Tabel --}}
    <div class="h-auto p-2 mb-10 border-2 border-teal-400 rounded-lg">
      <h2 class="pb-5 my-2 text-xl font-bold text-gray-600">Jadwal Keamanan</h2>
      <table id="table_keamanan" class="w-full min-w-max cursor-default border-collapse">
        <thead class="bg-teal-400 text-center">
          <tr>
            <th class="p-3 text-sm font-normal border border-teal-300">Shift</th>
            @foreach ($jadwal_keamanan['hari'] as $hari)
              <th class="p-3 text-sm font-normal border border-teal-300">{{ $hari }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($jadwal_keamanan['waktu'] as $index => $waktu)
            <tr>
              <td class="p-3 text-sm text-center bg-teal-300 border border-teal-300">{{ $waktu }}</td>
              @foreach ($jadwal_keamanan['hari'] as $hariIndex => $hari)
                <td class="p-3 text-sm text-center border border-teal-300">
                  {{ $jadwal_keamanan['nama'][$index % count($jadwal_keamanan['nama'])] }}<br>
                  <span class="text-xs text-gray-500">({{ $jadwal_keamanan['telepon'][$index % count($jadwal_keamanan['telepon'])] }})</span>
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>


    <!-- Tabel Jadwal Kebersihan -->
    {{-- Button --}}
    <div class="mb-5 text-xs">
        <a class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{ url('admin/jadwal/update_kebersihan') }}">Ubah Jadwal Kebersihan</a>
    </div>
    {{-- Tabel --}}
    <div class="h-auto p-2 mb-10 border-2 border-teal-400 rounded-lg">
      <h2 class="pb-5 my-2 text-xl font-bold text-gray-600">Jadwal Kebersihan</h2>
      <table id="table_kebersihan" class="w-full min-w-max cursor-default border-collapse">
        <thead class="bg-teal-400 text-center">
          <tr>
            <th class="p-3 text-sm font-normal border border-teal-300">Hari</th>
            <th class="p-3 text-sm font-normal border border-teal-300">Waktu</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-3 text-sm text-center border border-teal-300">{{ $jadwal_kebersihan['hari'] }}</td>
            <td class="p-3 text-sm text-center border border-teal-300">{{ $jadwal_kebersihan['waktu'] }}</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>


@push('js')
{{-- <script>
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
</script> --}}
@endpush
{{-- @stack('js') --}}
<script>
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>