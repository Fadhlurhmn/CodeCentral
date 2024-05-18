  <!-- start sidebar -->
  <div id="sideBar" class="relative hidden flex-col flex-wrap bg-white border-r border-gray-300 flex-none w-64 md:flex md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
    

    <!-- sidebar content -->
    <div class="flex flex-col flex-grow">

      <!-- sidebar toggle -->
      <div class="text-right block m-4">
        <button id="sideBarHideBtn">
          <i class="text-lg far fa-times-circle"></i>
        </button>
      </div>
      <!-- end sidebar toggle -->

      <p class="uppercase text-xs text-gray-600 mb-4 text-center tracking-wider">LAYANAN SI RW</p>


      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Home') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-home text-base mr-2"></i>
        Home
      </a>
      
      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Pengumuman') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-bullhorn text-base mr-2"></i>
        Pengumuman
      </a>
      
      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Pengaduan') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-exclamation-triangle text-base mr-2"></i>
        Pengaduan
      </a>
      
      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Promosi') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-ad text-base mr-2"></i>
        Promosi
      </a>
      
      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Bansos') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-people-carry text-base mr-2"></i>
        Bantuan Sosial
      </a>

      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Surat') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-envelope text-base mr-2"></i>
        Permintaan Surat
      </a>

      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Jadwal') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="far fa-calendar-alt text-base mr-2"></i>
        Jadwal
      </a>

      <a href="#" class="w-full  p-2 capitalize block px-6 font-medium text-base @if($activeMenu == 'Keuangan') bg-yellow-400 @endif hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-coins text-base mr-2"></i>
        Keuangan
      </a>
      
      <div class="flex-grow"></div>

      <a href="/login" class="w-full p-2 flex items-end capitalize px-6 font-medium text-base bg-yellow-400 hover:bg-yellow-200 transition ease-in-out duration-500">
        <i class="fas fa-sign-in-alt text-base mr-2"></i>
        Login
      </a>

    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->