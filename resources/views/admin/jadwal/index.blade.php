
  
  <div class="container h-full bg-white cursor-default">
    {{-- <h1 class="py-5 ml-5 text-3xl text-gray-900 font-bold">{{$breadcrumb->title}}</h1> --}}
    {{-- Start Isi --}}
    <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
      @include('layout.breadcrumb2')
  
  
      <!-- Tabel Jadwal Keamanan -->
      {{-- Button --}}
      <div class="mb-5 text-xs">
        <a class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{ url('admin/jadwal/update_keamanan') }}">Ubah Jadwal Keamanan</a>
      </div>
      {{-- Tabel --}}
      <div class="h-auto p-2 mb-10 border-2 border-teal-400 rounded-lg">
        <h2 class="pb-5 my-2 text-xl font-bold text-gray-600">Jadwal Petugas Satpam</h2>
        <table id="table_keamanan" class="w-full min-w-max cursor-default border-collapse">
          <thead class="bg-teal-400 text-center">
            <tr>
              <th class="p-3 text-sm font-normal border border-teal-300">Shift</th>
              @foreach ($jadwal_keamanan->hari as $hari)
                <th class="p-3 text-sm font-normal border border-teal-300">{{ $hari }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($jadwal_keamanan->waktu as $index => $waktu)
              <tr>
                <td class="p-3 text-sm text-center bg-teal-300 border border-teal-300">{{ $waktu }}</td>
                @foreach ($jadwal_keamanan->hari as $hariIndex => $hari)
                  <td class="p-3 text-sm text-center border border-teal-300">
                    {{ $jadwal_keamanan->nama[$hariIndex][$index] }}<br>
                    <span class="text-xs text-gray-500">({{ $jadwal_keamanan->telepon[$hariIndex][$index] }})</span>
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
        <h2 class="pb-5 my-2 text-xl font-bold text-gray-600">Jadwal Pengangkutan Sampah</h2>
        <!-- Debugging -->
        {{-- <pre>{{ print_r($jadwal_kebersihan, true) }}</pre> --}}
        <!-- End Debugging -->
        @if(isset($jadwal_kebersihan) && is_object($jadwal_kebersihan) && count($jadwal_kebersihan->hari) > 0)
        <table id="table_kebersihan" class="w-full min-w-max cursor-default border-collapse">
            <thead class="bg-teal-400 text-center">
                <tr>
                    <th class="p-3 text-sm font-normal border border-teal-300">Hari</th>
                    <th class="p-3 text-sm font-normal border border-teal-300">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal_kebersihan->hari as $index => $hari)
                <tr>
                    <td class="p-3 text-sm text-center border border-teal-300">{{ $hari }}</td>
                    <td class="p-3 text-sm text-center border border-teal-300">{{ $jadwal_kebersihan->waktu[$index % count($jadwal_kebersihan->waktu)] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-4 mb-5 border-2 border-teal-400 bg-neutral-50 flex justify-center shadow-md rounded-md" id="noResults">
            <div class="flex-col text-center">
                <h1 class="text-xl font-bold text-gray-600">Tidak ada Jadwal Kebersihan</h1>
                <p class="text-xs text-gray-500">Jadwal Kebersihan Belum Dibuat.</p>
            </div>
        </div>
        @endif
      </div>
      {{-- End Tabel Kebersihan --}}

    </div>
    {{-- End Isi --}}

  </div>


<script>
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
