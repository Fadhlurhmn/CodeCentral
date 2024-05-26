@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap bg-gray-100">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow p-6">
        <div class="container h-full bg-white shadow-md rounded-lg p-6">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-b-2 border-teal-500">
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-800">Daftar Permintaan</h1>
                <p class="pb-5 my-2 text-md text-gray-600">Daftar Permintaan Bantuan Sosial dan Rekomendasi Sistem Penerima.</p>
                
                <a href="{{ url('admin/bansos/'.$bansos[0]->id_bansos.'/show') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                
                <!-- Section for 'acc' and 'tolak' statuses -->
                <div class="mt-6">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-bold text-gray-700">Rekomendasi Penerima</h2>
                    </div>
                    <form action="{{ url('admin/bansos/'.$bansos[0]->id_bansos.'/update_acc_bansos') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_bansos" value="{{ $bansos[0]->id_bansos }}">
                        <div class="overflow-x-auto mt-4">
                            <table class="table-auto w-full min-w-max text-center cursor-default">
                                <thead class="bg-teal-500 text-white">
                                    <tr>
                                        <th class="p-3 text-sm font-medium tracking-normal">No Keluarga</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Kepala Keluarga</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Alamat</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Ranking</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Status</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    @foreach ($bansos as $ban)
                                        <tr class="border-b">
                                            <td class="p-3">{{ $ban->nomor_keluarga }}</td>
                                            <td class="p-3">{{ $ban->nama_kepala_keluarga }}</td>
                                            <td class="p-3">{{ $ban->alamat }}</td>
                                            <td class="p-3">{{ $ban->rank }}</td>
                                            <td class="p-3">
                                                <select name="status[{{ $ban->id_keluarga }}]" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
                                                    <option value="tolak" {{ $ban->status == 'tolak' ? 'selected' : '' }}>Tolak</option>
                                                    <option value="acc" {{ $ban->status == 'acc' ? 'selected' : '' }}>Acc</option>
                                                </select>
                                            </td>
                                            <td class="p-3">
                                                <a href="{{ url('admin/bansos/'.$ban->id_bansos.'/keluarga/'.$ban->id_keluarga) }}" class="text-teal-500 hover:text-teal-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="p-2 font-normal text-center shadow-sm bg-teal-500 hover:bg-teal-600 hover:shadow-md hover:shadow-teal-300 text-xs text-white transition duration-300 ease-in-out rounded-lg">Simpan</button>
                        </div>
                    </form>
                                        
                </div>

                <!-- Pagination -->
                <div id="pagination" class="flex justify-center mt-4 space-x-2">
                    {{-- {{ $requests->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
</div>

@include('layout.end')
