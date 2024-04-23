@include('base.start')

@include('base.navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
    <div class="flex-grow bg-white">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">Membuat Daftar User</h1>
        </div>
        <form class="pb-10 mt-10 ml-5 max-w-xl " action="" method="POST">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="nama" id="nama" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                <label for="nama" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Nama</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="nik" id="nik" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                <label for="nik" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">NIK</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                <label for="tempat_lahir" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Tempat lahir</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                <label for="tanggal_lahir" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Tanggal lahir</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="agama" id="agama" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                <label for="agama" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Agama</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="pekerjaan" id="pekerjaan" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" "  />
                <label for="pekerjaan" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Pekerjaan</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="telfon" id="telfon" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                <label for="telfon" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">No telpon</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="gol_darah" id="gol_darah" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                <label for="gol_darah" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Golongan darah</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="rt" id="rt" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required/>
                <label for="rt" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Rt</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="rw" id="rw" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required/>
                <label for="rw" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Rw</label>
            </div>
            <!-- Other form inputs here -->
            <div class="flex justify-between">
                <a href="{{ route('warga') }}" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-400 mr-2">Kembali</a>
                <button type="submit" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Submit</button>
            </div>
        </form>
    </div>
</div>

@include('base.end')
