@include('base.start')


@include('base.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('base.sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">
    
    @include('ui.buttons.head')
    @include('ui.buttons.1_btns')
    @include('ui.buttons.2_btns')


  </div>
  <!-- end content -->

</div>
<!-- end wrapper --> 

  

@include('base.end')
