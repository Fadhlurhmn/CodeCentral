@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <!-- General Report -->
    @include('template.index.generalReport')
    <!-- End General Report -->

    <!-- strat Analytics -->
    @include('template.index.analytics-1')
    <!-- end Analytics -->

    <!-- Sales Overview -->
    @include('template.index.salesOverview')
    <!-- end Sales Overview -->

    <!-- start numbers -->
    @include('template.index.numbers')
    <!-- end nmbers -->

    <!-- start quick Info -->
    @include('template.index.quickInfo')
    <!-- end quick Info -->
        

  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
