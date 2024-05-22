@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 md:mt-16"> 

    
    {{-- Place your code here --}}
    <div class="flex-col flex-grow">

{{--  --}}
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">{{ $breadcrumb->title }}</h2>

    <!-- Tabel Jadwal Keamanan -->
      {{-- Tabel --}}
      <div class="h-auto p-2 mb-10 border-2 border-teal-400 rounded-lg">
        <h2 class="pb-5 my-2 text-xl font-bold text-gray-600">Jadwal Keamanan</h2>
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
                  <td class="p-3 text-sm text-center border border-teal-300 cursor-pointer"  contenteditable="true">
                    {{-- @foreach($jadwal_keamanan->waktu as $index2 => $waktu) --}}
                    {{ $jadwal_keamanan->nama[$hariIndex][$index] }}<br>
                    {{-- @endforeach --}}
                    <span class="text-xs text-gray-500">({{ $jadwal_keamanan->telepon[$index] }})</span>
                  </td>
                @endforeach
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- Submit Button --}}
    <div class="flex">
        <a href="{{ url('admin/jadwal') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
        <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
    </div>
</div>
{{--  --}}
</div>
</div>
<!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')


