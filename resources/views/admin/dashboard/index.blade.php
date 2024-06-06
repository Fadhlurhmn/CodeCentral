@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <div class="text-lg">Ini adalah Halaman Dashboard (HIGH)</div>
        

    <div class="grid grid-cols-4 gap-6 xl:grid-cols-1">

    <!-- start dashboard -->
    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fas fa-users text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Total Kartu Keluarga</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>

    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fas fa-user text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Total Penduduk</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>

    <div class="report-card">
        <div class="card">
            <div class="card-body flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fa-solid fa-flag text-md mr-2"></i>
        
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Total RT</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    </div>

    <div class="container mx-auto mt-10">
        <table id="table_penduduk" class="table-auto w-full min-w-max cursor-default mx-auto border-collapse border border-gray-300">
          <thead class="bg-teal-400 px-10 text-center justify-between">
            <tr>
              <th class="border border-gray-300 px-4 py-2">No</th>
              <th class="border border-gray-300 px-4 py-2">NIK</th>
              <th class="border border-gray-300 px-4 py-2">Nama</th>
              <th class="border border-gray-300 px-4 py-2">Alamat Domisili</th>
              <th class="border border-gray-300 px-4 py-2">Rt</th>
              <th class="border border-gray-300 px-4 py-2">Status Data</th>
              <th class="border border-gray-300 px-4 py-2">Status Penduduk</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td class="border border-gray-300 px-4 py-2">1</td>
                <td class="border border-gray-300 px-4 py-2">123456789</td>
                <td class="border border-gray-300 px-4 py-2">Lina</td>
                <td class="border border-gray-300 px-4 py-2">Jl. Remujung 12</td>
                <td class="border border-gray-300 px-4 py-2">01</td>
                <td class="border border-gray-300 px-4 py-2">Aktif</td>
                <td class="border border-gray-300 px-4 py-2">Tetap</td>
            </tr>
              <tr>
                <td class="border border-gray-300 px-4 py-2">2</td>
                <td class="border border-gray-300 px-4 py-2">987654321</td>
                <td class="border border-gray-300 px-4 py-2">Amanda</td>
                <td class="border border-gray-300 px-4 py-2">Jl. Pisang Kipas</td>
                <td class="border border-gray-300 px-4 py-2">02</td>
                <td class="border border-gray-300 px-4 py-2">Tidak Aktif</td>
                <td class="border border-gray-300 px-4 py-2">Sementara</td>
              </tr>

              <tr>
                <td class="border border-gray-300 px-4 py-2">3</td>
                <td class="border border-gray-300 px-4 py-2">987654321</td>
                <td class="border border-gray-300 px-4 py-2">Amanda</td>
                <td class="border border-gray-300 px-4 py-2">Jl. Pisang Kipas</td>
                <td class="border border-gray-300 px-4 py-2">02</td>
                <td class="border border-gray-300 px-4 py-2">Tidak Aktif</td>
                <td class="border border-gray-300 px-4 py-2">Sementara</td>
              </tr>

              <tr>
                <td class="border border-gray-300 px-4 py-2">4</td>
                <td class="border border-gray-300 px-4 py-2">987654321</td>
                <td class="border border-gray-300 px-4 py-2">Amanda</td>
                <td class="border border-gray-300 px-4 py-2">Jl. Pisang Kipas</td>
                <td class="border border-gray-300 px-4 py-2">02</td>
                <td class="border border-gray-300 px-4 py-2">Tidak Aktif</td>
                <td class="border border-gray-300 px-4 py-2">Sementara</td>
              </tr>

              <tr>
                <td class="border border-gray-300 px-4 py-2">5</td>
                <td class="border border-gray-300 px-4 py-2">987654321</td>
                <td class="border border-gray-300 px-4 py-2">Amanda</td>
                <td class="border border-gray-300 px-4 py-2">Jl. Pisang Kipas</td>
                <td class="border border-gray-300 px-4 py-2">02</td>
                <td class="border border-gray-300 px-4 py-2">Tidak Aktif</td>
                <td class="border border-gray-300 px-4 py-2">Sementara</td>
              </tr>

            <!-- Table rows go here -->
          </tbody>
        </table>
    </div> 
  <!-- Charts -->
  <div class="row">
    <div class="mt-5">
    <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Penduduk Masuk dan Keluar</h5>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
<div>
    <div class="mt-5">
    <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg mb-2">Jenis Kelamin</h2>
                    <div class="chart-container pie-chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [
                    {
                        label: 'Penduduk Masuk',
                        data: [2, 0, 1, 26, 0, 0, 0, 28, 0, 30, 0, 0],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Penduduk Keluar',
                        data: [0, 1, 0, 15, 0, 0, 0, 0, 0, 10, 0, 0],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Perempuan', 'Laki-Laki'],
                datasets: [{
                    label: 'Jenis Kelamin',
                    data: [30, 15],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
    

  





</div>
</div>


<!-- end content -->

<!-- end wrapper -->

@include('layout.end')
