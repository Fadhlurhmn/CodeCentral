@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow">

            <form class="px-10 py-10 min-w-full bg-white gap-x-20 gap-y-2 grid grid-cols-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('akun') }}" method="POST">
                <h1 class="px-5 pt-12 pb-5 mb-5 font-semibold text-center rtl:text-right text-gray-900 bg-teal-400 col-span-full rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                                {{-- Username --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="username" class="block mb-2 text-sm font-bold text-gray-900">Username</label>
                    <input type="text" name="username" id="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Username" required />
                </div>
                                {{-- Password --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="password" class="block mb-2 text-sm font-bold text-gray-900">Password</label>
                    <input type="text" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Password" required />
                </div>
                {{-- Level --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="level" class="block mb-2 text-sm font-bold text-gray-900">Jabatan</label>
                    <input type="number" name="level" id="level" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Jabatan Anda" required />
                </div>
                {{-- Nomor Kawasan --}}
                <div class="relative py-10 px-5 w-full bg-slate-200 mb-5 group font-bold rounded-xl col-span-2">
                    <label for="nomor_kawasan" class="block mb-2 text-sm font-bold text-gray-900">Nomor Kawasan</label>
                    <input type="number" name="nomor_kawasan" id="nomor_kawasan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 " placeholder="Masukkan Kawasan Anda Menjabat" required />
                </div>
                {{-- Status Akun --}}
                <div class="relative z-0 w-full mb-5 group font-bold col-span-4">
                    {{-- <input type="text" name="status_akun" id="status_akun" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required/> --}}
                    <select name="status_data" id="status_data" class="block py-2.5 px-2.5 w-full text-sm text-black bg-slate-300/30 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer rounded-full hover:bg-teal-100 focus:bg-teal-100">
                        <option value="Aktif" selected>Aktif</option>
                        <option value="Tidak aktif">Tidak aktif</option>
                    </select>
                    <label for="status_akun" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Status Akun</label>
                </div>
                <br>
                <!-- Other form inputs here -->
                <div class="flex justify-between">
                    <a href="{{ url('akun') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')
<script>
    document.getElementById("nomor_keluarga").addEventListener("input", function() {
        var input = this.value.trim();
        var isValid = /^\d{10}$/.test(input);
        var errorMessage = document.getElementById("nomor_keluarga_help");

        if (isValid) {
            errorMessage.classList.add("hidden");
        } else {
            errorMessage.classList.remove("hidden");
        }
    });
</script>
