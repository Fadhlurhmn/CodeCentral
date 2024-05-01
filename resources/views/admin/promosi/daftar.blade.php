@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 
    <h1 class="py-5 ml-5 text-3xl text-gray-900 font-bold">Ini adalah Halaman Daftar permintaan promosi warga</h1>

    <div class="container p-5 mb-5 bg-teal-600 text-lg grid grid-cols-2 items-center">
        <p class="text-white text-xl">Permintaan promosi usaha warga</p>
        <br>
        <a href="{{ url('admin/promosi/') }}" class=" mt-2 px-2 py-1 bg-teal-400 text-teal-900 text-center text-sm font-medium rounded-full justify-self-start">Kembali</a>
    </div>
    
  
    {{-- Search form --}}
     <form action="" method="GET" class="mb-4">
      <input type="text" name="query" placeholder="Cari nama usaha..." class="px-4 py-2 border border-gray-300 rounded-md">
      <button type="submit" class="px-4 py-2 bg-teal-400 text-teal-900 rounded-md ml-2">Cari</button>
    </form>
    {{-- Place your code here --}}
    <div class="container bg-white text-lg grid grid-cols-6 gap-5 p-5 mx-auto overflow-y-auto" style="max-height: 80vh;">
        {{-- Bagian Promosi Usaha Warga --}}
          {{-- Usaha Warga 1 --}}
          <a href="{{url('admin/promosi/show')}}" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Sate Maranggi Pak Ahmadi</h2>
              <p class="mt-0.5 text-sm text-gray-700">Cita rasa legenda sate maranggi</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
              <p class="mt-0.5 bg-yellow-600/60 text-white px-2 rounded-full inline-block">pending</p>
              <form action="{{ url('admin/promosi/show') }}" class="mt-2">
                <button type="submit" class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 2 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Sate Maranggi Pak Ahmadi</h2>
              <p class="mt-0.5 text-sm text-gray-700">Cita rasa legenda sate maranggi</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
              <p class="mt-0.5 bg-yellow-600/60 text-white px-2 rounded-full inline-block">pending</p>
              <form class="mt-2">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 3 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1514327567052-1eed4e4902c1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Burger brother</h2>
              <p class="mt-0.5 text-sm text-gray-700">Menjual burger aneka topping dan hot dog</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
              <p class="mt-0.5 bg-yellow-600/60 text-white px-2 rounded-full inline-block">pending</p>
              <form class="mt-2">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 2 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1514327567052-1eed4e4902c1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Burger brother</h2>
              <p class="mt-0.5 text-sm text-gray-700">Menjual burger aneka topping dan hot dog</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
          
              <form class="mt-4">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 2 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1514327567052-1eed4e4902c1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Burger brother</h2>
              <p class="mt-0.5 text-sm text-gray-700">Menjual burger aneka topping dan hot dog</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
          
              <form class="mt-4">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 2 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1514327567052-1eed4e4902c1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Burger brother</h2>
              <p class="mt-0.5 text-sm text-gray-700">Menjual burger aneka topping dan hot dog</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
          
              <form class="mt-4">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 2 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1514327567052-1eed4e4902c1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Burger brother</h2>
              <p class="mt-0.5 text-sm text-gray-700">Menjual burger aneka topping dan hot dog</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
          
              <form class="mt-4">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
        {{-- End Bagian Usaha Warga --}}
    </div>
  <!-- end content -->
</div>
<!-- end wrapper -->

@include('layout.end')
