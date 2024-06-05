@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    
  @include('layout.a_sidebar')
  
    <div class="bg-white flex-1 md:mt-16">
            {{-- Place your code here --}}
        <div class="flex-col flex-grow">
            <div class="container h-full bg-white cursor-default">
                {{-- Start Isi --}}
                <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
                @include('layout.breadcrumb2')

                    <!-- Tabel Jadwal Keamanan -->
                    <form method="post" action="{{url('admin/jadwal/keamanan')}}" class="px-10 py-10 bg-white outline-none outline-4 outline-gray-700 rounded-xl">
                        @csrf

                        <div class="mt-10 p-3 border-2 border-teal-400 rounded-lg">
                            {{-- Button --}}
                            <div class="mb-5 text-xs">
                                <h2 class="mb-5 text-xl font-bold text-gray-600">Jadwal Petugas Satpam</h2>
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
                            
                            <a href="{{ url('admin/jadwal') }}" class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                            <button type="submit" class="p-2 font-normal text-center shadow-md hover:shadow-teal-300 bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.end')
