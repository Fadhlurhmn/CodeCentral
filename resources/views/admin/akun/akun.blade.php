@include('layout.start')

@include('layout.a_navbar')

<!-- Memulai wrapper -->
<div class="h-screen flex flex-row flex-wrap">

  @include('layout.a_sidebar')  <!-- Menyertakan sidebar -->

  <!-- Memulai konten utama -->
  <div class="flex-col flex-grow">
    @include('admin.akun.index')  <!-- Menyertakan konten dari file index akun admin -->
  </div>
  <!-- Mengakhiri konten utama -->

</div>
<!-- Mengakhiri wrapper -->

@include('layout.end')
