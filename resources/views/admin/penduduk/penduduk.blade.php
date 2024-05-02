@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen min-w-full flex flex-row flex-wrap">
    @include('layout.a_sidebar')
  
    
    <!-- strat content -->
    <div class="flex-col flex-grow">
      @include('admin.penduduk.index')
    </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
