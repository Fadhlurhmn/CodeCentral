@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap bg-gray-100">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow p-6">
        <div class="container h-full bg-white shadow-md rounded-lg p-6">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-b-2 border-teal-500">
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-800">Daftar Permintaan</h1>
                <p class="pb-5 my-2 text-md text-gray-600">Informasi daftar permintaan warga terhadap bansos.</p>
                <a href="{{ url('admin/bansos/detail') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                
                <!-- Section for 'acc' and 'tolak' statuses -->
                <div class="mt-6">
                    <h2 class="text-xl font-bold text-gray-700">Permintaan Diterima atau Ditolak</h2>
                    <div class="overflow-x-auto mt-4">
                        <table class="table-auto w-full min-w-max text-center cursor-default">
                            <thead class="bg-teal-500 text-white">
                                <tr>
                                    <th class="p-3 text-sm font-medium tracking-normal">No</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">No Keluarga</th>
                                    {{-- <th class="p-3 text-sm font-medium tracking-normal">Nama</th> --}}
                                    <th class="p-3 text-sm font-medium tracking-normal">Tanggal</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <!-- Data rows for 'acc' and 'tolak' statuses will be inserted here -->
                                {{-- @foreach ($requests as $request)
                                    @if ($request->status == 'acc' || $request->status == 'tolak') --}}
                                    <tr class="border-b">
                                        {{-- <td class="p-3">{{ $request->no }}</td>
                                        <td class="p-3">{{ $request->no_keluarga }}</td>
                                        <td class="p-3">{{ $request->nama }}</td>
                                        <td class="p-3">{{ $request->tanggal }}</td> --}}
                                        <td class="p-3">No</td>
                                        <td class="p-3">12345</td>
                                        {{-- <td class="p-3"></td> --}}
                                        <td class="p-3">12-09-2023</td>
                                        <td class="p-3">
                                            {{-- <span class="px-2 py-1 rounded-full text-white {{ $request->status == 'acc' ? 'bg-green-500' : 'bg-red-500' }}">
                                                {{ ucfirst($request->status) }}
                                            </span> --}}
                                            <span class="px-2 py-1 rounded-full text-white bg-red-500">
                                                terima
                                            </span>
                                        </td>
                                    </tr>
                                    {{-- @endif
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section for 'pending' status -->
                <div class="mt-6">
                    <h2 class="text-xl font-bold text-gray-700">Permintaan Pending</h2>
                    <div class="overflow-x-auto mt-4">
                        <table class="table-auto w-full min-w-max text-center cursor-default">
                            <thead class="bg-teal-500 text-white">
                                <tr>
                                    <th class="p-3 text-sm font-medium tracking-normal">No</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">No Keluarga</th>
                                    {{-- <th class="p-3 text-sm font-medium tracking-normal">Nama</th> --}}
                                    <th class="p-3 text-sm font-medium tracking-normal">Tanggal</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">Status</th>
                                    <th class="p-3 text-sm font-medium tracking-normal">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <!-- Data rows for 'pending' status will be inserted here -->
                                {{-- @foreach ($requests as $request)
                                    @if ($request->status == 'pending') --}}
                                    <tr class="border-b">
                                        {{-- <td class="p-3">{{ $request->no }}</td>
                                        <td class="p-3">{{ $request->no_keluarga }}</td>
                                        <td class="p-3">{{ $request->nama }}</td>
                                        <td class="p-3">{{ $request->tanggal }}</td>
                                        <td class="p-3">
                                            <span class="px-2 py-1 rounded-full text-white bg-yellow-500">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td> --}}
                                        <td class="p-3">1</td>
                                        <td class="p-3">987654321</td>
                                        <td class="p-3">12-09-2002</td>
                                        {{-- <td class="p-3"></td> --}}
                                        <td class="p-3">
                                            <span class="px-2 py-1 rounded-full text-white bg-yellow-500">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="p-3 space-x-2">
                                            {{-- <button onclick="updateStatus('{{ $request->id }}', 'acc')" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Terima</button>
                                            <button onclick="updateStatus('{{ $request->id }}', 'tolak')" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Tolak</button> --}}
                                            <button onclick="updateStatus('', 'acc')" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Terima</button>
                                            <button onclick="updateStatus('', 'tolak')" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Tolak</button>
                                        </td>
                                    </tr>
                                    {{-- @endif
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
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
    function updateStatus(requestId, status) {
        // Send a POST request to update the status of the request
        fetch(`/requests/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: requestId, status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to update status');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
