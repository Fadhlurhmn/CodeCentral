@include('base.start')


@include('base.navbar')


<!-- strat wrapper -->
<div class="h-screen min-w-full flex flex-row flex-wrap">
    @include('base.sidebar')
  
    
    <!-- strat content -->
    <div class="flex-col" style="width: 1147px"> 
      @include('admin.keluarga.index')
    </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('base.end')
