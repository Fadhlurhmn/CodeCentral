<footer class="footer bg-theme-light/50">
  <div class="container">
    <div class="row gx-5 pb-10 pt-[52px]">
      <div class="col-12 mt-12 md:col-4 lg:col-6">
        <a href="{{ route('user.landing') }}" class="text-black text-2xl font-semibold">
          SI RW 3 TLOGOMAS
        </a>
        <p class="mt-6">
          SIRW (Sistem Informasi Rukun Warga) adalah sebuah platform digital yang dirancang untuk memudahkan komunikasi dan layanan antara warga dan pengurus RW dan RT.
          <br><br>Melalui situs ini, Anda dapat mengakses berbagai informasi penting seperti berita terkini, jadwal kegiatan, program bantuan sosial, promosi UMKM lokal, dan banyak lagi.
        </p>
      </div>
      <div class="col-12 mt-12 md:col-4 lg:col-3">
        <h6>SOSIAL MEDIA</h6>
        <p>rw3tlogomas@gmail.com</p>
        <ul class="social-icons mt-4 lg:mt-6">
          <li>
            <a href="#">
              <svg
                width="19"
                height="21"
                viewBox="0 0 20 21"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M19.1056 10.4495C19.1056 5.09642 15 0.759277 9.9327 0.759277C4.86539 0.759277 0.759766 5.09642 0.759766 10.4495C0.759766 15.2946 4.08865 19.3191 8.49018 20.0224V13.2627H6.15996V10.4495H8.49018V8.33951C8.49018 5.91696 9.85872 4.54939 11.93 4.54939C12.9657 4.54939 14.0013 4.74476 14.0013 4.74476V7.12823H12.8547C11.7081 7.12823 11.3382 7.87063 11.3382 8.65209V10.4495H13.8904L13.4835 13.2627H11.3382V20.0224C15.7398 19.3191 19.1056 15.2946 19.1056 10.4495Z"
                  fill="#222222"
                />
              </svg>
            </a>
          </li>
          <li>
            <a href="#">
              <svg
                width="19"
                height="15"
                viewBox="0 0 19 15"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M16.3308 3.92621C17.0129 3.42889 17.6269 2.83209 18.1044 2.13583C17.4904 2.40108 16.7742 2.60001 16.0579 2.66632C16.8083 2.2353 17.354 1.5722 17.6269 0.743317C16.9447 1.14118 16.1603 1.43958 15.3758 1.60535C14.6937 0.909093 13.7728 0.51123 12.7496 0.51123C10.7714 0.51123 9.16837 2.06952 9.16837 3.99252C9.16837 4.25777 9.20248 4.52301 9.27069 4.78825C6.3034 4.62247 3.64307 3.22995 1.86952 1.14118C1.56256 1.63851 1.39202 2.2353 1.39202 2.8984C1.39202 4.09199 2.00595 5.15296 2.99504 5.7829C2.41523 5.74975 1.83541 5.61713 1.35792 5.35189V5.38504C1.35792 7.07596 2.58576 8.46847 4.22289 8.80002C3.95003 8.86633 3.60897 8.93265 3.302 8.93265C3.06326 8.93265 2.85862 8.89949 2.61987 8.86633C3.06326 10.2589 4.39342 11.2535 5.96233 11.2867C4.73449 12.215 3.19968 12.7786 1.52845 12.7786C1.22149 12.7786 0.948636 12.7455 0.675781 12.7123C2.24469 13.707 4.12057 14.2706 6.16698 14.2706C12.7496 14.2706 16.3308 8.99896 16.3308 4.39039C16.3308 4.22461 16.3308 4.09199 16.3308 3.92621Z"
                  fill="#222222"
                />
              </svg>
            </a>
          </li>
        </ul>
      </div>
      <div class="col-12 mt-12 md:col-4 lg:col-3">
        <h6>LAYANAN</h6>
        <ul>
          <li>
            <a href="{{ route('user.landing') }}">Home</a>
          </li>
          <li>
            <a href="{{ route('user.pengumuman') }}">Pengumuman</a>
          </li>
          <li>
            <a href="{{ route('user/umkm') }}">UMKM</a>
          </li>
          <li>
            <a href="{{ route('user/bansos/list') }}">Bansos</a>
          </li>
          <li>
            <a href="{{ route('user.surat') }}">Surat</a>
          </li>
          <li>
            <a href="{{ route('user/pengaduan') }}">Pengaduan</a>
          </li>
          <li>
            <a href="/login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  {{-- <div class="container max-w-[1440px]">
    <div
      class="footer-copyright mx-auto border-t border-border pb-10 pt-7 text-center"
    >
      <p>Designed And Developed by <a href="https://themefisher.com" target="_blank">Themefisher</a></p>
    </div>
  </div> --}}
</footer>

<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<!-- Swiper JS -->
{{-- <script src="../resources/plugins/swiper/swiper-bundle.js"></script> --}}
@vite('resources/plugins/swiper/swiper-bundle.js')
<script src="../resources/plugins/shufflejs/shuffle.js"></script>

<!-- Main Script -->
{{-- <script src="../resources/js/main.js"></script> --}}
@vite('resources/js/main.js')

@stack('js')
</body>
</html>
