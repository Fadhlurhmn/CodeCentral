@include('layout.start')

<!-- start content -->
<div class="bg-gradient-to-tl from-teal-600/70 via-gray-300 to-teal-500/70 min-h-screen flex items-center justify-center cursor-default">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-3xl font-bold text-teal-600">
          SIRW 
      </a>
      <div class="w-full bg-white/45 rounded-lg shadow-lg md:mt-0 sm:max-w-md xl:p-0">
          <div class="p-8 space-y-6 md:space-y-8 sm:p-8">
              <h1 class="text-2xl font-bold leading-tight tracking-tight text-teal-600 md:text-3xl">
                  Login ke Akunmu
              </h1>
              {{-- error handling when login failed --}}
              @error('login_gagal')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                  <strong class="font-bold">Login Gagal!</strong>
                  <span class="block sm:inline">{{ $message }}</span>
                  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.415 0L10 8.585 7.067 5.652a1 1 0 10-1.415 1.415L8.585 10l-2.933 2.933a1 1 0 101.415 1.415L10 11.415l2.933 2.933a1 1 0 001.415-1.415L11.415 10l2.933-2.933a1 1 0 000-1.415z"/></svg>
                  </span>
                </div>
              @enderror

              <form class="space-y-6 md:space-y-8" action="{{ url('proses_login') }}" method="POST">
                @csrf
                  <div>
                      {{-- username input --}}
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-700">Username</label>
                      <input type="text" name="username" id="username" value="{{ old('username') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 @error('username') border-red-600 @enderror" placeholder="Masukkkan username" required>
                      
                      {{-- error handling when failed --}}
                      @error('username')
                          <small class="text-red-600">{{ $message }}</small>
                      @enderror
                  </div>
                  <div>
                      {{-- password input --}}
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                      <div class="relative">
                        <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 @error('password') border-red-600 @enderror pr-10" required>
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                          <i class="far fa-eye" id="toggle-password-icon"></i>
                        </button>
                      </div>
                      {{-- error handling when failed --}}
                      @error('password')
                          <small class="text-red-600">{{ $message }}</small>
                      @enderror
                  </div>

                  <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white">Login</button>
                  <p class="text-sm font-light text-gray-700">
                      Kembali ke <a href="/" class="font-medium text-teal-600 hover:underline">Halaman Utama</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- end content -->

{{-- </div> --}}
<!-- end wrapper -->

@include('layout.end')

<script>
  document.getElementById('toggle-password').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const passwordIcon = document.getElementById('toggle-password-icon');
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      passwordIcon.classList.toggle('fa-eye');
      passwordIcon.classList.toggle('fa-eye-slash');
  });
  </script>
