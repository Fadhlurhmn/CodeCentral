@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap ">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 md:mt-16 cursor-default"> 
    <div class="container p-5 mb-5 bg-white border-t-4 border-teal-500 text-lg flex flex-col items-start">
      <h1 class="py-5 text-3xl text-gray-900 font-bold">{{$breadcrumb->title}}</h1>
      <p class="mb-3 text-xl">{{$page->title}}</p>
      <div class="flex justify-between w-full">
        <a class="p-2 text-sm font-normal text-center shadow-md bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('admin/pengumuman/create')}}">Tambah Pengumuman</a>
        {{-- Search form --}}
        <form action="{{ url()->current() }}" method="GET" class="text-sm font-medium">
          <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari pengumuman" class="px-4 py-2 border border-gray-300 rounded-md">
          <button type="submit" class="px-4 py-2 bg-teal-400 text-teal-900 rounded-md ml-2">Cari</button>
        </form>
      </div>
    </div>
      {{-- Bagian pengumuman Usaha Warga --}}
      <div class="h-fit grid grid-cols-1 gap-5 p-6 mx-auto bg-white/50 border-t-4 border-teal-400 cursor-default">
        @foreach ($pengumuman as $pengumumans)
            <div class="rounded-lg shadow-md flex flex-row border-b-2 border-teal-500">
                <div class="p-4 flex-1">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $pengumumans->judul_pengumuman }}</h2>
                    <p class="text-xs text-gray-600">Penulis: {{ $pengumumans->id_user }}</p>
                    <div class="mb-2">
                        <p class="text-xs text-gray-600">Tanggal penulisan: {{ $pengumumans->created_at }}</p>
                    </div>
                </div>
                <div class="mr-4 flex flex-row items-center justify-center">
                    <form action="{{ url('admin/pengumuman/'.$pengumumans->id_pengumuman.'/show') }}">
                        <button type="submit" class="bg-teal-500/70 py-2 px-4 mr-2 text-sm font-normal rounded-full text-white transition duration-300 ease-in-out hover:bg-teal-600">
                            Preview
                        </button>
                    </form>
                    <form action="{{ url('admin/pengumuman/'.$pengumumans->id_pengumuman.'/edit') }}">
                        <button type="submit" class="bg-yellow-200 py-2 px-4 text-sm font-normal rounded-full text-yellow-500 transition duration-300 ease-in-out hover:bg-yellow-300">
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
     </div>
     {{-- End Bagian pengumuman Usaha Warga --}}
  
  <!-- end content -->
  </div>
</div>
<!-- end wrapper -->
@include('layout.end')