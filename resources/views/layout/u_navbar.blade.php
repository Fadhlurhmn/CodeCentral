<header class="header">
  <nav class="navbar container">
    <!-- logo -->
    <div class="order-0">
      <a href="{{ route('user.landing') }}" class="text-black text-2xl font-semibold">
          SI RW 3 TLOGOMAS
      </a>
    </div>
    <!-- navbar toggler -->
    <input id="nav-toggle" type="checkbox" class="hidden" />
    <label
      id="show-button"
      for="nav-toggle"
      class="order-1 flex cursor-pointer items-center lg:order-1 lg:hidden"
    >
      <svg class="h-6 fill-current" viewBox="0 0 20 20">
        <title>Menu Open</title>
        <path d="M0 3h20v2H0V3z m0 6h20v2H0V9z m0 6h20v2H0V0z"></path>
      </svg>
    </label>
    <label
      id="hide-button"
      for="nav-toggle"
      class="order-2 hidden cursor-pointer items-center lg:order-1"
    >
      <svg class="h-6 fill-current" viewBox="0 0 20 20">
        <title>Menu Close</title>
        <polygon
          points="11 9 22 9 22 11 11 11 11 22 9 22 9 11 -2 11 -2 9 9 9 9 -2 11 -2"
          transform="rotate(45 10 10)"
        ></polygon>
      </svg>
    </label>
    <!-- /navbar toggler -->
    <ul
      id="nav-menu"
      class="navbar-nav order-2 hidden w-full flex-[0_0_100%] lg:order-1 lg:flex lg:w-auto lg:flex-auto lg:justify-center lg:space-x-5"
    >
      <li class="nav-item">
        <a href="{{ route('user.landing') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.pengumuman') }}" class="nav-link">Pengumuman</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.umkm') }}" class="nav-link">UMKM</a>
      </li>

      <li class="nav-item nav-dropdown group relative">
        <span class="nav-link inline-flex items-center">
          Bansos
          <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
            <path
              d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
            />
          </svg>
        </span>
        <ul
          class="nav-dropdown-list hidden group-hover:block lg:invisible lg:absolute lg:block lg:opacity-0 lg:group-hover:visible lg:group-hover:opacity-100"
        >
          <li class="nav-dropdown-item">
            <a href="{{ route('user.bansos.pengajuan') }}" class="nav-dropdown-link"
              >Pengajuan</a
            >
          </li>
          <li class="nav-dropdown-item">
            <a href="{{ route('user.bansos.list') }}" class="nav-dropdown-link"
              >Daftar Penerima</a
            >
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.surat') }}" class="nav-link">Surat</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.pengaduan') }}" class="nav-link">Pengaduan</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.struktur') }}" class="nav-link">Struktur RW & RT</a>
      </li>
    </ul>
    {{-- <div class="order-1 ml-auto hidden items-center opacity-0 md:order-2 md:ml-0 lg:flex">
      <div class="btn btn-white btn-sm">Sing Up Now</div>
    </div> --}}
  </nav>
</header>
