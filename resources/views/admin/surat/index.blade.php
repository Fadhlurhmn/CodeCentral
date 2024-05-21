{{-- Styling tambahan manual --}}
<style>
  /* For WebKit browsers (Chrome, Safari) */
  .custom-scrollbar::-webkit-scrollbar {
      width: 0px;  /* Remove scrollbar space */
      background: transparent;  /* Optional: just make scrollbar invisible */
  }
  
  /* For Firefox */
  .custom-scrollbar {
      scrollbar-width: none;  /* Remove scrollbar space */
      -ms-overflow-style: none;  /* IE and Edge */
  }
  
  /* To make sure the custom-scrollbar class is applied properly */
  .custom-scrollbar {
      overflow-y: auto;
  }
  </style>
  
{{-- End Styling tambahan manual--}}


{{-- Pembatas luar halaman dan background --}}
<div class="container h-full bg-white cursor-default">

  {{-- Kotak konten atas (Judul,Card & Search) --}}
<div class="pt-5 px-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
  {{-- <h1 class="my-2 text-2xl font-extrabold text-gray-600">{{$page->title}}</h1> --}}
  <h1 class="my-2 text-2xl font-extrabold text-gray-600">Daftar Surat</h1>
  
  {{-- Card Jumlah bansos & penerima --}}
  <div class="w-full h-auto grid grid-cols-2 gap-6 mb-5">
      {{-- Card Jumlah bansos --}}
      <div class="card mt-6 col-span-1 border-2 border-teal-500 bg-teal-400/20 rounded-lg shadow-md">
          <div class="card-body flex items-center">
              <div class="px-3 py-2 rounded bg-teal-500 text-white mr-3">
                <i class="fad fa-envelope-open-text"></i>
              </div>
              <div class="flex flex-col">
                  <h1 class="font-semibold">-- Total surat</h1>
              </div>
          </div>
      </div>
      {{-- End card jumlah penerima bansos --}}
      
  </div>
  {{-- End Card Jumlah bansos & penerima--}}

  {{-- Search --}}
  <div class="flex mb-3 text-xs">
      {{-- <button class="p-2 mr-5 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('#')}}">Tambah Surat</button> --}}
      <button data-modal-target="crud-surat" data-modal-toggle="crud-surat" class="p-2 mr-5 bg-green-300 font-normal text-center shadow-sm hover:bg-teal-400 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" type="button">
        Tambah Surat
      </button>
      <form action="javascript:void(0);" method="GET" class="text-sm font-medium ml-auto" id="searchForm">
          <input type="text" id="searchInput" name="query" placeholder="Cari Surat..." class="px-4 py-2 border border-gray-500 rounded-md text-xs">
      </form>
  </div>
  {{-- End Search --}}

</div>
{{-- End Kotak konten atas (Judul,Card & Search) --}}

{{-- Modal --}}
<!-- Main modal -->
<div id="crud-surat" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Surat
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-surat">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Surat</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5" placeholder="Masukkan Nama surat..." required="">
                    </div>
                    <div class="col-span-2">
                        <label for="file_surat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Surat</label>
                        <input type="file" id="file_surat" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500" placeholder="Upload File Surat Disini"></input>                    
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Tambah surat
                </button>
            </form>
        </div>
    </div>
</div> 

{{-- End Modal --}}


{{-- Start Macam bantuan sosial --}}
<div class="p-5 mx-auto h-screen bg-white/50 border-t-2 border-teal-400 cursor-default overflow-y-auto custom-scrollbar">
  @foreach (range(1, 15) as $i)
  <div class="p-4 mb-5 bg-neutral-50 flex justify-between shadow-md rounded-md" data-title="Surat {{ $i }}" id="suratList{{$i}}">
      <div class="flex-col">
          <h1>Surat {{ $i }}</h1>
          <p class="text-xs">Surat {{ $i }} digunakan untuk kegiatan {{$i}}</p>
      </div>
      {{-- Button detail bansos --}}
      <a href="bansos/detail">
          <button class="p-2 text-xs text-gray-700 rounded-lg bg-gray-400/30 hover:text-teal-900/80 hover:bg-teal-500/30 transition duration-200 ease-in-out">Lihat Detail <i class="fad fa-info-circle"></i></button>
      </a>
      {{-- End button detail bansos --}}
  </div>
  @endforeach
  {{-- Pesan ketika tidak ada hasil pencarian --}}
  <div class="p-4 mb-5 bg-neutral-50 flex justify-center shadow-md rounded-md hidden" id="noResults">
      <div class="flex-col text-center">
          <h1 class="text-xl font-bold text-gray-600">No Results Found</h1>
          <p class="text-xs text-gray-500">Tidak ada hasil yang sesuai dengan pencarian Anda.</p>
      </div>
  </div>
</div>
{{-- End Macam bantuan sosial --}}

@push('js')
<script>
  // Script searching
  document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchInput');
      const noResults = document.getElementById('noResults');

      searchInput.addEventListener('input', function() {
          const query = searchInput.value.toLowerCase();
          let hasResults = false;
          @foreach (range(1, 15) as $i)
              const suratList{{$i}} = document.getElementById('suratList{{$i}}');
              const title{{$i}} = suratList{{$i}}.getAttribute('data-title').toLowerCase();
              if (title{{$i}}.includes(query)) {
                  suratList{{$i}}.style.display = 'flex';
                  hasResults = true;
              } else {
                  suratList{{$i}}.style.display = 'none';
              }
          @endforeach

          if (hasResults) {
              noResults.classList.add('hidden');
          } else {
              noResults.classList.remove('hidden');
          }
      });
  });
</script>
@endpush
