@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <h1 class="pb-5 my-2 text-2xl font-extrabold text-black-600">Dashboard RW</h1>
        

    <div class="grid grid-cols-3 gap-6 xl:grid-cols-1">

    <!-- start dashboard -->
    <div class="report-card">
        <div class="card">
            <div class="card-body card border border-teal-500  flex flex-col">
                
                <!-- top -->
                <div class="flex flex-row justify-between items-center">
                    <i class="fas fa-people-carry text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Jumlah Bansos</p>
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
                    <i class="fas fa-house text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Jumlah Pengajuan Bansos</p>
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
                    <i class="fas fa-hand-holding-heart text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Jumlah Penerima Bansos yang Disetujui</p>
                </div>                
                <!-- end bottom -->
    
            </div>
        </div>
        <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>

    <!-- Filter -->
    <div class="container mt-5 ml-5">
        <div class="row">
            <div class="col-md-3">
                <div class="">
                    <p class="py-1 mr-2">Filter Bansos: </p>
                    <select name="nama" id="nama" class="pl-2 py-1 font-normal block appearance-none w-52 bg-gray-100 border-b-2 border-teal-400 text-gray-900 focus:outline-none focus:border-teal-600 rounded-lg cursor-pointer">
                        <option value="all" selected>Semua RT</option>
                        <option value="1">Rt. 1</option>
                        <option value="2">Rt. 2</option>
                        <option value="3">Rt. 3</option>
                        <option value="4">Rt. 4</option>
                    </select>
                </div>
            </div>
    <!-- Filter -->

    <!-- Charts Bansos Start -->
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
            <h3>Statistik Pengajuan Tiap RT</h3>
            <canvas id="chart1"></canvas>
        </div>
        <div class="grid-item">
            <h3>Statistik Pengajuan Penerima Bansos Tiap RT</h3>
            <canvas id="chart2"></canvas>
        </div>
        <div class="grid-item">
            <h3>Statistik Jenis Bansos</h3>
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
               data: [1.960, 6.300, 8.550, 3.940],
               backgroundColor: ['#B5C18E', '#7ABA78', '#BACD92', '#ACE1AF'],
               hoverOffset: 4
           }]
        };

        const data2 = {
            labels: ['Acc', 'Ditolak'],
            datasets: [{
                data: [1.170, 1.170],
                backgroundColor: ['#81A263', '#365E32'],
                hoverOffset: 4
            }]
        };

        const data3 = {
            labels: ['Sembako', 'Uang Tunai'],
            datasets: [{
                data: [46, 54],
                backgroundColor: ['#40A578', '#ACE1AF'],
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
   <!-- Charts Penduduk End -->

</div>
</div>


<!-- end content -->

<!-- end wrapper -->

@include('layout.end')
