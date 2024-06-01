@include('layout.start')


@include('layout.rt_navbar')


<!-- strat wrapper -->
<div class="h-screen min-w-full flex flex-row flex-wrap">
    @include('layout.rt_sidebar')
  
    
    <!-- strat content -->
    <div class="flex-col flex-grow">
      @include('rt.penduduk.index')
    </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
