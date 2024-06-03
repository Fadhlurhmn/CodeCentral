  <!-- start sidebar -->
  <div id="sideBar" class="relative flex flex-col flex-wrap bg-gradient-to-t from-teal-800 via-teal-400/60 to-white border-r border-teal-500 py-4 px-6 flex-none w-52 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated duration-500 ease-in-out">


    <!-- sidebar content -->
    <div class="flex flex-col cursor-default">

      <!-- sidebar toggle -->
      <div class="text-right hidden md:block mb-4">
        <button id="sideBarHideBtn">
          <i class="fad fa-times-circle"></i>
        </button>
      </div>
      <!-- end sidebar toggle -->

      <p class="uppercase font-semibold text-sm text-teal-800 mb-2 tracking-wider">FITUR SI RW</p>

      <a href="{{ url('/rw') }}" class="mb-1 p-2 capitalize font-medium text-sm text-gray-700 rounded-full transition ease-in-out duration-300 
          {{ Request::is('rw') ? 'bg-teal-500/60 text-teal-800 pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
          <i class="fad fa-chart-pie text-xs mr-2"></i>
          Dashboard
      </a>
      <a href="{{ url('/rw/bansos') }}" class="mb-1 p-2 capitalize font-medium text-sm hover:bg-teal-400/40 hover:text-teal-700 rounded-full transition ease-in-out duration-300 {{ Request::is('rt/bansos') ? 'bg-teal-500/60 text-teal-800 shadow-lg pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
        <i class="fas fa-people-carry text-xs mr-2"></i>
        Bansos
      </a>
      <a href="{{ url('/rw/penduduk') }}" class="mb-1 p-2 capitalize font-medium text-sm text-gray-700 rounded-full transition ease-in-out duration-300 
          {{ Request::is('rw/penduduk') ? 'bg-teal-500/60 text-teal-800 pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
          <i class="fad fa-users text-xs mr-2"></i>
          Penduduk
      </a>
      <a href="{{ url('/rw/keluarga') }}" class="mb-1 p-2 capitalize font-medium text-sm text-gray-700 rounded-full transition ease-in-out duration-300 
          {{ Request::is('rw/keluarga') ? 'bg-teal-500/60 text-teal-800 pointer-events-none' : 'hover:bg-teal-400/40 hover:text-teal-700' }}">
          <i class="fad fa-home text-xs mr-2"></i>
          Keluarga
      </a>


    </div>
    <!-- end sidebar content -->

  </div>
  <!-- end sidbar -->
