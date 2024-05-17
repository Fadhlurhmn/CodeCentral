<div class="container h-full bg-white">
    <div class="pt-5 px-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
      <h1 class=" my-2 text-2xl font-extrabold text-gray-600 ">Daftar Bantuan Sosial</h1>
      {{-- <div class="mb-5 text-xs">
          <a class="p-2 font-normal text-center bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/keluarga/create')}}">Tambah Data Keluarga</a>
      </div> --}}
      <div class="h-auto p-2">
        <div class="w-full grid grid-cols-2 gap-6 mb-7">
            <!-- card -->
            <div class="card mt-6 col-span-1 border-2 border-teal-500 bg-teal-400/20 rounded-lg shadow-md">
                <div class="card-body flex items-center">
                    <div class="px-3 py-2 rounded bg-emerald-500 text-white mr-3">
                        <i class="fad fa-people-carry"></i>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-semibold"><span class="num-2"></span> Total Bantuan Sosial</h1>
                    </div>
                </div>
            </div>
            <!-- end card -->
          
            <!-- card -->
            <div class="card mt-6 col-span-1 border-2 border-teal-500 bg-teal-400/20 rounded-lg shadow-md">
                <div class="card-body flex items-center">
                    <div class="px-3 py-2 rounded bg-green-500 text-white mr-3">
                        <i class="fad fa-user-friends"></i>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-semibold"><span class="num-2"></span> Keluarga Penerima</h1>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- Search form -->
        <div class="flex mb-2">
            <form action="{{ url()->current() }}" method="GET" class="text-sm font-medium ml-auto">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari nama bansos..." class="px-4 py-2 border border-gray-500 rounded-md text-xs">
            </form>
        </div>
    </div>
    
    </div>
    <div class=" p-5 mx-auto h-screen bg-white/50 border-t-2 border-teal-400 cursor-default overflow-y-auto">    
            @foreach (range(1, 20) as $i)
            <div class="p-4 mb-5 bg-neutral-50 flex justify-between shadow-md rounded-md">
                <div class="flex-col">
                    <h1>Bantuan Sosial {{ $i }}</h1>
                    <p class="text-xs">Bansos sosial {{ $i }} diberikan oleh pemerintah dengan target bla bla</p>
                </div>
                <a href="bansos/detail">
                    <button class="p-2 text-xs text-gray-700 rounded-lg bg-gray-400/30 hover:text-gray-900 hover:bg-gray-600/30 transition duration-200 ease-in-out">Lihat Detail <i class="fad fa-info-circle"></i></button>
                </a>
            </div>
            @endforeach
    </div>
  </div>