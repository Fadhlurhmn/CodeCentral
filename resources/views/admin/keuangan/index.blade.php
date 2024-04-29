@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 

    
    {{-- Place your code here --}}
    <div class="text-lg">Ini adalah Halaman Keuangan (MEDIUM)</div>
        

  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
