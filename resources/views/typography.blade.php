@include('base.start')


@include('base.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('base.sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">
    
    @include('ui.typography.head')
    
    @include('ui.typography.heading_1')    

  </div>
  <!-- end content -->

</div>
<!-- end wrapper --> 



@include('base.end')
