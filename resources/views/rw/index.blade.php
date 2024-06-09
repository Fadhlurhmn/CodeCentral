@include('layout.start')

@include('layout.rw_navbar')

<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.rw_sidebar')

  <!-- strat content -->
  <div class="bg-white flex-1 p-6 md:mt-16"> 

    <!-- Cards for jumlah warga and jumlah keluarga -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="p-4 bg-blue-500 text-white rounded shadow">
            <h2 class="text-xl">Jumlah Warga</h2>
            <p class="text-2xl">{{ $jumlah_warga }}</p>
        </div>
        <div class="p-4 bg-green-500 text-white rounded shadow">
            <h2 class="text-xl">Jumlah Keluarga</h2>
            <p class="text-2xl">{{ $jumlah_keluarga }}</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-20">
        <div>
            <h2>Statistik Warga Per RT</h2>
            <canvas id="wargaPerRTChart"></canvas>
        </div>
        <div>
            <h2>Statistik Golongan Darah Seluruh Warga</h2>
            <canvas id="golDarahChart"></canvas>
        </div>
        <div>
            <h2>Statistik Keluarga Per RT</h2>
            <canvas id="keluargaPerRTChart"></canvas>
        </div>
        <div>
            <h2>Statistik Warga Tetap dan Sementara</h2>
            <canvas id="wargaTetapSementaraChart"></canvas>
        </div>
        <div>
            <h2>Statistik Warga Aktif dan Non-Aktif</h2>
            <canvas id="wargaAktifNonAktifChart"></canvas>
        </div>
        <div>
            <h2>Statistik Jenis Kelamin Seluruh Warga</h2>
            <canvas id="jenisKelaminChart"></canvas>
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
    const wargaPerRT = @json(array_values($statistik_warga_per_rt));
    const golDarah = @json(array_values($statistik_gol_darah_seluruh_warga));
    const keluargaPerRT = @json(array_values($statistik_keluarga_per_rt));
    const wargaTetapSementara = @json(array_values($statistik_warga_tetap_dan_sementara));
    const wargaAktifNonAktif = @json(array_values($statistik_warga_aktif_dan_tidak_aktif));
    const jenisKelamin = @json(array_values($statistik_jenis_kelamin));

    const wargaPerRTLabels = @json(array_keys($statistik_warga_per_rt));
    const golDarahLabels = @json(array_keys($statistik_gol_darah_seluruh_warga));
    const keluargaPerRTLabels = @json(array_keys($statistik_keluarga_per_rt));
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
    new Chart(document.getElementById('wargaPerRTChart').getContext('2d'), config(wargaPerRTLabels, wargaPerRT, 'Warga Per RT'));
    new Chart(document.getElementById('golDarahChart').getContext('2d'), config(golDarahLabels, golDarah, 'Golongan Darah'));
    new Chart(document.getElementById('keluargaPerRTChart').getContext('2d'), config(keluargaPerRTLabels, keluargaPerRT, 'Keluarga Per RT'));
    new Chart(document.getElementById('wargaTetapSementaraChart').getContext('2d'), config(wargaTetapSementaraLabels, wargaTetapSementara, 'Warga Tetap dan Sementara'));
    new Chart(document.getElementById('wargaAktifNonAktifChart').getContext('2d'), config(wargaAktifNonAktifLabels, wargaAktifNonAktif, 'Warga Aktif dan Non-Aktif'));
    new Chart(document.getElementById('jenisKelaminChart').getContext('2d'), config(jenisKelaminLabels, jenisKelamin, 'Jenis Kelamin'));
</script>
