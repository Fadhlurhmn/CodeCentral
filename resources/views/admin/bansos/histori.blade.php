@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow">
        <div class="container h-full bg-white">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-b-2 border-teal-500">
                {{-- Detail --}}
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600">Histori Penerima Bansos </h1>

                <div class="flex justify-between">
                    <a href="{{ url('admin/bansos/') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>          
                </div>

                    <div class="h-auto p-2">
                        <table id="table_keluarga" class="table-auto w-full min-w-max text-center cursor-default">
                            <thead class="bg-teal-500 text-white">
                                <tr>
                                    <th class="p-3 text-sm font-medium tracking-normal">Nama Bansos</th> 
                                    <th class="p-3 text-sm font-medium tracking-normal">Tanggal</th> 
                                    <th class="p-3 text-sm font-medium tracking-normal">Nomor Keluarga</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">Kepala Keluarga</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">Alamat</th> 
                                </tr>
                            </thead>
                            <tbody id="table-body" class="text-gray-700">
                                @foreach($histori_bansos as $index => $detail)
                                    <tr class="border-b">
                                        <td class="p-3 text-sm">{{ $detail->nama_bansos }}</td>
                                        <td class="p-3 text-sm">{{ $detail->tanggal_pemberian }}</td>
                                        <td class="p-3 text-sm">{{ $detail->nomor_keluarga }}</td>
                                        <td class="p-3 text-sm">{{ $detail->nama_kepala_keluarga }}</td>
                                        <td class="p-3 text-sm">{{ $detail->alamat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                <!-- Pagination -->
                <div id="pagination" class="flex justify-center mt-4 space-x-2">
                    <!-- Pagination buttons will be inserted here -->
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
</div>

@include('layout.end')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rowsPerPage = 5;
        let currentPage = 1;

        const tableBody = document.getElementById('table-body');
        const pagination = document.getElementById('pagination');
        const searchBar = document.getElementById('search-bar');
        const filterPeriode = document.getElementById('filter-periode');

        const originalData = Array.from(tableBody.children);

        function renderTable(data, page = 1) {
            tableBody.innerHTML = '';

            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = data.slice(start, end);

            paginatedData.forEach((row, index) => {
                row.querySelector('td:first-child').textContent = start + index + 1;
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
                button.classList.add('px-3', 'py-1', 'border', 'rounded', 'text-white', 'bg-teal-500', 'hover:bg-teal-500', 'hover:text-white', 'transition', 'duration-300', 'ease-in-out');
                if (page === currentPage) {
                    button.classList.add('bg-teal-500', 'text-white');
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
            const selectedPeriod = filterPeriode.value;

            const filteredData = originalData.filter(row => {
                const noKeluarga = row.children[1].textContent.toLowerCase();
                const matchesSearch = noKeluarga.includes(searchTerm);
                const matchesPeriod = selectedPeriod === '' || noKeluarga.includes(selectedPeriod); // Adjust this logic based on actual data structure

                return matchesSearch && matchesPeriod;
            });

            renderTable(filteredData, currentPage);
        }

        searchBar.addEventListener('input', () => {
            currentPage = 1;
            filterAndRenderTable();
        });

        filterPeriode.addEventListener('change', () => {
            currentPage = 1;
            filterAndRenderTable();
        });

        renderTable(originalData);
    });
</script>
