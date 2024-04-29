@include('base.start')

@include('base.navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('base.sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">

            <form class="px-10 py-10 min-w-full bg-white gap-x-20 gap-y-2 grid grid-cols-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('keluarga') }}" method="POST">
                <h1 class="p-5 mb-5 font-semibold text-left rtl:text-right text-gray-900 bg-teal-400 col-span-2 rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                <div class="relative z-0 w-full mb-5 group my-2 font-bold col-span-2">
                    <input type="text" name="nomor_keluarga" id="nomor_keluarga" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                    <label for="nomor_keluarga" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Nomor Keluarga</label>
                </div>
                <div class="relative z-0 w-full mb-5 group my-2 font-bold col-span-2">
                    <input type="number" name="jumlah_orang_kerja" id="jumlah_orang_kerja" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                    <label for="jumlah_orang_kerja" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Jumlah Orang Kerja</label>
                </div>
                <div class="relative z-0 w-full mb-5 group my-2 font-bold col-span-2">
                    <input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                    <label for="jumlah_tanggungan" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah Tanggungan</label>
                </div>
                <div class="relative z-0 w-full mb-5 group my-2 font-bold col-span-2">
                    <input type="number" name="jumlah_kendaraan" id="jumlah_kendaraan" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required/>
                    <label for="jumlah_kendaraan" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Jumlah Kendaraan</label>
                </div>
                <div class="relative z-0 w-full mb-5 group my-2 font-bold col-span-2">
                    <input type="number" step="any" name="luas_tanah" id="luas_tanah" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required/>
                    <label for="luas_tanah" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Luas Tanah</label>
                </div>
                <br>
                <!-- Other form inputs here -->
                <div class="flex justify-between">
                    <a href="{{ url('keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('base.end')
