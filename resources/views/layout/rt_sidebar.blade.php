  <!-- start sidebar -->
  <div id="sideBar" class="relative flex flex-col flex-wrap bg-gradient-to-t from-teal-800 via-teal-400/60 to-white border-r border-teal-500 py-4 px-6 flex-none w-52 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated duration-500 ease-in-out">


    <!-- sidebar content -->
    <div class="flex flex-col">

      <!-- sidebar toggle -->
      <div class="text-right hidden md:block mb-4">
        <button id="sideBarHideBtn">
          <i class="fad fa-times-circle"></i>
        </button>
      </div>
      <!-- end sidebar toggle -->

      <p class="uppercase font-semibold text-sm text-teal-800 mb-2 tracking-wider">FITUR SI RW</p>


      <a href="{{ url('/rt') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300 {{ Request::is('rt') ? 'bg-teal-500/60 text-teal-800 shadow-lg pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
          <i class="fad fa-chart-pie text-xs mr-2"></i>
          Dashboard
      </a>

      <a href="{{ url('/rt/bansos') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300 {{ Request::is('rt/bansos') ? 'bg-teal-500/60 text-teal-800 shadow-lg pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
          <i class="fas fa-people-carry text-xs mr-2"></i>
          Bansos
      </a>

      <a href="{{url('/rt/penduduk')}}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300 {{ Request::is('rt/penduduk') ? 'bg-teal-500/60 text-teal-800 shadow-lg pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
        <i class="fas fa-users text-xs mr-2"></i>
        Data Penduduk
      </a>

      <a href="{{url('/rt/keluarga')}}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300 {{ Request::is('rt/keluarga') ? 'bg-teal-500/60 text-teal-800 shadow-lg pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
        <i class="fas fa-user-friends text-xs mr-2"></i>
        Data Keluarga
      </a>

      {{-- <a href="{{ url('/rt/promosi') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
          <i class="fas fa-ad text-xs mr-2"></i>
          Promosi
      </a>

      <a href="{{ url('/rt/keuangan') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300">
          <i class="fas fa-coins text-xs mr-2"></i>
          Keuangan
      </a> --}}

    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->
