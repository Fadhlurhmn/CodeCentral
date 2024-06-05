{{-- Styling tambahan manual --}}
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

@include('layout.rt_navbar')

<div class="h-screen w-full flex flex-row flex-wrap">
    @include('layout.rt_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow">
        
        <div class="h-screen bg-white overflow-y-auto custom-scrollbar">
            
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500 cursor-default">
                {{-- Detail --}}
                @include('layout.breadcrumb2')
                <h1 class=" my-2 text-xl font-extrabold text-gray-600">Penerima Bansos {{$bansos->nama}}</h1>
                <p class="pb-5 my-2 text-md text-gray-600">Detail Penerima Bantuan Sosial {{$bansos->nama}} diberikan oleh <b>{{$bansos->pengirim}}</b> untuk {{$bansos->jumlah_penerima}} orang dalam bentuk {{ $bansos->bentuk_pemberian }}.</p>

                <div class="flex justify-end">
                    @if ($detail_bansos->isNotEmpty())
                    <a href="{{ url('rt/bansos/'.$bansos->id_bansos.'/daftar') }}" class="p-2 font-normal text-center shadow-sm bg-teal-500 hover:bg-teal-600 hover:shadow-md hover:shadow-teal-300 text-xs text-white transition duration-300 ease-in-out rounded-lg">Cek Daftar Permintaan</a>
                    @endif            
                </div>
                
                {{-- Jika tidak ada data penerima --}}
                @if ($bansos_acc->isEmpty())
                <div class="p-4 mt-10 mb-3 bg-neutral-50 flex justify-center shadow-md rounded-md" id="noResults">
                    <div class="flex-col text-center">
                        <h1 class="text-lg font-bold text-gray-600">Data Tidak Ditemukan</h1>
                        <p class="text-xs text-gray-500">Tidak ada data untuk penerima bantuan sosial ini.</p>
                    </div>
                </div>
                @else

                    <!-- Filter Section -->
                    <div class="flex px-2 justify-between items-center mb-4 mt-7">
                        <div class="flex items-center">
                            <label for="filter-periode" class="mr-2 font-semibold text-sm text-gray-700 ">List Penerima:</label>
                        </div>

                        <!-- Search Bar -->
                        <div class="flex items-center">
                            <input type="text" id="search-bar" placeholder="Cari Nomor Keluarga..." class="p-2 text-xs border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                    </div>

                    <div class="h-auto p-2">
                        <table id="table_keluarga" class="table-auto w-full min-w-max text-center cursor-default">
                            <thead class="bg-teal-500 text-white">
                                <tr>
                                    <th class="p-3 text-sm font-medium tracking-normal">Nomor Keluarga</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">Kepala Keluarga</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">Tanggal</th> 
                                    <th class="p-3 text-sm font-medium tracking-normal">Alamat</th> 
                                </tr>
                            </thead>
                            <tbody id="table-body" class="text-gray-700">
                                @foreach($bansos_acc as $index => $detail)
                                    <tr class="border-b">
                                        <td class="p-3 text-sm">{{ $detail->nomor_keluarga }}</td>
                                        <td class="p-3 text-sm">{{ $detail->nama_kepala_keluarga }}</td>
                                        <td class="p-3 text-sm">{{ $detail->tanggal_pemberian }}</td>
                                        <td class="p-3 text-sm">{{ $detail->alamat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="no-search-results" class="p-4 mt-10 mb-3 bg-neutral-50 flex justify-center shadow-md rounded-md hidden">
                            <div class="flex-col text-center">
                                <h1 class="text-lg font-bold text-gray-600">Data tidak ditemukan</h1>
                                <p class="text-xs text-gray-500">Tidak ada data yang cocok dengan pencarian Anda.</p>
                            </div>
                        </div>
                    </div> 
                @endif

                <!-- Pagination -->
                <div id="pagination" class="flex justify-center mt-4 space-x-2">
                    <!-- Pagination buttons will be inserted here -->
                </div>
                <a href="{{ url('rt/bansos/') }}" class="mx-7 p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
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

            const filteredData = originalData.filter(row => {
                const noKeluarga = row.children[0].textContent.toLowerCase();
                return noKeluarga.includes(searchTerm);
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

        renderTable(originalData);
    });
</script>
