@include('layouts.start')


@include('layouts.a_navbar')


<!-- strat wrapper -->
<div class="h-screen min-w-full flex flex-row flex-wrap">
    @include('layouts.a_sidebar')
  
    
    <!-- strat content -->
    <div class="flex-col" style="width: 1147px"> 
      @include('admin.keluarga.index')
    </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layouts.end')
