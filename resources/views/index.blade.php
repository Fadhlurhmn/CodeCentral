@include('layout.start')


@include('layout.u_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.u_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 
    
    {{-- Place your code here --}}
    {{-- <div class="text-lg">Ini adalah Landing Page</div>
    <div class="text-lg mb-2">Saat ini pengembangan sedang pada tahap tampilan admin</div>    
    <div class="text-lg">Credential</div>
    <div class="text-lg">Username : Admin</div>
    <div class="text-lg">Password : 12345</div> --}}

    <div class="carousel">
      <div class="slide"><img src="{{ asset('img/kopi.jpg') }}" alt="no"></div>
      <div class="slide"><img src="{{ asset('img/logo.png') }}" alt="yes"></div>
    </div>
    <button class="next-btn">Next</button>
<button class="prev-btn">Prev</button>

</div>
@push('js')
{{-- carousel --}}
<script>
  $(document).ready(function() {
  const carousel = $(".carousel");
    const slides = $(".slide");
    const nextButton = $(".next-btn");
    const prevButton = $(".prev-btn");
    let currentIndex = 0;

    function showSlide(index) {
        if (index < 0) {
            currentIndex = slides.length - 1;
        } else if (index >= slides.length) {
            currentIndex = 0;
        }

        carousel.css("transform", `translateX(-${currentIndex * 100}%)`);
    }

    if (nextButton.length && $prevButton.length) {
        nextButton.click(function() {
            currentIndex++;
            showSlide(currentIndex);
        });

        $prevButton.click(function() {
            currentIndex--;
            showSlide(currentIndex);
        });
    }

 const autoAdvanceInterval = 3000; // Change slide every 3 seconds

    setInterval(function() {
        currentIndex++;
        showSlide(currentIndex);
    }, autoAdvanceInterval);
});

</script>
@endpush
<!-- end wrapper -->

@include('layout.end')
