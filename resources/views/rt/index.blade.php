@include('layout.start')


@include('layout.rt_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.rt_sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <div class="text-lg">Ini adalah Halaman Dashboard RT (HIGH)</div>
        

  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
