@include('layout.start')

@include('layout.a_navbar')

<div class="min-h-screen flex flex-row bg-gray-100">
    @include('layout.a_sidebar')

    <div class="flex flex-col flex-grow p-6">
        <div class="container bg-white shadow-lg rounded-lg p-6">
            
            <h1 class="text-2xl font-extrabold text-gray-700">{{$page->title}}</h1>

            <div class="p-5 text-sm font-normal text-gray-800">
                <div class="flex flex-row mb-4">
                    <div class="mr-8">
                        <h2 class="font-semibold text-lg">Nomor Keluarga:</h2>
                        <p class="text-base">{{$detail[0]->nomor_keluarga}}</p>
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Nama Kepala Keluarga:</h2>
                        <p class="text-base">{{$detail[0]->nama_kepala_keluarga}}</p>
                    </div>
                </div>
                
                <table class="w-full bg-white border border-gray-200 rounded-lg shadow-md mt-6">
                    <thead class="bg-teal-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold uppercase">Nama Kriteria</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase">Nilai Kriteria</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($detail as $data)
                        <tr>
                            <td class="px-6 py-4">{{$data->nama_kriteria}}</td>
                            <td class="px-6 py-4 text-center">{{$data->nilai_kriteria}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <a href="{{ url('admin/bansos/') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
            </div>
        </div>
    </div>
</div>

@include('layout.end')
