@include('layout.head')
@include('layout.u_navbar')
<!-- floating assets -->
<img
  class="floating-bubble-1 absolute right-0 top-0 -z-[1]"
  src="{{ asset('images/floating-bubble-1.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]"
  src="{{ asset('images/floating-bubble-2.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]"
  src="{{ asset('images/floating-bubble-3.svg') }}"
  alt=""
/>
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero pt-16 pb-14">
    <div class="container">
      <div class="page-hero-content mx-auto max-w-[768px] text-center">
          <h1 class="mb-5 mt-8">
              Struktur Pengurus
          </h1>
          <p>
            Susunan Kepengurusan RW 4 dan RT Tlogomas.
          </p>
      </div>
    </div>
  </section>
  <!-- end Common hero -->

<section class="section pt-0">
  <div class="container">

    <div class="flex flex-col">
        <div class="flex mb-4 justify-center">
            <div class="relative py-2 px-2 border-gray-200 shadow-md rounded-lg mb-2 lg:py-4 lg:px-4">
                <div class="text-base w-full text-center">
                    <div class="aspect-square mx-auto w-28 mb-2 border-b border-gray-200 lg:w-32">
                        <img src="{{ asset('img/rw.jpg') }}" alt="" class="object-cover w-full h-full rounded-full">
                    </div>
                    
                    <div class="text-md text-black font-semibold truncate lg:text-xl">
                        Ketua RW
                    </div>

                    <div class="text-base lg:text-lg">
                        Subiyanto
                    </div>
                </div>
            </div> 
        </div>
        <div class="flex flex-wrap flex-row justify-center">
            <div class="relative py-2 px-2 border-gray-200 shadow-md rounded-lg mx-5 mb-2 lg:py-4 lg:px-4">
                <div class="text-base w-full text-center">
                    <div class="aspect-square mx-auto w-28 mb-2 border-b border-gray-200 lg:w-32">
                        <img src="{{ asset('img/rt1.jpg') }}" alt="" class="object-cover w-full h-full rounded-full">
                    </div>
                    
                    <div class="text-md text-black font-semibold truncate lg:text-xl">
                        Ketua RT 1
                    </div>

                    <div class="text-base lg:text-lg">
                        Andi Abdillah
                    </div>
                </div>
            </div> 
            <div class="relative py-2 px-2 border-gray-200 shadow-md rounded-lg mx-5 mb-2 lg:py-4 lg:px-4">
                <div class="text-base w-full text-center">
                    <div class="aspect-square mx-auto w-28 mb-2 border-b border-gray-200 lg:w-32">
                        <img src="{{ asset('img/rt2.jpg') }}" alt="" class="object-cover w-full h-full rounded-full">
                    </div>
                    
                    <div class="text-md text-black font-semibold truncate lg:text-xl">
                        Ketua RT 2
                    </div>

                    <div class="text-base lg:text-lg">
                        Hary Suswanto
                    </div>
                </div>
            </div> 
            <div class="relative py-2 px-2 border-gray-200 shadow-md rounded-lg mx-5 mb-2 lg:py-4 lg:px-4">
                <div class="text-base w-full text-center">
                    <div class="aspect-square mx-auto w-28 mb-2 border-b border-gray-200 lg:w-32">
                        <img src="{{ asset('img/rt3.jpg') }}" alt="" class="object-cover w-full h-full rounded-full">
                    </div>
                    
                    <div class="text-md text-black font-semibold truncate lg:text-xl">
                        Ketua RT 3
                    </div>

                    <div class="text-base lg:text-lg">
                        Amelia Iradany
                    </div>
                </div>
            </div> 
            <div class="relative py-2 px-2 border-gray-200 shadow-md rounded-lg mx-5 mb-2 lg:py-4 lg:px-4">
                <div class="text-base w-full text-center">
                    <div class="aspect-square mx-auto w-28 mb-2 border-b border-gray-200 lg:w-32">
                        <img src="{{ asset('img/rt4.jpg') }}" alt="" class="object-cover w-full h-full rounded-full">
                    </div>
                    
                    <div class="text-md text-black font-semibold truncate lg:text-xl">
                        Ketua RT 4
                    </div>

                    <div class="text-base lg:text-lg">
                        Hakun Elmunsyah
                    </div>
                </div>
            </div> 
        </div>
  </div>
</section>

@include('layout.footer')

