@include('base.start')

@include('base.navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">Edit Data Warga</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">

            {{-- @empty($user) --}}
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{route('warga')}}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            {{-- @else --}}
            <form class="pb-10 mt-10 ml-5 max-w-xl " action="" method="POST">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="nama" id="nama" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Nama Sebelumnya" required />
                    <label for="nama" ></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="nik" id="nik" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="NIK Sebelumnya" required />
                    <label for="nik"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Tempat Lahir" required />
                    <label for="tempat_lahir"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Tanggal Lahir sebelumnya" required />
                    <label for="tanggal_lahir"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="agama" id="agama" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Agama" required />
                    <label for="agama"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="pekerjaan" id="pekerjaan" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Pekerjaan"  />
                    <label for="pekerjaan"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="telfon" id="telfon" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Telp" required />
                    <label for="telfon"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="gol_darah" id="gol_darah" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Goldar" required />
                    <label for="gol_darah"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="rt" id="rt" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Rt.." required/>
                    <label for="rt"></label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="rw" id="rw" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder="Rw.." required/>
                    <label for="rw"></label>
                </div>
                <!-- Other form inputs here -->
                <div class="flex justify-between">
                    <a href="{{ route('warga') }}" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-400 mr-2">Batal</a>
                    <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Simpan</button>
                </div>
            </form>
            {{-- @endempty --}}
        </div>
    </div>
</div>

@include('base.end')
