@include('layout.start')

@include('layout.a_navbar')

<!-- start wrapper -->
<div class="h-screen flex flex-row flex-wrap">

  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-white flex-1 p-5 md:mt-16 cursor-default border-t-2 border-teal-500">
    @include('layout.breadcrumb2')

    {{-- Alert ketika data tidak ditemukan --}}
    @if(!$promosi)
    <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
        <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
        <p>Data yang Anda cari tidak ditemukan</p>
        <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/promosi') }}';">
            close <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @else
    {{-- End bagian alert data --}}

    {{-- Start Show --}}
    <div class="relative flex my-5 bg-white rounded-lg border py-3 shadow-md">
      {{-- Category pill --}}
      <div class="absolute top-0 right-0 mt-3 mr-3 bg-teal-500 text-white text-sm font-medium px-3 py-1 rounded-full">
          {{$promosi->kategori}}
      </div>

        <div class="w-1/2 px-4 my-7 flex justify-start">
            <img src="{{ asset('storage/'. $promosi->gambar) }}" alt="{{ $promosi->nama_usaha }}""
            class="w-full h-96 rounded-md object-cover">
        </div>
      <dl class="my-3 text-sm w-1/2">
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
            <dt class="font-medium text-base text-gray-900">NIK Pemilik usaha</dt>
            <dd class="text-gray-700 sm:col-span-2">{{$nik}}</dd>
        </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Nama Usaha</dt>
              <dd class="text-gray-700 sm:col-span-2">{{$promosi->nama_usaha}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Deskripsi</dt>
              <dd class="text-gray-700 sm:col-span-2">{{$promosi->deskripsi}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
            <dt class="font-medium text-base text-gray-900">Kontak Pemilik</dt>
            <dd class="text-gray-700 sm:col-span-2">{{$promosi->no_telp}}</dd>
        </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Alamat Usaha</dt>
              <dd class="text-gray-700 sm:col-span-2">{{$promosi->alamat}}</dd>
          </div>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
              <dt class="font-medium text-base text-gray-900">Status Pengajuan</dt>
              {{-- Filter status_pengajuan --}}
              @php
              $bgColor = '';
              switch($promosi->status_pengajuan) {
                  case 'Tolak':
                      $bgColor = 'bg-red-600/60 text-red-800';
                      break;
                  case 'Menunggu':
                      $bgColor = 'bg-yellow-600/60 text-yellow-800';
                      break;
                  case 'Terima':
                      $bgColor = 'bg-teal-600/60 text-teal-800';
                      break;
                  default:
                      $bgColor = 'bg-gray-600/60'; // Warna default jika tidak cocok dengan kondisi di atas
                      break;
              }
              @endphp
              {{-- End filter status_pengajuan --}}
              <dd class="w-20 px-2 text-center {{ $bgColor }} sm:col-span-2 rounded-full inline-block">{{$promosi->status_pengajuan}}</dd>
          </div>

          @if($promosi->status_pengajuan === 'Menunggu')
            <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                <div class="sm:col-span-3 flex space-x-2">
                    <form action="{{ url('admin/promosi/' . $promosi->id_promosi . '/show/update-status') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status_pengajuan" value="Tolak"> <!-- Tambahkan input tersembunyi untuk nilai status_pengajuan -->
                        <button type="submit" class="bg-red-500 text-red-800 text-center hover:bg-red-600 hover:text-white transition duration-300 ease-in-out text-sm font-medium px-3 py-1 rounded">Tolak</button>
                    </form>
                    <form action="{{ url('admin/promosi/' . $promosi->id_promosi . '/show/update-status') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status_pengajuan" value="Terima"> <!-- Tambahkan input tersembunyi untuk nilai status_pengajuan -->
                        <button type="submit" class="bg-teal-500 text-teal-800 text-center hover:bg-teal-600 hover:text-white transition duration-300 ease-in-out text-sm font-medium px-3 py-1 rounded">Terima</button>
                    </form>
                </div>
            </div>
          @elseif($promosi->status_pengajuan === 'Terima')
            <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                <form id="delete-promosi-form" action="{{ url('admin/promosi/' . $promosi->id_promosi . '/delete') }}" method="POST" class="sm:col-span-2">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="delete-promosi-button" class="bg-red-500 text-red-800 text-center hover:bg-red-600 hover:text-white transition duration-300 ease-in-out text-sm font-medium px-3 py-1 rounded">Hapus</button>
                </form>
            </div>
          @endif
      </dl>
  </div>

      @if($promosi->status_pengajuan === 'Menunggu')
      <a href="{{ url('admin/promosi/daftar') }}" class="shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-caret-left"></i> Kembali</a>
      @else
      <a href="{{ url('admin/promosi/') }}" class="shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-caret-left"></i> Kembali</a>

      @endif
    @endif

    <!-- end content -->
  </div>
  <!-- end wrapper -->

@include('layout.end')

<script>
    document.getElementById('delete-promosi-button').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus promosi ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, hapus!',
            confirmButtonColor: '#38b2ac',
            cancelButtonColor: '#d33',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-promosi-form').submit();
            }
        });
    });
</script>
