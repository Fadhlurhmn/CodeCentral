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

@include('layout.a_navbar')

<div class="h-screen w-full flex">
    @include('layout.a_sidebar')

    <!-- Start content -->
    <div class="flex flex-col flex-grow overflow-auto custom-scrollbar">
        <div class="container mx-auto p-6 bg-white custom-scrollbar">
            <div class="p-4 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white">
                <h1 class="pb-4 my-2 text-xl font-extrabold text-gray-800">Proses perhitungan</h1>
                <p class="pb-4 my-2 text-md text-gray-600">Proses Perhitungan Rekomendasi dengan Metode SMART.</p>
                
                <!-- Section for 'acc' and 'tolak' statuses -->
                <div class="mt-4">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-bold text-gray-700">Kriteria</h2>
                    </div>
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-2 py-2 rounded relative" role="alert">
                            <strong class="font-bold">Terjadi Kesalahan!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <table class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-500 text-white text-xs">
                            <tr>
                                <th class="p-2 font-medium tracking-normal">ID Kriteria</th>
                                <th class="p-2 font-medium tracking-normal">Nama Kriteria</th>
                                <th class="p-2 font-medium tracking-normal">Bobot</th>
                                <th class="p-2 font-medium tracking-normal">Jenis</th>
                                <th class="p-2 font-medium tracking-normal">Hasil Normalisasi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-xs">
                            @php
                                $totalBobotTenormalisasi = 0;
                            @endphp
                            @foreach ($normalisasi_bobot as $ban)
                                <tr class="border-b">
                                    <td class="p-2">C{{ $ban->id_kriteria }}</td>
                                    <td class="p-2">{{ $ban->nama_kriteria }}</td>
                                    <td class="p-2">{{ $ban->bobot }}</td>
                                    <td class="p-2">{{ $ban->jenis }}</td>
                                    <td class="p-2">{{ $ban->bobot_tenormalisasi }}</td>
                                </tr>
                                @php
                                    $totalBobotTenormalisasi += $ban->bobot_tenormalisasi;
                                @endphp
                            @endforeach
                            <tr class="font-bold text-gray-900">
                                <td class="p-2 text-right" colspan="4">Total Bobot Normalisasi:</td>
                                <td class="p-2">{{ $totalBobotTenormalisasi }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-bold text-gray-700">Nilai Parameter untuk tiap Kriteria</h2>
                    </div>
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-2 py-2 rounded relative" role="alert">
                            <strong class="font-bold">Terjadi Kesalahan!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <table class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-500 text-white text-xs">
                            <tr>
                                <th class="p-2 font-medium tracking-normal">Alternatif</th>
                                @for ($i = 1; $i <= 10; $i++)
                                    <th class="p-2 font-medium tracking-normal">C{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-xs">
                            @php
                                // Initialize a matrix to store nilai_kriteria for each keluarga and kriteria
                                $nilaiMatrix = [];
                                foreach ($detail_kriteria as $ban) {
                                    $nilaiMatrix[$ban->id_keluarga][$ban->id_kriteria] = $ban->nilai_kriteria;
                                }
                            @endphp
                            @foreach ($nilaiMatrix as $id_keluarga => $nilaiKriteria)
                                <tr class="border-b">
                                    <td class="p-2">A{{ $id_keluarga }}</td>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <td class="p-2">{{ $nilaiKriteria[$i] ?? 'N/A' }}</td>
                                    @endfor
                                </tr>
                            @endforeach
                            <tr class="font-bold text-gray-900">
                                <td class="p-2">CMAX</td>
                                @for ($i = 0; $i < 10; $i++)
                                    <td class="p-2">{{ $max_min_criteria[$i]->max_nilai ?? 'N/A' }}</td>
                                @endfor
                            </tr>
                            <tr class="font-bold text-gray-900">
                                <td class="p-2">CMIN</td>
                                @for ($i = 0; $i < 10; $i++)
                                    <td class="p-2">{{ $max_min_criteria[$i]->min_nilai ?? 'N/A' }}</td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <h2 class="mt-5 text-lg font-bold text-gray-700">Nilai Utility</h2>
                <div class="overflow-x-auto">
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-2 py-2 rounded relative" role="alert">
                            <strong class="font-bold">Terjadi Kesalahan!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <table class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-500 text-white text-xs">
                            <tr>
                                <th class="p-2 font-medium tracking-normal">Alternatif</th>
                                @for ($i = 1; $i <= 10; $i++)
                                    <th class="p-2 font-medium tracking-normal">C{{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-xs">
                            @php
                                // Initialize a matrix to store utility values for each keluarga and kriteria
                                $nilaiMatrix = [];
                                foreach ($nilai_utility as $utility) {
                                    $nilaiMatrix[$utility->id_keluarga][$utility->id_kriteria] = $utility->utility;
                                }
                            @endphp
                            @foreach ($nilaiMatrix as $id_keluarga => $utilities)
                                <tr class="border-b">
                                    <td class="p-2">A{{ $id_keluarga }}</td>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <td class="p-2">{{ $utilities[$i] ?? 'N/A' }}</td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    <div class="flex justify-between">
                        <h2 class="text-lg font-bold text-gray-700">Nilai Akhir dan Perangkingan</h2>
                    </div>
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-2 py-2 rounded relative" role="alert">
                            <strong class="font-bold">Terjadi Kesalahan!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <table class="table-auto w-full min-w-max text-center cursor-default">
                        <thead class="bg-teal-500 text-white text-xs">
                            <tr>
                                <th class="p-2 font-medium tracking-normal">Alternatif</th>
                                <th class="p-2 font-medium tracking-normal">Nama Kepala Keluarga</th>
                                <th class="p-2 font-medium tracking-normal">Nilai Akhir</th>
                                <th class="p-2 font-medium tracking-normal">Rank</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-xs">
                            @foreach ($ranking_keluarga as $ranking)
                                @php
                                    // Mencari nama kepala keluarga yang sesuai dengan ID keluarga dari peringkat
                                    $rekomendasiKeluarga = collect($rekomendasi)->firstWhere('id_keluarga', $ranking->id_keluarga);
                                @endphp
                                <tr class="border-b">
                                    <td class="p-2">A{{ $ranking->id_keluarga }}</td>
                                    <td class="p-2">{{ $rekomendasiKeluarga->nama_kepala_keluarga ?? 'N/A' }}</td>
                                    <td class="p-2">{{ $ranking->nilai_akhir }}</td>
                                    <td class="p-2">{{ $ranking->rank }}</td>
                                </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ url('admin/bansos/'.$detail_kriteria[0]->id_bansos.'/daftar') }}" class="p-2 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-400 hover:shadow-md hover:shadow-teal-300 text-xs text-teal-700 hover:text-teal-700 transition duration-300 ease-in-out rounded-lg">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
</div>

@include('layout.end')
