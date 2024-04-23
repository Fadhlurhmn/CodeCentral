@include('base.start')


@include('base.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
  
    
    <!-- strat content -->
    <div class="bg-white flex-grow overflow-auto"> 
      @include('warga.index')
    </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('base.end')
