@include('layouts.start')


@include('layouts.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layouts.a_sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    <!-- General Report -->
    @include('index.generalReport')
    <!-- End General Report -->

    <!-- strat Analytics -->
    @include('index.analytics-1')
    <!-- end Analytics -->

    <!-- Sales Overview -->
    @include('index.salesOverview')
    <!-- end Sales Overview -->

    <!-- start numbers -->
    @include('index.numbers')
    <!-- end nmbers -->

    <!-- start quick Info -->
    @include('index.quickInfo')
    <!-- end quick Info -->
        

  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layouts.end')
