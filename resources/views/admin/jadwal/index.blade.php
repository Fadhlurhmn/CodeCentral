  {{-- Styling tambahan manual --}}
<style>
  /* For WebKit browsers (Chrome, Safari) */
  .custom-scrollbar::-webkit-scrollbar {
      width: 0px;  /* Remove scrollbar space */
      background: transparent;  /* Optional: just make scrollbar invisible */
  }
  
  /* For Firefox */
  .custom-scrollbar {
      scrollbar-width: none;  /* Remove scrollbar space */
      -ms-overflow-style: none;  /* IE and Edge */
  }
  
  /* To make sure the custom-scrollbar class is applied properly */
  .custom-scrollbar {
      overflow-y: auto;
  }
</style>

  <div class="container h-full bg-white cursor-default">
    {{-- Start Isi --}}
    <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
      @include('layout.breadcrumb2')
  
        {{-- Tabel Satpam & Kebersihan --}}
        <div class="grid grid-cols-2 gap-3 rounded-xl h-auto">

          {{-- Tabel Untuk Daftar Satpam Bertugas  --}}
          <div class="col-span-1 p-3 border-2 border-teal-400 rounded-lg">
            {{-- Button --}}
            <div class="mb-5 text-xs">
              <h2 class="mb-3 text-xl font-bold text-gray-600">Daftar Satpam Bertugas</h2>
              <a class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{ url('admin/jadwal/satpam/create') }}">Ubah Daftar Satpam</a>
            </div>
            {{-- Tabel --}}
            <div class="h-40 overflow-y-auto custom-scrollbar">
              
              @if(isset($satpam)>0)
              <table id="table_kebersihan" class="w-full min-w-max cursor-default border-collapse">
                  <thead class="bg-teal-400 text-center">
                      <tr>
                          <th class="p-3 text-sm font-normal border border-teal-300">Nama</th>
                          <th class="p-3 text-sm font-normal border border-teal-300">Nomer Telfon</th>
                          <th class="p-3 text-sm font-normal border border-teal-300">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($satpam as $petugas)
                    <tr>
                        <td class="p-3 text-sm text-center border border-teal-300">{{ $petugas->nama }}</td>
                        <td class="p-3 text-sm text-center border border-teal-300">{{ $petugas->nomor_telepon }}</td>
                        <td class="p-3 text-sm text-center border border-teal-300"><a href="url('admin/jadwal/satpam/' . $satpam->id_satpam . '/edit')" class="btn btn-info ml-2 mr-2 flex-col"><i class="fas fa-edit"></i></a></td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
              @else
              <div class="p-4 mb-5 border-2 border-teal-400 bg-neutral-50 flex justify-center shadow-md rounded-md" id="noResults">
                  <div class="flex-col text-center">
                      <h1 class="text-xl font-bold text-gray-600">Tidak ada Daftar Satpam</h1>
                      <p class="text-xs text-gray-500">Daftar Satpam Tidak Ditemukan/Belum Dibuat</p>
                  </div>
              </div>
              @endif
            </div>
          </div>
        {{-- End Tabel Jadwal Satpam --}}


        <!-- Tabel Jadwal Kebersihan -->
          <div class="col-span-1 p-3 border-2 border-teal-400 rounded-lg">
                  {{-- Button --}}
                  <div class="mb-5 text-xs">
                    <h2 class="mb-3 text-xl font-bold text-gray-600">Jadwal Pengangkutan Sampah</h2>
                    <a href="{{ url('admin/jadwal/kebersihan/edit') }}" class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Ubah Jadwal Kebersihan</a>
                  </div>
                  {{-- Tabel --}}
                  <div class="h-40 overflow-y-auto custom-scrollbar">
                    
                    @if(isset($jadwal_kebersihan) > 0)
                    <table id="table_kebersihan" class="w-full min-w-max cursor-default border-collapse">
                        <thead class="bg-teal-400 text-center">
                            <tr>
                                <th class="p-3 text-sm font-normal border border-teal-300">Hari</th>
                                <th class="p-3 text-sm font-normal border border-teal-300">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($jadwal_kebersihan as $jadwal_kebersihan)
                            <tr>
                                <td class="p-3 text-sm text-center border border-teal-300">{{ $jadwal_kebersihan->hari }}</td>
                                <td class="p-3 text-sm text-center border border-teal-300">{{ $jadwal_kebersihan->waktu }}</td>
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
            </div>
      </div>
      {{-- End Tabel Satpam & Kebersihan --}}

      <!-- Tabel Jadwal Keamanan -->
      <div class="mt-10 p-3 border-2 border-teal-400 rounded-lg">
          {{-- Button --}}
          <div class="mb-5 text-xs">
            <h2 class="mb-5 text-xl font-bold text-gray-600">Jadwal Petugas Satpam</h2>
            <a class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg" href="{{ url('admin/jadwal/keamanan/edit') }}">Ubah Jadwal Keamanan</a>
          </div>

          <div class="h-auto p-2 mb-10">
            <table id="table_keamanan" class="w-full min-w-max cursor-default border-collapse">
                <thead class="bg-teal-400 text-center">
                    <tr>
                        <th class="p-3 text-sm font-normal border border-teal-300">Shift</th>
                        @foreach ($days as $day)
                            <th class="p-3 text-sm font-normal border border-teal-300">{{ ucfirst($day) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shifts as $shift)
                        <tr>
                            <td class="p-3 text-sm text-center bg-teal-300 border border-teal-300">{{ $shift }}</td>
                            @foreach ($days as $day)
                                <td class="p-3 text-sm text-center border border-teal-300">
                                    @foreach ($schedule[$day][$shift] as $entry)
                                        {{ $entry->nama }}<br>
                                        <span class="text-xs text-gray-500">({{ $entry->nomor_telepon }})</span><br>
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
      </div>

    </div>
    {{-- End Isi --}}

  </div>


<script>
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
