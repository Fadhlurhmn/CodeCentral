@include('layout.start')
@include('layout.u_navbar')

<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
@include('layout.u_sidebar')

{{-- Start content --}}
<div class="bg-white w-screen flex-1 mt-20 md:mt-16"> 
    {{-- Judul --}}
    <div class="w-screen bg-gray-200 p-10 md:p-6 md:mt-5">
        <h1 class="uppercase text-center text-xl md:text-sm md:font-bold font-extrabold">UMKM Warga</h1>
    </div>
    {{-- End judul --}}


    {{-- Start isi umkm --}}
    <div class="w-auto p-6 gap-6 grid grid-cols-4 md:grid-cols-2 overflow-y-auto">
        @for ($i = 0; $i < 7; $i++)
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                <div class="flex-grow">
                    <img class="w-auto h-auto object-cover rounded-t-lg" 
                        src="{{ asset('https://images.unsplash.com/photo-1696385793104-745d4dd65c5a?q=80&w=2074&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') }}" 
                        alt="">
                </div>
                <div class="flex flex-col justify-between p-4 leading-normal w-full">
                    <h5 class="mb-2 text-left text-lg font-bold tracking-tight text-gray-900 md:text-sm">Sate pak ahmadi</h5>
                    <p class="text-left mb-2 text-gray-700 md:text-xs"><i class="far fa-store mr-2"></i>Jl. Merah Bata No.3</p>
                    <p class="text-left mb-2 text-gray-700 md:text-xs"><i class="far fa-usd-circle mr-3"></i>Rp 15.000</p>
                </div>
            </div>
        @endfor
    </div>    
    {{-- End isi umkm --}}
</div>
{{-- End content --}}


</div>
@include('layout.end')