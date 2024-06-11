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

<!-- strat wrapper -->
<div class="h-screen w-full flex">
  
  @include('layout.rt_sidebar')

  <!-- strat content -->
  <div class="bg-white flex flex-col flex-grow overflow-auto cursor-default"> 
    <div class="container mx-auto p-6 bg-white border-t-2 border-teal-500 custom-scrollbar">
        @include('layout.breadcrumb2')
        <!-- Main Content Wrapper -->
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-1 space-y-3">
                <h1 class="font-semibold text-xl mb-3">Data Warga</h1>
                <!-- Cards for jumlah warga and jumlah keluarga -->
                <div class="p-3 py-2 bg-gray-200/40 border border-gray-300 text-teal-700 rounded shadow-md flex items-center space-x-2">
                    <i class="fas fa-users text-3xl mr-2"></i>
                    <div>
                        <h2 class="text-md">Jumlah Warga</h2>
                        <p class="text-lg" id="jumlahWarga">{{ $jumlah_warga }}</p>
                    </div>
                </div>
                <div class="p-3 py-2 bg-gray-200/40 border border-gray-300 text-teal-700 rounded shadow-md flex items-center space-x-2">
                    <i class="fas fa-home text-3xl mr-2"></i>
                    <div>
                        <h2 class="text-md">Jumlah Keluarga</h2>
                        <p class="text-lg" id="jumlahKeluarga">{{ $jumlah_keluarga }}</p>
                    </div>
                </div>
            </div>
            

            <!-- Tabel Pengaduan -->
            <div class="col-span-2">
                <h1 class="font-semibold text-xl mb-3">Daftar Pengaduan</h1>
                <div class="border rounded h-40 overflow-y-auto">
                        <table class="min-w-full bg-white">
                            <thead class="sticky top-0 bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 text-gray-600 font-bold uppercase text-sm text-left">Nama</th>
                                    <th class="py-2 px-4 text-gray-600 font-bold uppercase text-sm text-left">Tanggal Pengaduan</th>
                                    <th class="py-2 px-4 text-gray-600 font-bold uppercase text-sm text-left">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @if ($pengaduan->isEmpty())
                                    <div class="p-4 mb-5 border-2 border-gray-400 bg-neutral-50 flex justify-center shadow-md rounded-md" id="noResults">
                                        <div class="flex-col text-center">
                                            <h1 class="text-xl font-bold text-gray-600">Daftar Kosong</h1>
                                            <p class="text-xs text-gray-500">Belum Ada Yang Membuat Pengaduan</p>
                                        </div>
                                    </div>
                                @else --}}
                                @foreach ($pengaduan as $data)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $data->nama }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $data->tanggal_pengaduan }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $data->deskripsi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{-- @endif --}}
                </div>
            </div>
            

            <div class="col-span-full">
                <hr>
                <h1 class="font-semibold text-xl mt-5">Statistik Data Warga</h1>
                <div class="grid grid-cols-4 gap-5 mt-5">
                    <div class="col-span-1 p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Golongan Darah Seluruh Warga</h1>
                        <canvas class="w-40 mx-auto" id="golDarahChart"></canvas>
                    </div>
                    <div class="col-span-1 p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Warga Tetap dan Sementara</h1>
                        <canvas class="w-40 mx-auto" id="wargaTetapSementaraChart"></canvas>
                    </div>
                    <div class="col-span-1 p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Jenis Kelamin Seluruh Warga</h1>
                        <canvas class="w-40 mx-auto" id="jenisKelaminChart"></canvas>
                    </div>
                    <div class="col-span-1 p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Warga Aktif dan Non-Aktif</h1>
                        <canvas class="w-40 mx-auto" id="wargaAktifNonAktifChart"></canvas>
                    </div>
                    
                </div>
    
            </div>


        </div>

    </div>

  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for the charts
    const golDarah = @json(array_values($statistik_gol_darah_seluruh_warga));
    const wargaTetapSementara = @json(array_values($statistik_warga_tetap_dan_sementara));
    const wargaAktifNonAktif = @json(array_values($statistik_warga_aktif_dan_tidak_aktif));
    const jenisKelamin = @json(array_values($statistik_jenis_kelamin));

    const golDarahLabels = @json(array_keys($statistik_gol_darah_seluruh_warga));
    const wargaTetapSementaraLabels = @json(array_keys($statistik_warga_tetap_dan_sementara));
    const wargaAktifNonAktifLabels = @json(array_keys($statistik_warga_aktif_dan_tidak_aktif));
    const jenisKelaminLabels = @json(array_keys($statistik_jenis_kelamin));

    const config = (labels, data, label) => ({
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            let value = tooltipItem.raw;
                            let total = data.reduce((acc, item) => acc + item, 0);
                            let percentage = ((value / total) * 100).toFixed(2);
                            return `${value} (${percentage}%)`;
                        }
                    }
                },
                datalabels: {
                    formatter: (value, context) => {
                        let total = context.chart.data.datasets[0].data.reduce((acc, item) => acc + item, 0);
                        let percentage = ((value / total) * 100).toFixed(2);
                        return `${value} (${percentage}%)`;
                    },
                    color: '#fff',
                    font: {
                        weight: 'bold'
                    }
                }
            },
            // Set canvas width and height
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            responsive: false, // Disable responsiveness
            maintainAspectRatio: false // Disable aspect ratio
        }
    });

    // Render charts
    new Chart(document.getElementById('golDarahChart').getContext('2d'), config(golDarahLabels, golDarah, 'Golongan Darah'));
    new Chart(document.getElementById('wargaTetapSementaraChart').getContext('2d'), config(wargaTetapSementaraLabels, wargaTetapSementara, 'Warga Tetap dan Sementara'));
    new Chart(document.getElementById('wargaAktifNonAktifChart').getContext('2d'), config(wargaAktifNonAktifLabels, wargaAktifNonAktif, 'Warga Aktif dan Non-Aktif'));
    new Chart(document.getElementById('jenisKelaminChart').getContext('2d'), config(jenisKelaminLabels, jenisKelamin, 'Jenis Kelamin'));
</script>

{{-- Count Up --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to animate numbers
        function animateValue(id, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                document.getElementById(id).innerText = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Data
        const data = {
            jumlahWarga: {{ $jumlah_warga }},
            jumlahKeluarga: {{ $jumlah_keluarga }}
        };

        // Apply animation to each element
        animateValue("jumlahWarga", 0, data.jumlahWarga, 1300);
        animateValue("jumlahKeluarga", 0, data.jumlahKeluarga, 1300);
    });
</script>

