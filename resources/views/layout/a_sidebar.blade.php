  <!-- start sidebar -->
  <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 py-4 px-6 flex-none w-52 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated duration-500 ease-in-out">


    <!-- sidebar content -->
    <div class="flex flex-col">

      <!-- sidebar toggle -->
      <div class="text-right hidden md:block mb-4">
        <button id="sideBarHideBtn">
          <i class="fad fa-times-circle"></i>
        </button>
      </div>
      <!-- end sidebar toggle -->

      <p class="uppercase font-semibold text-sm text-teal-600 mb-2 tracking-wider">FITUR SI RW</p>


    <a href="{{ url('/admin') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fad fa-chart-pie text-xs mr-2"></i>
        Dashboard
    </a>

    <a href="{{ url('/admin/akun') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-user text-xs mr-2"></i>
        Akun
    </a>

    <a href="{{ url('/admin/jabatan') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-briefcase text-xs mr-2"></i>
        Jabatan
    </a>

    <a href="{{ url('/admin/bansos') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-people-carry text-xs mr-2"></i>
        Bansos
    </a>

      <a href="{{url('/admin/penduduk')}}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-users text-xs mr-2"></i>
        Data Penduduk
      </a>
      <a href="{{url('/admin/keluarga')}}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-user-friends text-xs mr-2"></i>
        Data Keluarga
      </a>

    <a href="{{ url('/admin/pengumuman') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-bullhorn text-xs mr-2"></i>
        Pengumuman
    </a>

    <a href="{{ url('/admin/promosi') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-ad text-xs mr-2"></i>
        Promosi
    </a>

    <a href="{{ url('/admin/surat') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-envelope text-xs mr-2"></i>
        Surat
    </a>

    <a href="{{ url('/admin/jadwal') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="far fa-calendar-alt text-xs mr-2"></i>
        Jadwal
    </a>

    <a href="{{ url('/admin/keuangan') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-coins text-xs mr-2"></i>
        Keuangan
    </a>

    {{-- <a href="{{ url('/login') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-sign-in-alt text-xs mr-2"></i>
        Login
    </a>

    <a href="{{ url('/logout') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fas fa-sign-out-alt text-xs mr-2"></i>
        Logout
    </a> --}}

      <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">Template Example</p>

      <a href="/template" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fad fa-chart-pie text-xs mr-2"></i>
        Analytics dashboard
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="/template/shop" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fad fa-shopping-cart text-xs mr-2"></i>
        ecommerce dashboard
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="/template/typography" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fad fa-text text-xs mr-2"></i>
        typography
      </a>
      <!-- end link -->

      <!-- link -->
      <a href="/template/alert" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fad fa-whistle text-xs mr-2"></i>
        alerts
      </a>
      <!-- end link -->


      <!-- link -->
      <a href="/template/buttons" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
        <i class="fad fa-cricket text-xs mr-2"></i>
        buttons
      </a>
      <!-- end link -->

    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->
