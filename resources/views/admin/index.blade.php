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

<!-- start wrapper -->
<div class="h-screen w-full flex">
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="flex flex-col flex-grow overflow-auto cursor-default">
    <div class="container mx-auto p-6 bg-white border-t-2 border-teal-500 custom-scrollbar">
        @include('layout.breadcrumb2')
        <!-- Main Content Wrapper -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Left Column -->
            <div class="col-span-full mt-4">
                <div class="grid grid-cols-5 gap-4 mb-4">
                    <div class="p-3 bg-gray-200/40 border border-gray-300 text-teal-700 rounded shadow-md flex items-center space-x-2">
                        <i class="fas fa-user-alt text-3xl"></i>
                        <div>
                            <h2 class="text-sm">Jumlah Akun Aktif</h2>
                            <p class="text-md" id="jumlahAkunAktif">{{ $data['jumlah_akun_aktif'] }}</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-200/40 border border-gray-300 text-teal-700 rounded shadow-md flex items-center space-x-2">
                        <i class="fas fa-user-alt-slash text-3xl"></i>
                        <div>
                            <h2 class="text-sm">Jumlah Akun Nonaktif</h2>
                            <p class="text-md" id="jumlahAkunNonAktif">{{ $data['jumlah_akun_tidak_aktif'] }}</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-200/40 border border-gray-300 text-teal-700 rounded shadow-md flex items-center space-x-2">
                        <i class="fas fa-file-upload text-3xl"></i>
                        <div>
                            <h2 class="text-sm">Pengumuman Terpublikasi</h2>
                            <p class="text-md" id="pengumumanTerpublikasi">{{ $data['jumlah_pengumuman_publikasi'] }}</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-200/40 border border-gray-300 text-teal-700 rounded shadow-md flex items-center space-x-2">
                        <i class="fas fa-file-signature text-3xl"></i>
                        <div>
                            <h2 class="text-sm">Pengumuman Draf</h2>
                            <p class="text-md" id="pengumumanDraf">{{ $data['jumlah_pengumuman_draf'] }}</p>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-200/40 border border-gray-300 text-teal-700 rounded shadow-md flex items-center space-x-2">
                        <i class="fas fa-file-alt text-3xl"></i>
                        <div>
                            <h2 class="text-sm">Jumlah Surat</h2>
                            <p class="text-md" id="jumlahSurat">{{ $data['jumlah_surat'] }}</p>
                        </div>
                    </div>
                </div>

            <hr>
            </div>

            <div class="col-span-full">
                <h1 class="font-semibold text-2xl mb-3">Data Warga</h1>
                <!-- Cards for jumlah warga, jumlah keluarga, and jumlah bansos acc -->
                <div class="grid grid-cols-4 gap-5 ">
                    <!-- Filter for RT -->
                        <div class="bg-gray-50 border p-3 rounded shadow-md">
                            <label for="rtFilter" class="block text-sm font-bold">Filter RT :</label>
                            <i class="fad fa-filter"></i>
                            <select id="rtFilter" class="bg-gray-50 p-2 pl-0 text-sm cursor-pointer">
                                <option value="all">Semua RT</option>
                                @for ($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}">RT {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    <div class="p-3 bg-gradient-to-tl from-teal-600 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow-md">
                        <h2 class="text-sm">Jumlah Warga</h2>
                        <p class="text-md" id="jumlahWarga">{{ $data['jumlah_warga'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-tl from-teal-700 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow-md">
                        <h2 class="text-sm">Jumlah Keluarga</h2>
                        <p class="text-md" id="jumlahKeluarga">{{ $data['jumlah_keluarga'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-tl from-teal-700 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow-md">
                        <h2 class="text-sm">Jumlah Penerima Bantuan Sosial</h2>
                        <p class="text-md" id="jumlahBansosAcc">{{ $data['bansos_acc'] }}</p>
                    </div>
                    {{-- <div class="p-3 bg-gradient-to-tl from-teal-700 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow-md">
                        <h2 class="text-sm">Jumlah Akun Aktif</h2>
                        <p class="text-md" id="jumlahAkunAktif">{{ $data['jumlah_akun_aktif'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-tl from-teal-700 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow-md">
                        <h2 class="text-sm">Jumlah Akun Nonaktif</h2>
                        <p class="text-md" id="jumlahAkunNonAktif">{{ $data['jumlah_akun_tidak_aktif'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-tl from-teal-700 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow">
                        <h2 class="text-sm">Pengumuman Terpublikasi</h2>
                        <p class="text-md" id="pengumumanTerpublikasi">{{ $data['jumlah_pengumuman_publikasi'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-tl from-teal-700 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow">
                        <h2 class="text-sm">Pengumuman Draf</h2>
                        <p class="text-md" id="pengumumanDraf">{{ $data['jumlah_pengumuman_draf'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-tl from-teal-700 from-10% via-teal-500 to-teal-400 border border-teal-600 text-white rounded shadow">
                        <h2 class="text-sm">Jumlah Surat</h2>
                        <p class="text-md" id="jumlahSurat">{{ $data['jumlah_surat'] }}</p>
                    </div> --}}
                </div>
            </div>

            <div class="col-span-full">
                <!-- Additional Charts -->
                <div class="grid grid-cols-4 gap-5 mb-4">
                    <div class="p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Golongan Darah Seluruh Warga</h1>
                        <canvas class="w-40 mx-auto" id="golDarahChart"></canvas>
                    </div>
                    <div class="p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Warga Tetap dan Sementara</h1>
                        <canvas class="w-40 mx-auto" id="wargaTetapSementaraChart"></canvas>
                    </div>
                    <div class="p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Warga Aktif dan Non-Aktif</h1>
                        <canvas class="w-40 mx-auto" id="wargaAktifNonAktifChart"></canvas>
                    </div>
                    <div class="p-2 bg-gray-50/60 border rounded-xl shadow-lg">
                        <h1 class="mb-2 text-sm text-center">Statistik Jenis Kelamin Seluruh Warga</h1>
                        <canvas class="w-40 mx-auto" id="jenisKelaminChart"></canvas>
                    </div>
                </div>
                <hr>
            </div>


            <!-- Bansos & Pengajuan Promosi -->
            <div class="col-span-full">
                <div class="grid grid-cols-2 gap-5">
                    <div class="col-span-1 flex flex-col justify-between">
                        <h1 class="text-2xl font-bold mb-3">Bantuan Sosial</h1>
                        <!-- Filter for Kategori Bansos -->
                        <div class="mb-4 bg-gray-50/50 border w-72 p-3 rounded-lg shadow-md">
                            <label for="kategoriBansosFilter" class="block text-sm font-bold">Filter Kategori Bantuan Sosial:</label>
                            <i class="fad fa-filter"></i>
                            <select id="kategoriBansosFilter" class="text-sm p-2 cursor-pointer">
                                <option value="all">Semua Kategori</option>
                                @foreach ($data['kategori_bansos'] as $kategori)
                                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Statistik Penerima Bansos -->
                        <div class="p-2 bg-gray-50/50 border rounded-xl shadow-md flex-grow">
                            <h2 class="text-center">Statistik Penerima Bansos</h2>
                            <canvas id="bansosChart" class="w-full"></canvas>
                        </div>
                    </div>

                    <div class="col-span-1 flex flex-col justify-between">
                        <h1 class="text-2xl font-bold mb-3">Pengajuan Promosi Usaha</h1>
                        <!-- Filter for Status Pengajuan -->
                        <div class="mb-4 bg-gray-50/50 border w-72 p-3 rounded-lg shadow-md">
                            <label for="statusPengajuanFilter" class="block text-sm font-bold">Filter by Status Pengajuan:</label>
                            <i class="fad fa-filter"></i>
                            <select id="statusPengajuanFilter" class="text-sm p-2 cursor-pointer">
                                <option value="all">Semua Status</option>
                                <option value="Terima">Terima</option>
                                {{-- <option value="Tolak">Tolak</option> --}}
                                <option value="Menunggu">Menunggu</option>
                            </select>
                        </div>

                        <!-- Statistik Pengajuan Promosi -->
                        <div class="p-2 bg-gray-50/50 border rounded-xl shadow-md flex-grow flex items-center justify-center">
                            <div class="w-full">
                                <h2 class="text-center">Statistik Pengajuan Promosi</h2>
                                <canvas id="pengajuanPromosiChart" class="mx-auto"></canvas>
                            </div>
                        </div>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.7/countUp.min.js"></script> --}}

<script>
    const allData = @json($data);
    const warga = allData.warga;
    const keluarga = allData.keluarga;
    const historiBansos = allData.histori_bansos;
    const statistikMenerimaBansos = allData.statistik_menerima_bansos;
    const pengajuanPromosi = allData.pengajuan_promosi;

    const rtFilter = document.getElementById('rtFilter');
    const kategoriBansosFilter = document.getElementById('kategoriBansosFilter');
    const statusPengajuanFilter = document.getElementById('statusPengajuanFilter');

    rtFilter.addEventListener('change', updateData);
    kategoriBansosFilter.addEventListener('change', updateData);
    statusPengajuanFilter.addEventListener('change', updateData);

    function updateData() {
    const selectedRT = rtFilter.value;
    const selectedKategori = kategoriBansosFilter.value;
    const selectedStatus = statusPengajuanFilter.value;

    const filteredWarga = selectedRT === 'all' ? warga : warga.filter(w => w.rt == selectedRT);
    const filteredKeluarga = selectedRT === 'all' ? keluarga : keluarga.filter(k => k.rt == selectedRT);
    const filteredBansos = selectedRT === 'all' ? historiBansos : historiBansos.filter(b => b.rt == selectedRT);

    document.getElementById('jumlahWarga').innerText = filteredWarga.length;
    document.getElementById('jumlahKeluarga').innerText = filteredKeluarga.length;
    document.getElementById('jumlahBansosAcc').innerText = filteredBansos.length;

    const golDarah = {};
    const wargaTetapSementara = {};
    const wargaAktifNonAktif = {};
    const jenisKelamin = {};
    const bansosData = {};

    filteredWarga.forEach(w => {
        golDarah[w.gol_darah] = (golDarah[w.gol_darah] || 0) + 1;
        wargaTetapSementara[w.status_penduduk] = (wargaTetapSementara[w.status_penduduk] || 0) + 1;
        wargaAktifNonAktif[w.status_data] = (wargaAktifNonAktif[w.status_data] || 0) + 1;
        jenisKelamin[w.jenis_kelamin] = (jenisKelamin[w.jenis_kelamin] || 0) + 1;
    });

    const filteredStatistikMenerimaBansos = selectedKategori === 'all' ? statistikMenerimaBansos : statistikMenerimaBansos.filter(b => b.nama_kategori == selectedKategori);
    filteredStatistikMenerimaBansos.forEach(b => {
        bansosData[b.nama] = (bansosData[b.nama] || 0) + b.jumlah_penerima;
    });

    const filteredPengajuanPromosi = selectedStatus === 'all' ? pengajuanPromosi : pengajuanPromosi.filter(p => p.status_pengajuan == selectedStatus);
    const kategoriPromosi = {};

    filteredPengajuanPromosi.forEach(p => {
        kategoriPromosi[p.kategori] = (kategoriPromosi[p.kategori] || 0) + 1;
    });

    // Check for undefined categories and set to 'Lainnya' if any exist
    if (kategoriPromosi['Lainnya'] === undefined) {
        kategoriPromosi['Lainnya'] = 0;
    }

    updateChart(golDarahChart, Object.keys(golDarah), Object.values(golDarah));
    updateChart(wargaTetapSementaraChart, Object.keys(wargaTetapSementara), Object.values(wargaTetapSementara));
    updateChart(wargaAktifNonAktifChart, Object.keys(wargaAktifNonAktif), Object.values(wargaAktifNonAktif));
    updateChart(jenisKelaminChart, Object.keys(jenisKelamin), Object.values(jenisKelamin));
    updateLineChart(bansosChart, Object.keys(bansosData), Object.values(bansosData));
    updateChart(pengajuanPromosiChart, Object.keys(kategoriPromosi), Object.values(kategoriPromosi));
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
                backgroundColor: [
                '#36A2EB', // Blue
                '#FF6384', // Pink
                '#FFCE56', // Yellow
                '#4BC0C0', // Teal
                '#9966FF', // Purple
                '#FF9F40', // Orange
                '#49A9A2', // Darker Teal
                '#3AAFB9', // Light Blue-Teal
                '#34D1BF', // Bright Teal
                '#2E8B7E'  // Deep Sea Green
                ],
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
                borderColor: '#0C329E',
                backgroundColor: '#0C329E',
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
    const pengajuanPromosiChart = new Chart(document.getElementById('pengajuanPromosiChart').getContext('2d'), pieConfig([], []));

    updateData(); // Initial data load
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
            jumlahAkunAktif: {{ $data['jumlah_akun_aktif'] }},
            jumlahAkunNonAktif: {{ $data['jumlah_akun_tidak_aktif'] }},
            pengumumanTerpublikasi: {{ $data['jumlah_pengumuman_publikasi'] }},
            pengumumanDraf: {{ $data['jumlah_pengumuman_draf'] }},
            jumlahSurat: {{ $data['jumlah_surat'] }},
            jumlahWarga: {{ $data['jumlah_warga'] }},
            jumlahKeluarga: {{ $data['jumlah_keluarga'] }},
            jumlahBansosAcc: {{ $data['bansos_acc'] }},
        };

        // Apply animation to each element
        animateValue("jumlahAkunAktif", 0, data.jumlahAkunAktif, 1500);
        animateValue("jumlahAkunNonAktif", 0, data.jumlahAkunNonAktif, 1500);
        animateValue("pengumumanTerpublikasi", 0, data.pengumumanTerpublikasi, 1500);
        animateValue("pengumumanDraf", 0, data.pengumumanDraf, 1500);
        animateValue("jumlahSurat", 0, data.jumlahSurat, 1500);
        animateValue("jumlahWarga", 0, data.jumlahWarga, 2000);
        animateValue("jumlahKeluarga", 0, data.jumlahKeluarga, 2000);
        animateValue("jumlahBansosAcc", 0, data.jumlahBansosAcc, 1500);
    });
</script>

