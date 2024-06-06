@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen w-full flex flex-row flex-wrap bg-gray-100">
    @include('layout.a_sidebar')
        
    <div class="flex flex-col flex-grow p-6 cursor-default">
        <div class="container h-full bg-white shadow-md rounded-lg p-6">
            @include('layout.breadcrumb2')
            
            @if (session('success'))
            <div id="successMessage" class="col-span-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button id="closeButton" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
            </div>
            @endif
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-b-2 border-teal-500">
                <table class="min-w-full divide-y divide-gray-200 text-center">
                    <thead class="bg-teal-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-xs text-left font-semibold uppercase tracking-wider">Kriteria</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">Bobot</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">Jenis</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($kriteria as $item)
                            <tr>
                                <td class="px-6 py-4 text-left whitespace-nowrap">{{ $item->nama_kriteria }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->bobot }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->jenis}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-7 flex justify-between">
                    <a href="{{ url('admin/bansos/')}}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                    <div class="flex space-x-3">
                        <a href="{{ url('admin/kriteria/update')}}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-yellow-400 hover:shadow-md hover:shadow-yellow-300 text-xs text-teal-700 hover:text-yellow-700 transition duration-300 ease-in-out rounded-lg">Ubah Kriteria</a>
                        {{-- <a href="{{ url('admin/kriteria/cek_rekomendasi')}}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Cek Rekomendasi</a> --}}
                    </div>
                </div>
                
            
            </div>

        </div>
    </div>

</div>

@include('layout.end')
<script>
    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('successMessage').style.display = 'none';
    });
</script>
