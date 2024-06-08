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
                    <i class="fas fa-users text-md mr-2"></i>
                </div>
                <!-- end top -->

                <!-- bottom -->
                <div class="mt-8">
                    <h1 class="h5 num-4"></h1>
                    <p>Jumlah Warga</p>
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

    <!-- Charts Penduduk Start -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style>
       .chart-container {
           display: grid;
           grid-template-columns: repeat(3, 1fr);
           gap: 20px;
           margin-top: 100px;
           justify-content: center;
       }
       .chart-box {
           padding: 25px;
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           border-radius: 10px;
           background-color: #fff;
           text-align: center;

       }
   </style>

   <!-- Filtering -->
   <div class="filter-form mb-6">
       <form action="" method="POST" class="flex space-x-4">
           @csrf
           <div class="flex flex-col">
               <label for="filterField" class="mb-2 text-gray-700">Field</label>
               <select name="filterField" id="filterField" class="form-select-lg mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                   <option value="warga">Warga Tiap RT</option>
                   <option value="blood_type">Golongan Darah Seluruh Warga</option>
                   <option value="kartu_keluarga">Keluarga Tiap RT</option>
                   <option value="status_penduduk">Status Penduduk</option>
                   <option value="status_akun">Status Akun Warga</option>
                   <option value="gender">Jenis Kelamin Warga</option>
               </select>
           </div>
           <div class="flex flex-col">
               <label for="filterCondition" class="mb-2 text-gray-700">Condition</label>
               <select name="filterCondition" id="filterCondition" class="form-select mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                   <option value="=">Sama dengan</option>
                   <option value="!=">Tidak sama dengan</option>
                   <option value=">">Lebih besar dari</option>
                   <option value="<">Kurang dari</option>
               </select>
           </div>
           <div class="flex flex-col">
               <label for="filterValue" class="mb-2 text-gray-700">Value</label>
               <input type="text" name="filterValue" id="filterValue" class="form-input mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Masukkan nilai">
           </div>
           <button type="submit" class="self-end px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Filter</button>
       </form>
   </div>
   <!-- Chart Card -->
   <div class="chart-container">
       <div class="chart-box border border-teal-500">
           <h3>Statistik Warga Per RT</h3>
           <canvas id="chart1"></canvas>
       </div>
       <div class="chart-box border border-teal-500">
           <h3>Statistik Golongan Darah Seluruh Warga</h3>
           <canvas id="chart2"></canvas>
       </div>
       <div class="chart-box border border-teal-500">
           <h3>Statistik Keluarga Per RT</h3>
           <canvas id="chart3"></canvas>
       </div>
       <div class="chart-box border border-teal-500">
           <h3>Statistik Warga Tetap dan Sementara</h3>
           <canvas id="chart4"></canvas>
       </div>
       <div class="chart-box border border-teal-500">
           <h3>Statistik Akun Warga Aktif dan Non-Aktif</h3>
           <canvas id="chart5"></canvas>
       </div>
       <div class="chart-box border border-teal-500">
           <h3>Statistik Jenis Kelamin Seluruh Warga</h3>
           <canvas id="chart6"></canvas>
       </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
   <script>
       // Register the plugin
       Chart.register(ChartDataLabels);

       // Data for the first chart
       const data1 = {
           labels: ['1', '2', '3', '4'],
           datasets: [{
               data: [20, 16, 17, 18],
               backgroundColor: ['#006769', '#40A578', '#9DDE8B', '#58A399'],
               hoverOffset: 4
           }]
       };

       // Configuration for the first chart
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

       // Data for the second chart
       const data2 = {
           labels: ['A', 'B', 'AB', '0'],
           datasets: [{
               data: [33, 32, 12, 12],
               backgroundColor: ['#538392', '#6295A2', '#80B9AD', '#007F73'],
               hoverOffset: 4
           }]
       };

       // Configuration for the second chart
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

       // Data for the third chart
       const data3 = {
           labels: ['1', '2', '3', '4'],
           datasets: [{
               data: [170, 150,160, 150],
               backgroundColor: ['#219C90', '#5B9A8B', '#47A992', '#159895'],
               hoverOffset: 4
           }]
       };

       // Configuration for the third chart
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

       // Data for the fourth chart
       const data4 = {
           labels: ['Tetap', 'Sementara'],
           datasets: [{
               data: [60,40],
               backgroundColor: ['#53BF9D', '#3A8891'],
               hoverOffset: 4
           }]
       };

       // Configuration for the fourth chart
       const config4 = {
           type: 'pie',
           data: data4,
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

        // Data for the five chart
        const data5 = {
           labels: ['Aktif', 'Tidak aktif'],
           datasets: [{
               data: [30,70],
               backgroundColor: ['#39AEA9', '#00C897'],
               hoverOffset: 4
           }]
       };

       // Configuration for the five chart
       const config5 = {
           type: 'pie',
           data: data5,
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


       // Data for the six chart
       const data6 = {
           labels: ['Pria', 'Wanita'],
           datasets: [{
               data: [55,45],
               backgroundColor: ['#3AA6B9', '#CD6688'],
               hoverOffset: 4
           }]
       };

      // Configuration for the six chart
      const config6 = {
           type: 'pie',
           data: data6,
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
       window.onload = function() {
           const ctx1 = document.getElementById('chart1').getContext('2d');
           new Chart(ctx1, config1);

           const ctx2 = document.getElementById('chart2').getContext('2d');
           new Chart(ctx2, config2);

           const ctx3 = document.getElementById('chart3').getContext('2d');
           new Chart(ctx3, config3);

           const ctx4 = document.getElementById('chart4').getContext('2d');
           new Chart(ctx4, config4);

           const ctx5 = document.getElementById('chart5').getContext('2d');
           new Chart(ctx5, config5);

           const ctx6 = document.getElementById('chart6').getContext('2d');
           new Chart(ctx6, config6);
       };
   </script>

   <!-- Charts Penduduk End -->

</div>
</div>


<!-- end content -->

<!-- end wrapper -->

@include('layout.end')
