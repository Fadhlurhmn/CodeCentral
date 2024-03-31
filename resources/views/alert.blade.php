@include('base.start')


@include('base.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('base.sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">
    
    @include('ui.alert.head')
    @include('ui.alert.alert_1')
    @include('ui.alert.alert_2')
    @include('ui.alert.alert_3')

  </div>
  <!-- end content -->

</div>
<!-- end wrapper --> 

  

@include('base.end')
