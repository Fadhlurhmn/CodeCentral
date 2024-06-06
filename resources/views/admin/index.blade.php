@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

  @include('layout.a_sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">


    <div class="text-lg">Ini adalah Halaman Dashboard (HIGH)</div>
    @if (session('success'))
    <!-- Menampilkan pesan sukses jika ada session 'success' -->
    <div class="col-span-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif


  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->

@include('layout.end')
