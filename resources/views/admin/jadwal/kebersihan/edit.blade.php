@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">

        <div class="w-full h-fit min-w-max p-5 ">
            @include('layout.breadcrumb2')
            <form id="kebersihanForm" method="post" action="{{ url('admin/jadwal/kebersihan') }}" class="px-10 py-10 bg-white outline-none outline-4 outline-gray-700 rounded-xl">
                @csrf
                <div class="col-span-1 p-3 border-2 border-teal-400 rounded-lg">
                    {{-- Button --}}
                    <div class="mb-5 text-xs">
                      <h2 class="mb-3 text-xl font-bold text-gray-600">Jadwal Pengangkutan Sampah</h2>
                    </div>
                    {{-- Tabel --}}
                    <div class="overflow-y-auto custom-scrollbar">
                      
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
                                    <td class="p-3 text-sm text-center border border-teal-300">
                                        <input type="readonly" name="hari" value="{{ $jadwal_kebersihan->hari }}">
                                    </td>
                                    <td class="p-3 text-sm text-center border border-teal-300">
                                        {{-- <input type="text" name="waktu" value="{{ $jadwal_kebersihan->waktu }}"> --}}
                                        <select name="waktu" id="waktu">
                                            <option value="{{$jadwal_kebersihan->id}}" selected hidden>{{$jadwal_kebersihan->waktu}}</option>
                                            <option value="Tidak ada">Tidak ada</option>
                                            <option value="08:00 - 12:00">08:00 - 12:00</option>
                                            <option value="12:00 - 16:00">12:00 - 16:00</option>
                                        </select>
                                    </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                    </div>
                </div>
    
                <div class="flex py-2 mt-5 justify-start group col-span-full">
                    <a href="{{ url('admin/jadwal') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')
