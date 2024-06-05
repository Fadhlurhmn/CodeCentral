@include('layout.start')


@include('layout.rw_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.rw_sidebar')

  <!-- strat content -->
  <div class="bg-white flex-1 p-6 md:mt-16"> 

    
    <div class="text-lg">Ini adalah Halaman Dashboard (HIGH)</div>
        

  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
