@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <h1 class="pb-5 my-2 text-2xl font-extrabold text-black-600">Dashboard RT</h1>
        

    <div class="grid grid-cols-3 gap-6 xl:grid-cols-1">

    <!-- start dashboard -->
    <div class="report-card">
        <div class="card">
            <div class="card-body card border border-teal-500  flex flex-col">
                
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
            <div class="card-body card border border-teal-500 flex flex-col">
                
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
            <div class="card-body card border border-teal-500  flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fas fa-flag text-md mr-2"></i>
        
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


  <!-- Charts -->
  <div class="grid grid-cols-2 gap-6 xl:grid-cols-1">
  <div class="row">
    <div class="mt-5">
    <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg mb-2">Statistik Warga Tiap RT</h2>
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

        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['RT 1', 'RT 2', 'RT 3', 'RT 4'],
                datasets: [{
                    label: 'Jumlah Warga',
                    data: [17, 16,16,18,16],
                    backgroundColor: [
                        'rgba(46, 139, 87)',
                        'rgba(27, 128, 1)',
                        'rgba(107, 142, 35)',
                        'rgba(60, 179, 113)',
                        'rgba(144, 238, 144)'
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
