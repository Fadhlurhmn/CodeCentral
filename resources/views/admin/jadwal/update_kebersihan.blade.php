@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-2xl font-bold">{{ $page->title }}</h1>
        </div>
        <div class="w-full h-fit min-w-max p-5">
            <form id="form-kebersihan" class="px-10 py-10 bg-white outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/jadwal/kebersihan') }}" method="POST">
                <h1 class="pb-5 mb-10 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2">
                    Update Jadwal Kebersihan
                </h1>
                @csrf
            
                <!-- Tabel Jadwal Kebersihan -->
                <div class="h-auto p-2 mb-10 border-2 border-teal-400 rounded-lg">
                    <h2 class="pb-5 my-2 text-xl font-bold text-gray-600">Jadwal Kebersihan</h2>
                    <table id="table_kebersihan" class="w-full min-w-max cursor-default border-collapse">
                        <thead class="bg-teal-400 text-center">
                            <tr>
                                <th class="p-3 text-sm font-normal border border-teal-300">Hari</th>
                                <th class="p-3 text-sm font-normal border border-teal-300">Waktu</th>
                                <th class="p-3 text-sm font-normal border border-teal-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Isi form dengan input untuk baris baru -->
                            <tr>
                                <td class="p-3 text-sm text-center border border-teal-300">
                                    <select name="hari[]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>                               
                                    
                                </td>
                                <td class="p-3 text-sm text-center border border-teal-300">
                                    <select name="waktu[]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required>
                                        <option value="08:00 - 12:00">08:00 - 12:00</option>
                                        <option value="12:00 - 16:00">12:00 - 16:00</option>
                                    </select>
                                    
                                </td>
                                <td class="p-3 text-sm text-center border border-teal-300">
                                    <button type="button" class="text-red-600 hover:text-red-800" onclick="removeRow(this)">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="mt-3 text-white bg-teal-500 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs px-5 py-2.5 text-center" onclick="addRow()">Tambah Baris</button>
                </div>
            
                {{-- Submit Button --}}
                <div class="flex col-span-1">
                    <a href="{{ url('admin/jadwal') }}" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')

<script>
    let rowIndex = 1;

    function addRow() {
        const table = document.getElementById('table_kebersihan').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        const hariCell = newRow.insertCell(0);
        const waktuCell = newRow.insertCell(1);
        const actionCell = newRow.insertCell(2);

        hariCell.className = 'p-3 text-sm text-center border border-teal-300';
        waktuCell.className = 'p-3 text-sm text-center border border-teal-300';
        actionCell.className = 'p-3 text-sm text-center border border-teal-300';

        hariCell.innerHTML = `
            <select name="hari[]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
                <option value="Minggu">Minggu</option>
            </select>
        `;
        waktuCell.innerHTML = `
            <select name="waktu[]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5" required>
                <option value="08:00 - 12:00">08:00 - 12:00</option>
                <option value="12:00 - 16:00">12:00 - 16:00</option>
            </select>
        `;
        actionCell.innerHTML = `<button type="button" class="text-red-600 hover:text-red-800" onclick="removeRow(this)">Hapus</button>`;
        
        rowIndex++;
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>


