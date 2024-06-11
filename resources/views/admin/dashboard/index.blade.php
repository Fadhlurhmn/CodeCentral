@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <h1 class="pb-5 my-2 text-2xl font-extrabold text-black-600">Dashboard Admin</h1>
        

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
                    <p>Jumlah Kartu Keluarga</p>
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
                    <i class="fas fa-flag text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Jumlah RT</p>
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
                    <i class="fas fa-store text-md mr-2"></i>
        
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Jumlah UMKM</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    </div>

    <!-- Charts Admin Start -->
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 20px;

        }
        .grid-item {
            background-color: white;
            text-align: center;
            padding: 25px;


        }
    </style>
    <div class="grid-container">
        <div class="grid-item ">
            <h3>Statistik Warga Tiap RT</h3>
            <canvas id="chart1"></canvas>
        </div>
        <div class="grid-item">
            <h3>Statistik Keluarga Tiap RT</h3>
            <canvas id="chart2"></canvas>
        </div>
        <div class="grid-item">
            <h3>Statistik UMKM</h3>
            <canvas id="chart3"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
     // Register the plugin
        Chart.register(ChartDataLabels);
        const data1 = {
            labels: ['1', '2', '3', '4'],
            datasets: [{
               data: [17, 16, 16, 18],
               backgroundColor: ['#B5C18E', '#7ABA78', '#BACD92', '#ACE1AF'],
               hoverOffset: 4
           }]
        };

        const data2 = {
            labels: ['1', '2', '3', '4'],
            datasets: [{
                data: [160, 150, 150, 170],
                backgroundColor: ['#81A263', '#365E32', '#A8CD9F', '#40A578'],
                hoverOffset: 4
            }]
        };

        const data3 = {
            labels: ['Tolak', 'Pending', 'Acc'],
            datasets: [{
                data: [5, 54, 60],
                backgroundColor: ['#40A578', '#ACE1AF', '#7ABA78'],
                hoverOffset: 4
            }]
        };

        const config1 = {
           type: 'pie',
           data: data1,
           options: {
               plugins: {
                   datalabels: {
                       formatter: (value) => {
                           return value;
                       },
                       color: '#fff',
                       font: {
                           weight: 'bold'
                       }
                   }
               }
           }
       };
       const config2 = {
           type: 'pie',
           data: data2,
           options: {
               plugins: {
                   datalabels: {
                       formatter: (value) => {
                           return value;
                       },
                       color: '#fff',
                       font: {
                           weight: 'bold'
                       }
                   }
               }
           }
       };
       const config3 = {
           type: 'pie',
           data: data3,
           options: {
               plugins: {
                   datalabels: {
                       formatter: (value) => {
                           return value;
                       },
                       color: '#fff',
                       font: {
                           weight: 'bold'
                       }
                   }
               }
           }
       };

        var chart1 = new Chart(
            document.getElementById('chart1'),
            config1
        );

        var chart2 = new Chart(
            document.getElementById('chart2'),
            config2
        );

        var chart3 = new Chart(
            document.getElementById('chart3'),
            config3
        );
    </script>
   <!-- Charts Admin End -->

   



    
    

  





</div>
</div>


<!-- end content -->

<!-- end wrapper -->

@include('layout.end')
