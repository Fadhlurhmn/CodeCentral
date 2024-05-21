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
  <h1 class="my-2 text-2xl font-extrabold text-gray-600">{{$page->title}}</h1>
  {{-- <h1 class="my-2 text-2xl font-extrabold text-gray-600">Daftar Surat</h1> --}}
  @if (session('success'))
        <div class="col-span-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
  @endif
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
      {{-- <a class="p-2 mr-5 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg" href="{{url('#')}}">Tambah Surat</a> --}}
      <button id="addSuratBtn" class="p-2 mr-5 font-normal text-center shadow-sm bg-teal-300 hover:bg-teal-500 text-teal-700 hover:text-gray-700 transition duration-300 ease-in-out rounded-lg">
        Tambah Surat
      </button>
      <form action="javascript:void(0);" method="GET" class="text-sm font-medium ml-auto" id="searchForm">
          <input type="text" id="searchInput" name="query" placeholder="Cari Surat..." class="px-4 py-2 border border-gray-500 rounded-md text-xs">
      </form>
  </div>
  {{-- End Search --}}

</div>
{{-- End Kotak konten atas (Judul,Card & Search) --}}

<!-- Modal -->
<div id="modal" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center opacity-0 pointer-events-none animated duration-200 ease-in-out">
  <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  
  <div class="modal-container bg-white w-2/5 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      <div class="modal-content py-4 text-left px-6">
          <div class="flex mb-3 justify-between items-center border-b-2 border-teal-500 pb-3">
              <p class="text-xl text-gray-900 font-bold">Tambah Surat</p>
              <div class="modal-close cursor-pointer z-50">
                  <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 3.47a.75.75 0 00-1.06 0L9 7.94 4.53 3.47a.75.75 0 10-1.06 1.06L7.94 9 3.47 13.47a.75.75 0 101.06 1.06L9 10.06l4.47 4.47a.75.75 0 101.06-1.06L10.06 9l4.47-4.47a.75.75 0 000-1.06z"></path>
                  </svg>
              </div>
          </div>

          <form id="formSurat" action="{{url('admin/surat/')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 text-sm">
              <label class="block text-gray-700 text-sm mb-2" for="namaSurat">Nama Surat</label>
              <input type="text" id="nama_surat" name="nama_surat" class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nama Surat..." required>
            </div>
            
            <div class="mb-4 text-sm">
              <label class="block text-gray-700 text-sm mb-2" for="namaSurat">Deskripsi Surat</label>
              <input type="text" id="deskripsi" name="deskripsi" class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Deskripsi Surat..." required>
            </div>
          
            <div class="mb-4 text-sm">
              <label class="block text-gray-700 text-sm mb-2" for="fileSurat">Upload File word</label>
              <input type="file" id="berkas" name="berkas" accept=".docx" class="file:bg-teal-400 file:border-0 file:rounded-full shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Upload file..." required>
            </div>
            
            <div class="flex justify-start pt-2">
              {{-- <button class="modal-close bg-red-600 hover:bg-red-700 rounded-full text-white py-2 px-4 mr-2">Batal</button> --}}
              <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto text-center py-2 px-4 transition duration-200 ease-in-out"><i class="far fa-plus"></i>  Simpan</button>
            </div>
          </form>
      </div>
  </div>
</div>



{{-- Start Macam bantuan sosial --}}
<div class="p-5 mx-auto h-screen bg-white/50 border-t-2 border-teal-400 cursor-default overflow-y-auto custom-scrollbar">
  @foreach($surat as $item)
  <div class="p-4 mb-5 bg-neutral-50 flex justify-between shadow-md rounded-md" data-title="Surat {{ $item->nama_surat }}" id="suratList{{$item->id_surat}}">
      <div class="flex-col">
          <h1>Surat {{ $item->nama_surat }}</h1>
          <p class="text-xs">{{$item->id_surat}}</p>
          <p class="text-xs">{{$item->deskripsi}}</p>
      </div>
      <div class="flex space-x-2">
          <a href="surat/detail/{{$item->id_surat}}">
              <button class="px-4 py-3 text-sm text-white rounded-lg bg-yellow-500 hover:text-white hover:bg-yellow-600 transition duration-200 ease-in-out"><i class="fas fa-edit"></i></button>
          </a>
          <button class="px-4 py-3 text-sm text-white rounded-lg bg-red-600 hover:text-white hover:bg-red-700 transition duration-200 ease-in-out"><i class="fas fa-trash"></i></button>
      </div>
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
</div>
@push('js')

<script>
  // Script searching
  document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchInput');
      const noResults = document.getElementById('noResults');
      const suratList = document.querySelectorAll('[id^="suratList"]'); // Mengambil semua elemen dengan ID yang dimulai dengan "suratList"

      searchInput.addEventListener('input', function() {
          const query = searchInput.value.toLowerCase();
          let hasResults = false;

          suratList.forEach(function(element) {
              const namaSurat = element.getAttribute('data-title').toLowerCase();
              if (namaSurat.includes(query)) {
                  element.style.display = 'flex';
                  hasResults = true;
              } else {
                  element.style.display = 'none';
              }
          });

          if (hasResults) {
              noResults.classList.add('hidden');
          } else {
              noResults.classList.remove('hidden');
          }
      });
  });
</script>


<script>
  // Function to open the add surat modal
  const openModal = () => {
    const modal = document.getElementById('modal');
    modal.classList.remove('opacity-0');
    modal.classList.add('opacity-100');
    modal.classList.remove('pointer-events-none');
    document.body.classList.add('modal-active');
  }

  // Function to open the edit surat modal
  const openEditModal = (id) => {
    const modal = document.getElementById('modal');
    const form = document.getElementById('formSurat');
    const surat = document.getElementById('suratList' + id);

    document.getElementById('nama_surat').value = surat.querySelector('.nama_surat').innerText;
    document.getElementById('deskripsi').value = surat.querySelector('.deskripsi').innerText;
    // Set form action for editing
    form.action = "{{url('admin/surat')}}" + '/' + id;
    
    modal.classList.remove('opacity-0');
    modal.classList.add('opacity-100');
    modal.classList.remove('pointer-events-none');
    document.body.classList.add('modal-active');
  }

  // Function to close the modal
  const closeModal = () => {
    const modal = document.getElementById('modal');
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');
    modal.classList.add('pointer-events-none');
    document.body.classList.remove('modal-active');
  }

  // Event listener to open the add surat modal
  document.getElementById('addSuratBtn').addEventListener('click', openModal);

  // Event listener to close the modal when clicking on close buttons
  document.querySelectorAll('.modal-close').forEach(el => {
    el.addEventListener('click', closeModal);
  });

  // Event listener to close the modal when clicking outside the modal
  document.getElementById('modal').addEventListener('click', e => {
    if (e.target == e.currentTarget) closeModal();
  });
</script>


@endpush
