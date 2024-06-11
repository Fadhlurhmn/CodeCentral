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

@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex">
    @include('layout.a_sidebar')
    
        <div class="flex flex-col flex-grow bg-white custom-scrollbar">
            <div class="container mx-auto bg-white cursor-default custom-scrollbar">
                <div class="p-5 text-sm font-normal rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
                    @include('layout.breadcrumb2')

                    <!-- Tabel Jadwal Keamanan -->
                    <div class="overflow-auto">
                        <form action="{{ url('admin/jadwal/keamanan/update') }}" method="POST">
                            @csrf
    
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
                                                        <select name="schedule[{{ $day }}][{{ $shift }}][]" class="w-full">
                                                            @foreach ($satpam as $person)
                                                                <option value="{{ $person->id_satpam }}"
                                                                    @if($entry->id_satpam == $person->id_satpam) selected @endif>
                                                                    {{ $person->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endforeach
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
    
                            <div class="flex mt-5 px-3 justify-start group space-x-3">
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
