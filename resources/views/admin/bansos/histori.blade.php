@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow">
        <div class="container h-full bg-white">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-b-2 border-teal-500">
                {{-- Detail --}}
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600">{{ $page->title }}</h1>

                <!-- Filter Section -->
                <div class="flex justify-between">
                    <a href="{{ url('admin/bansos/') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                </div>
                <div class="flex px-2 justify-between items-center text-xs mb-4 mt-7">
                    <div class="flex items-center">
                        <label for="filter_bansos" class="mr-2 text-gray-700">Jenis Bantuan Sosial: </label>
                        <select id="filter_bansos" name="filter_bansos" class="uppercase p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="" hidden>Pilih Jenis</option>
                            @foreach($bansos as $Bansos)
                            <option value="{{$Bansos->id_bansos}}">{{$Bansos->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-4">
                        <input type="text" id="search-bar" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Cari Nomor Keluarga...">
                    </div>
                </div>

                <div class="h-auto p-2">
                    <table id="table_keluarga" class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-500 px-10">
                            <tr>
                                <th class="p-3 text-sm tracking-normal text-left">Nama Bantuan</th>
                                <th class="p-3 text-sm tracking-normal text-left">No Keluarga</th>
                                <th class="p-3 text-sm tracking-normal text-left">Nama Kepala Keluarga</th>
                                <th class="p-3 text-sm tracking-normal text-left">Alamat</th>
                                <th class="p-3 text-sm tracking-normal text-left">Tanggal</th>
                            </tr>
                        </thead>                        
                        <tbody id="table-body" class="text-gray-700 text-left">
                            @foreach($histori_bansos as $bansos)
                                <tr>
                                    <td class="p-3 text-sm tracking-normal">{{ $bansos->nama_bansos }}</td>
                                    <td class="p-3 text-sm tracking-normal">{{ $bansos->nomor_keluarga }}</td>
                                    <td class="p-3 text-sm tracking-normal">{{ $bansos->nama_kepala_keluarga }}</td>
                                    <td class="p-3 text-sm tracking-normal">{{ $bansos->alamat }}</td>
                                    <td class="p-3 text-sm tracking-normal">{{ $bansos->tanggal_pemberian }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="no-search-results" class="p-4 mt-3 mb-3 bg-neutral-50 flex justify-center shadow-md rounded-md hidden">
                        <div class="flex-col text-center">
                            <h1 class="text-lg font-bold text-gray-600">Data tidak ditemukan</h1>
                            <p class="text-xs text-gray-500">Tidak ada data yang cocok dengan pencarian Anda.</p>
                        </div>
                    </div>
                    <div id="pagination" class="flex justify-center mt-4">
                        {{-- Pagination --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
</div>

@include('layout.end')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rowsPerPage = 10;
        let currentPage = 1;

        const tableBody = document.getElementById('table-body');
        const pagination = document.getElementById('pagination');
        const searchBar = document.getElementById('search-bar');
        const filterBansos = document.getElementById('filter_bansos');
        console.log('filterBansos');
        const noSearchResults = document.getElementById('no-search-results');

        const originalData = Array.from(tableBody.children);

        function renderTable(data, page = 1) {
            tableBody.innerHTML = '';

            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = data.slice(start, end);

            paginatedData.forEach((row, index) => {
                tableBody.appendChild(row);
            });

            renderPagination(data.length);
        }

        function renderPagination(totalRows) {
            pagination.innerHTML = '';

            const totalPages = Math.ceil(totalRows / rowsPerPage);

            const createButton = (label, page) => {
                const button = document.createElement('button');
                button.textContent = label;
                button.classList.add('px-3', 'py-1', 'border', 'rounded', 'text-white', 'bg-teal-500', 'hover:bg-teal-600', 'hover:text-white', 'transition', 'duration-300', 'ease-in-out');
                if (page === currentPage) {
                    button.classList.add('bg-teal-600');
                }
                button.addEventListener('click', () => {
                    currentPage = page;
                    filterAndRenderTable();
                });
                return button;
            };

            if (currentPage > 1) {
                pagination.appendChild(createButton('First', 1));
                pagination.appendChild(createButton('Previous', currentPage - 1));
            }

            for (let i = 1; i <= totalPages; i++) {
                pagination.appendChild(createButton(i, i));
            }

            if (currentPage < totalPages) {
                pagination.appendChild(createButton('Next', currentPage + 1));
                pagination.appendChild(createButton('Last', totalPages));
            }
        }

        function filterAndRenderTable() {
            const searchTerm = searchBar.value.toLowerCase();
            const selectedBansos = filterBansos.value;

            const filteredData = originalData.filter(row => {
                const jenisBansos = row.children[0].textContent.toLowerCase();
                const noKeluarga = row.children[1].textContent.toLowerCase();
                return noKeluarga.includes(searchTerm) && (selectedBansos === "" || jenisBansos.includes(selectedBansos.toLowerCase()));
            });

            if (filteredData.length === 0) {
                noSearchResults.classList.remove('hidden');
            } else {
                noSearchResults.classList.add('hidden');
            }

            renderTable(filteredData, currentPage);
        }

        searchBar.addEventListener('input', () => {
            currentPage = 1;
            filterAndRenderTable();
        });

        filterBansos.addEventListener('change', () => {
            currentPage = 1;
            filterAndRenderTable();
        });

        renderTable(originalData);
    });
</script>
