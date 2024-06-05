<footer class="footer bg-theme-light/50">
  <div class="container">
    <div class="row gx-5 pb-10 pt-[52px]">
      <div class="col-12 mt-12 md:col-4 lg:col-6">
        <a href="{{ route('user.landing') }}" class="text-black text-2xl font-semibold">
          SI RW 4 TLOGOMAS
        </a>
        <div class="mt-6 text-justify">
          <p class="mb-5">SIRW (Sistem Informasi Rukun Warga) adalah sebuah platform digital yang dirancang untuk memudahkan komunikasi dan layanan antara warga dan pengurus RW dan RT.</p>
          <p>Melalui situs ini, Anda dapat mengakses berbagai informasi penting seperti berita terkini, jadwal kegiatan, program bantuan sosial, promosi UMKM lokal, dan banyak lagi.</p>
        </div>
      </div>
      <div class="col-12 mt-12 md:col-4 lg:col-3">
        <h6>ALAMAT</h6>
        <p>JL. Ursa Mayor No. 10 Tlogomas, Lowokwaru, Malang 65144</p>
      </div>
      <div class="col-12 mt-12 md:col-4 lg:col-3">
        <h6>MENU</h6>
        <ul>
          <li>
            <a class="text-inherit" href="{{ route('user.landing') }}">Home</a>
          </li>
          <li>
            <a class="text-inherit" href="{{ route('user.pengumuman') }}">Pengumuman</a>
          </li>
          <li>
            <a class="text-inherit" href="{{ route('user.promosi') }}">UMKM</a>
          </li>
          <li>
            <a class="text-inherit" href="{{ route('user.bansos.list') }}">Bansos</a>
          </li>
          <li>
            <a class="text-inherit" href="{{ route('user.surat') }}">Surat</a>
          </li>
          <li>
            <a class="text-inherit" href="{{ route('user.pengaduan') }}">Pengaduan</a>
          </li>
          <li>
            <a class="text-inherit" href="{{ route('user.struktur') }}">Struktur RW & RW</a>
          </li>
          <li>
            <a class="text-inherit" href="/login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container max-w-[1440px]">
    <div
      class="footer-copyright mx-auto border-t border-border pb-10 pt-5 text-center">
      <p class="text-lg">&copy; Code Central Team <a href="https://github.com/Fadhlurhmn/codecentral" target="_blank">SIRW Tlogomas</a></p>
    </div>
  </div>
</footer>

{{-- Flowbite --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> 

@vite('resources/plugins/swiper/swiper-bundle.js')
<script src="../resources/plugins/shufflejs/shuffle.js"></script>

@vite('resources/js/main.js')

@stack('js')
</body>
</html>
