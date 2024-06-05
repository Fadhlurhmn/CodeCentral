@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">

        <div class="w-full h-fit min-w-max p-5 ">
            @include('layout.breadcrumb2')
            <form id="kebersihanForm" method="post" action="{{ url('admin/jadwal/kebersihan') }}">
                @csrf
                <div class="grid grid-cols-4 gap-4 text-sm">
                    <div class="col-span-full">
                        <table class="min-w-full bg-white border rounded-lg">
                            <thead class="bg-teal-400 text-center">
                                <tr>
                                    <th class="py-2 px-4 font-normal border border-teal-300">Hari</th>
                                    <th class="py-2 px-4 font-normal border border-teal-300">Waktu</th>
                                    {{-- <th class="py-2 px-4 font-normal border border-teal-300">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody id="satpamTableBody">
                                @foreach ($jadwal_kebersihan as $item)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            <input type="hidden" name="id[]" value="{{ $item->id_jadwal }}">
                                            <input type="hidden" name="hari[]" value="{{ $item->hari }}" required>
                                            <input type="text" name="hari[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" value="{{ $item->hari }}" disabled>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <select name="waktu[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" required>
                                                <option value="Tidak ada" {{ $item->waktu == 'Tidak ada' ? 'selected' : '' }}>Tidak ada</option>
                                                <option value="08:00 - 12:00" {{ $item->waktu == '08:00 - 12:00' ? 'selected' : '' }}>08:00 - 12:00</option>
                                                <option value="12:00 - 16:00" {{ $item->waktu == '12:00 - 16:00' ? 'selected' : '' }}>12:00 - 16:00</option>
                                            </select>                                            
                                            {{-- <input type="text" name="waktu[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" value="{{ $item->waktu }}" required> --}}
                                        </td>
                                        {{-- <td class="border px-4 py-2 text-center">
                                            <button type="button" class="removeRow bg-red-600 text-white px-3 py-1 rounded-md shadow hover:bg-red-700">Hapus</button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <button id="addRow" class="p-2 mr-5 font-normal text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg">Tambah Data</button> --}}
                </div>
    
                <div class="flex py-2 px-3 mt-5 justify-start group col-span-full">
                    <a href="{{ url('admin/jadwal') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')

<script>
    // $(document).ready(function() {
    //     $('#addRow').click(function() {
    //         $('#satpamTableBody').append(`
    //             <tr>
    //                 <td class="border px-4 py-2">
    //                     <input type="hidden" name="id[]" value="">
    //                     <input type="text" name="hari[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" required>
    //                 </td>
    //                 <td class="border px-4 py-2">
    //                     <input type="text" name="waktu[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" required>
    //                 </td>
    //                 <td class="border px-4 py-2 text-center">
    //                     <button type="button" class="removeRow bg-red-600 text-white px-3 py-1 rounded-md shadow hover:bg-red-700">Hapus</button>
    //                 </td>
    //             </tr>
    //         `);
    //     });

    //     $(document).on('click', '.removeRow', function() {
    //         $(this).closest('tr').remove();
    //     });
    // });
</script>
