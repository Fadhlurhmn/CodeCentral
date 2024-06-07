<style>
    .swal2-actions {
        display: flex;
        justify-content: flex-end;
    }
    .swal2-actions .swal2-cancel {
        order: 1;
        margin-left: 10px;
    }
    .swal2-actions .swal2-confirm {
        order: 2;
        background-color: #38b2ac !important; /* teal-500 */
        color: white !important;
    }
    .swal2-actions .swal2-confirm:hover {
        background-color: #319795 !important; /* teal-600 */
    }
</style>

@include('layout.start')

@include('layout.rw_navbar')

<div class="h-screen w-full flex flex-row flex-wrap bg-gray-100">
    @include('layout.rw_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow p-6">
        <div class="container h-full bg-white shadow-md rounded-lg p-6">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white">
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-800">Daftar Permintaan</h1>
                <p class="pb-5 my-2 text-md text-gray-600">Daftar Permintaan Bantuan Sosial dan Rekomendasi Sistem Penerima.</p>
                
                <!-- Section for 'acc' and 'tolak' statuses -->
                <div class="mt-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-700">Rekomendasi Penerima</h2>
                        <a href="{{url('rw/bansos/'. $bansos[0]->id_bansos.'/tampil_hitung')}}" class="p-2 font-normal text-center shadow-sm bg-teal-500 hover:bg-teal-600 hover:shadow-md hover:shadow-teal-300 text-xs text-white transition duration-300 ease-in-out rounded-lg">Cek perhitungan</a>
                    </div>
                    @if(session('error'))
                    <div id="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Terjadi Kesalahan!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <button id="closeButton" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                    @endif

                    <form action="{{ url('rw/bansos/'.$bansos[0]->id_bansos.'/update_acc_bansos') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_bansos" value="{{ $bansos[0]->id_bansos }}">
                        <div class="overflow-x-auto mt-4 border-b-2 border-teal-500">
                            <table class="table-auto w-full min-w-max text-center cursor-default">
                                <thead class="bg-teal-500 text-white">
                                    <tr>
                                        <th class="p-3 text-sm font-medium tracking-normal">No Keluarga</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Kepala Keluarga</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Alamat</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Ranking</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Status</th>
                                        <th class="p-3 text-sm font-medium tracking-normal">Detail</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body" class="text-gray-700">
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
                                                <a href="{{ url('rw/bansos/'.$ban->id_bansos.'/keluarga/'.$ban->id_keluarga) }}" class="text-teal-500 hover:text-teal-600 text-lg">
                                                    <i class="fad fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-between mt-4">
                            <a href="{{ url('rw/bansos/'.$bansos[0]->id_bansos.'/show') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                            {{-- <button type="submit" class="p-2 font-normal text-center shadow-sm bg-teal-500 hover:bg-teal-600 hover:shadow-md hover:shadow-teal-300 text-xs text-white transition duration-300 ease-in-out rounded-lg">Simpan</button> --}}
                            <button type="button" id="saveButton" class="p-2 font-normal text-center shadow-sm bg-teal-500 hover:bg-teal-600 hover:shadow-md hover:shadow-teal-300 text-xs text-white transition duration-300 ease-in-out rounded-lg">Simpan</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rowsPerPage = 10;
        let currentPage = 1;

        const tableBody = document.getElementById('table-body');
        const pagination = document.getElementById('pagination');

        const originalData = Array.from(tableBody.children);

        function renderTable(data, page = 1) {
            tableBody.innerHTML = '';

            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = data.slice(start, end);

            paginatedData.forEach((row) => {
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
                    renderTable(originalData, currentPage);
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

        renderTable(originalData);
        
        // Bagian untuk sweetAlert nya 
        const saveButton = document.getElementById('saveButton');
        saveButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang telah diubah akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal',
                customClass: {
                    actions: 'swal2-actions',
                    confirmButton: 'swal2-confirm',
                    cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('form').submit();
                }
            })
        });
    });


    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('errorMessage').style.display = 'none';
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
