@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">
    
    @include('template.ui.typography.head')
    
    @include('template.ui.typography.heading_1')    

  </div>
  <!-- end content -->

</div>
<!-- end wrapper --> 



@include('layout.end')
