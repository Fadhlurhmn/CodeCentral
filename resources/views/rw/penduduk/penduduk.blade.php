@include('layout.start')


@include('layout.rw_navbar')


<!-- strat wrapper -->
<div class="h-screen  min-w-full flex flex-row flex-wrap">
    @include('layout.rw_sidebar')
  
    
    <!-- strat content -->
    <div class="flex-col flex-grow">
      @include('rw.penduduk.index')
    </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
