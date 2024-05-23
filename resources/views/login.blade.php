@include('layout.start')

 <!-- start content -->
<div class="bg-gray-50">
  <div class="flex flex-col items-center justify-center px-64 py-8 mx-auto h-screen md:px-6 lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
          SIRW 
      </a>
      <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 ">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                  Login ke Akunmu
              </h1>
              {{-- error handling when login failed --}}
              @error('login_gagal')
                <div class="alert alert-error alert-close">
                  <button class="alert-btn-close">
                    <i class="fad fa-times"></i>
                  </button>
                  <span>{{ $message }}</span>
                </div>
              @enderror

              <form class="space-y-4 md:space-y-6" action="{{ url('proses_login') }}" method="POST">
                @csrf
                  <div>
                      {{-- username input --}}
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                      <input type="text" name="username" id="username" value="{{ old('username') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 @error('username') border-red-600 @enderror" placeholder="Masukkkan username" required>
                      
                      {{-- error handling when failed --}}
                      @error('username')
                          <small class="text-red-600">{{ $message }}</small>
                      @enderror
                  </div>
                  <div>
                      {{-- password input --}}
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                      <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 @error('password') border-red-600 @enderror" required>
              
                      {{-- error handling when failed --}}
                      @error('password')
                          <small class="text-red-600">{{ $message }}</small>
                      @enderror
                  </div>
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                          {{-- remember me input --}}
                          <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-yellow-300 ">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="remember">Remember me</label>
                          </div>
                      </div>

                      {{-- call for admin --}}
                      <span class="text-sm font-medium">Lupa Password? <a href="#" class="text-sm font-medium text-yellow-600 hover:underline ">Hubungi Admin</a></span>
                  </div>
                  <button type="submit" class="w-full bg-yellow-300 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Login</button>
                  <p class="text-sm font-light ">
                      Kembali ke <a href="/" class="font-medium text-yellow-600 hover:underline">Halaman Utama</a>
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
