@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow">
        <div class="container h-full bg-white">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-b-2 border-teal-500">
                {{-- Detail --}}
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600">Detail Penerima Bansos {{$bansos->nama}}</h1>
                <p class="pb-5 my-2 text-md text-gray-600">Bantuan Sosial {{$bansos->nama}} diberikan oleh {{$bansos->pengirim}} untuk {{$bansos->jumlah_penerima}} orang.</p>

                <!-- Filter Section -->
                <div class="flex justify-between">
                    <a href="{{ url('admin/bansos/') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                    <a href={{ url('admin/bansos/'.$bansos->id_bansos.'/daftar') }} class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">cek daftar permintaan</a>
                </div>
                <div class="flex px-2 justify-between items-center text-xs mb-4 mt-7">
                    <div class="flex items-center">
                        <label for="filter-periode" class="mr-2 text-gray-700">Periode:</label>
                        <select id="filter-periode" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="">Semua</option>
                            <option value="januari">Januari</option>
                            <option value="februari">Februari</option>
                            <option value="maret">Maret</option>
                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                        </select>
                    </div>

                    <!-- Search Bar -->
                    <div class="flex items-center">
                        <input type="text" id="search-bar" placeholder="Cari Nomer Keluarga..." class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>
                </div>

                <div class="h-auto p-2">
                    <table id="table_keluarga" class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-500 text-white">
                            <tr>
                                <th class="p-3 text-sm font-medium tracking-normal">No</th>
                                <th class="p-3 text-sm font-medium tracking-normal">No Keluarga</th>
                                {{-- <th class="p-3 text-sm font-medium tracking-normal">Tanggal</th> --}}
                            </tr>
                        </thead>
                        <tbody id="table-body" class="text-gray-700">
                            <!-- Data rows will be inserted here -->
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi -->
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
            { no: 1, noKeluarga: '12345' },
            { no: 2, noKeluarga: '67890' },
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
            const row = `<tr class="border-b">
                <td class="p-3">${item.no}</td>
                <td class="p-3">${item.noKeluarga}</td>
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
                <button class="mx-1 px-3 py-1 border rounded hover:bg-teal-500 hover:text-white transition duration-300">Previous</button>
                <button class="mx-1 px-3 py-1 border rounded hover:bg-teal-500 hover:text-white transition duration-300">Next</button>
            `;
        }
    }

    // Initial render
    filterData();
});

</script>
