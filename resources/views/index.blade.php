@include('layout.start')


@include('layout.u_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.u_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 
    
    {{-- Place your code here --}}
    <div class="text-lg">Ini adalah Landing Page</div>
    <div class="text-lg mb-2">Saat ini pengembangan sedang pada tahap tampilan admin</div>    
    <div class="text-lg">Credential</div>
    <div class="text-lg">Username : Admin</div>
    <div class="text-lg">Password : 12345</div>


    {{-- Carousel deprecrated --}}
    {{-- <div class="relative bg-gray-100">
        <div class="overflow-hidden carousel">
          <div class="flex transition-transform carousel-inner">
            <div class="flex">
              <img src="{{ asset('img/food.svg') }}" alt="Slide 1">
            </div>
            <div class="flex">
              <img src="{{ asset('img/soccer.svg') }}" alt="Slide 2">
            </div>
            <div class="flex">
              <img src="{{ asset('img/user.svg') }}" alt="Slide 3">
            </div>
          </div>
          <button class="absolute top-1/2 translate-y-1/2 bg-none border-none cursor-pointer text-3xl z-10 left-3 prev">&lt;</button>
          <button class="absolute top-1/2 translate-y-1/2 bg-none border-none cursor-pointer text-3xl z-10 right-3 next">&gt;</button>
        </div>
      </div>
    </div> --}}
  <!-- end content -->

</div>
@push('js')
{{-- carousel --}}
{{-- <script>
    const carousel = document.querySelector('.carousel');
    const inner = document.querySelector('.carousel-inner');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
  
    let currentIndex = 0;
  
    function updateCarousel() {
      inner.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
  
    prevBtn.addEventListener('click', () => {
      currentIndex = Math.max(currentIndex - 1, 0);
      updateCarousel();
    });
  
    nextBtn.addEventListener('click', () => {
      currentIndex = Math.min(currentIndex + 1, inner.children.length - 1);
      updateCarousel();
    });
  </script> --}}
  
@endpush
<!-- end wrapper -->

@include('layout.end')
