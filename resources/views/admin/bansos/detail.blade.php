@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow">
        <div class="container h-full bg-white">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600">Detail Penerima Bansos</h1>
                
                <!-- Filter Section -->
                <div class="flex px-2 justify-between items-center text-xs mb-4">
                    <div class="flex items-center">
                        <label for="filter-periode" class="mr-2 text-gray-700">Periode:</label>
                        <select id="filter-periode" class="p-2 border border-gray-300 rounded">
                            <option value="">Semua</option>
                            <option value="januari">Januari</option>
                            <option value="februari">Februari</option>
                            <option value="maret">Maret</option>
                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <!-- Search Bar -->
                    <div class="flex items-center">
                        <input type="text" id="search-bar" placeholder="Cari Nomer Keluarga..." class="p-2 border border-gray-300 rounded">
                    </div>
                </div>

                <div class="h-auto p-2">
                    <table id="table_keluarga" class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-400">
                            <tr>
                                <th class="p-3 text-sm font-normal tracking-normal">No</th>
                                <th class="p-3 text-sm font-normal tracking-normal">No Keluarga</th>
                                <th class="p-3 text-sm font-normal tracking-normal">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Data rows will be inserted here -->
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi -->
                <div id="pagination" class="flex justify-center mt-4">
                    <!-- Pagination buttons will be inserted here -->
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
</div>

@include('layout.end')

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const filterPeriode = document.getElementById('filter-periode');
    const searchBar = document.getElementById('search-bar');
    const tableBody = document.getElementById('table-body');
    const pagination = document.getElementById('pagination');

    filterPeriode.addEventListener('change', filterData);
    searchBar.addEventListener('input', filterData);

    function filterData() {
        const periode = filterPeriode.value.toLowerCase();
        const searchQuery = searchBar.value.toLowerCase();

        // Fetch and filter data (dummy data example)
        const data = [
            { no: 1, noKeluarga: '12345', tanggal: '2023-01-15' },
            { no: 2, noKeluarga: '67890', tanggal: '2023-02-20' },
            // Add more data here
        ];

        const filteredData = data.filter(item => {
            const itemTanggal = new Date(item.tanggal).toLocaleString('id-ID', { month: 'long' }).toLowerCase();
            const matchesPeriode = periode ? itemTanggal.includes(periode) : true;
            const matchesSearch = item.noKeluarga.includes(searchQuery);

            return matchesPeriode && matchesSearch;
        });

        renderTable(filteredData);
        renderPagination(filteredData);
    }

    function renderTable(data) {
        tableBody.innerHTML = '';
        data.forEach(item => {
            const row = `<tr>
                <td class="p-3">${item.no}</td>
                <td class="p-3">${item.noKeluarga}</td>
                <td class="p-3">${item.tanggal}</td>
            </tr>`;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    function renderPagination(data) {
        // Implement pagination if needed
        pagination.innerHTML = '';
        // Example pagination buttons
        if (data.length > 10) {
            pagination.innerHTML = `
                <button class="mx-1 px-3 py-1 border rounded">Previous</button>
                <button class="mx-1 px-3 py-1 border rounded">Next</button>
            `;
        }
    }

    // Initial render
    filterData();
});

</script>
