@include('layout.start')
@include('layout.rw_navbar')

<!-- start wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  @include('layout.rw_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 p-6 md:mt-16">

    <!-- Main Content Wrapper -->
    <div class="grid grid-cols-2 gap-4">
      <!-- Left Column -->
      <div>
        <!-- Filter for RT -->
        <div class="mb-4">
            <label for="rtFilter" class="block text-gray-700">Filter by RT:</label>
            <select id="rtFilter" class="form-select mt-1 block w-full">
                <option value="all">All RT</option>
                @for ($i = 1; $i <= 4; $i++)
                    <option value="{{ $i }}">RT {{ $i }}</option>
                @endfor
            </select>
        </div>

        <!-- Cards for jumlah warga, jumlah keluarga, and jumlah bansos acc -->
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="p-4 bg-blue-500 text-white rounded shadow">
                <h2 class="text-xl">Jumlah Warga</h2>
                <p class="text-2xl" id="jumlahWarga">{{ $data['jumlah_warga'] }}</p>
            </div>
            <div class="p-4 bg-green-500 text-white rounded shadow">
                <h2 class="text-xl">Jumlah Keluarga</h2>
                <p class="text-2xl" id="jumlahKeluarga">{{ $data['jumlah_keluarga'] }}</p>
            </div>
            <div class="p-4 bg-purple-500 text-white rounded shadow">
                <h2 class="text-xl">Jumlah Bansos Acc</h2>
                <p class="text-2xl" id="jumlahBansosAcc">{{ $data['bansos_acc'] }}</p>
            </div>
        </div>

        <!-- Additional Charts -->
        <div class="grid grid-cols-2 gap-20">
            <div>
                <h2>Statistik Golongan Darah Seluruh Warga</h2>
                <canvas id="golDarahChart"></canvas>
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

      <!-- Right Column -->
      <div>
        <!-- Filter for Kategori Bansos -->
        <div class="mb-4">
            <label for="kategoriBansosFilter" class="block text-gray-700">Filter by Kategori Bansos:</label>
            <select id="kategoriBansosFilter" class="form-select mt-1 block w-full">
                <option value="all">All Kategori Bansos</option>
                @foreach ($data['kategori_bansos'] as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                @endforeach
            </select>
        </div>

        <!-- Statistik Penerima Bansos -->
        <div>
            <h2>Statistik Penerima Bansos</h2>
            <canvas id="bansosChart" style="height: 290px;"></canvas>
        </div>
        
        <!-- Tabel Pengaduan -->
        <div class="mt-4">
            <h2>Daftar Pengaduan</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">Nama</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">Tanggal Pengaduan</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-600 font-bold uppercase text-sm text-left">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['pengaduan'] as $pengaduan)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $pengaduan->nama }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $pengaduan->tanggal_pengaduan }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $pengaduan->deskripsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    const allData = @json($data);
    const warga = allData.warga;
    const keluarga = allData.keluarga;
    const historiBansos = allData.histori_bansos;
    const statistikMenerimaBansos = allData.statistik_menerima_bansos;

    const rtFilter = document.getElementById('rtFilter');
    const kategoriBansosFilter = document.getElementById('kategoriBansosFilter');
    
    rtFilter.addEventListener('change', updateData);
    kategoriBansosFilter.addEventListener('change', updateData);

    function updateData() {
        const selectedRT = rtFilter.value;
        const selectedKategori = kategoriBansosFilter.value;
        
        const filteredWarga = selectedRT === 'all' ? warga : warga.filter(w => w.rt == selectedRT);
        const filteredKeluarga = selectedRT === 'all' ? keluarga : keluarga.filter(k => k.rt == selectedRT);
        const filteredBansos = selectedRT === 'all' ? historiBansos : historiBansos.filter(b => b.rt == selectedRT);

        document.getElementById('jumlahWarga').innerText = filteredWarga.length;
        document.getElementById('jumlahKeluarga').innerText = filteredKeluarga.length;
        document.getElementById('jumlahBansosAcc').innerText = filteredBansos.length;

        const wargaPerRT = {};
        const golDarah = {};
        const keluargaPerRT = {};
        const wargaTetapSementara = {};
        const wargaAktifNonAktif = {};
        const jenisKelamin = {};
        const bansosData = {};

        filteredWarga.forEach(w => {
            wargaPerRT[w.rt] = (wargaPerRT[w.rt] || 0) + 1;
            golDarah[w.gol_darah] = (golDarah[w.gol_darah] || 0) + 1;
            wargaTetapSementara[w.status_penduduk] = (wargaTetapSementara[w.status_penduduk] || 0) + 1;
            wargaAktifNonAktif[w.status_data] = (wargaAktifNonAktif[w.status_data] || 0) + 1;
            jenisKelamin[w.jenis_kelamin] = (jenisKelamin[w.jenis_kelamin] || 0) + 1;
        });

        filteredKeluarga.forEach(k => {
            keluargaPerRT[k.rt] = (keluargaPerRT[k.rt] || 0) + 1;
        });

        const filteredStatistikMenerimaBansos = selectedKategori === 'all' ? statistikMenerimaBansos : statistikMenerimaBansos.filter(b => b.nama_kategori == selectedKategori);
        filteredStatistikMenerimaBansos.forEach(b => {
            bansosData[b.nama] = (bansosData[b.nama] || 0) + b.jumlah_penerima;
        });

        updateChart(golDarahChart, Object.keys(golDarah), Object.values(golDarah));
        updateChart(wargaTetapSementaraChart, Object.keys(wargaTetapSementara), Object.values(wargaTetapSementara));
        updateChart(wargaAktifNonAktifChart, Object.keys(wargaAktifNonAktif), Object.values(wargaAktifNonAktif));
        updateChart(jenisKelaminChart, Object.keys(jenisKelamin), Object.values(jenisKelamin));
        updateLineChart(bansosChart, Object.keys(bansosData), Object.values(bansosData));
    }

    function updateChart(chart, labels, data) {
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update();
    }

    function updateLineChart(chart, labels, data) {
        chart.data.labels = labels;
        chart.data.datasets[0].data = data;
        chart.update();
    }

    const pieConfig = (labels, data) => ({
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
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
            responsive: false,
            maintainAspectRatio: false
        }
    });

    const lineConfig = (labels, data) => ({
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Penerima',
                data: data,
                borderColor: '#FF6384',
                backgroundColor: '#FF6384',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            responsive: false, // Disable responsiveness
            maintainAspectRatio: false,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Nama Bansos'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Penerima'
                    }
                }
            }
        }
    });

    const golDarahChart = new Chart(document.getElementById('golDarahChart').getContext('2d'), pieConfig([], []));
    const wargaTetapSementaraChart = new Chart(document.getElementById('wargaTetapSementaraChart').getContext('2d'), pieConfig([], []));
    const wargaAktifNonAktifChart = new Chart(document.getElementById('wargaAktifNonAktifChart').getContext('2d'), pieConfig([], []));
    const jenisKelaminChart = new Chart(document.getElementById('jenisKelaminChart').getContext('2d'), pieConfig([], []));
    const bansosChart = new Chart(document.getElementById('bansosChart').getContext('2d'), lineConfig([], []));

    updateData(); // Initial data load
</script>


