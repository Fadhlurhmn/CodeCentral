@include('layout.head')
@include('layout.header')
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

<!-- blog single -->
<section class="section blog-single">
  <div class="container">
    <div class="row justify-center">
      <div class="lg:col-10">
        <img class="rounded-xl" src="{{ asset('images/blog-single.png') }}" alt="" />
      </div>
      <div class="mt-10 max-w-[810px] lg:col-9">
        <h1 class="h2">
          Memo To All Housekeeping, Kitchen, & Dining Room Staff At Mar-A-Lago
        </h1>
        <div class="mt-6 mb-5 flex items-center space-x-2">
          <div
            class="blog-author-avatar h-[58px] w-[58px] rounded-full border-2 border-primary p-0.5"
          >
            <img src="{{ asset('images/blog-author.png') }}" alt="" />
          </div>
          <div class="">
            <p class="text-dark">Cameron Williamson</p>
            <span class="text-sm">Nov 28, 2019. 5 Min read</span>
          </div>
        </div>

        <div class="content">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec et
            ipsum ullamcorper venenatis fringilla. Pretium, purus eu nec
            vulputate vel habitant egestas. Congue ornare at ipsum, viverra.
            Vitae magna faucibus eros, lectus sociis. Etiam nunc amet id
            dignissim. Feugiat id tempor vel sit in ornare turpis posuere. Eu
            quisque integer non rhoncus elementum vel. Quis nec viverra lectus
            augue nec praesent Laoreet mauris odio ut nec. Nisl, sed adipiscing
            dignissim arcu placerat ornare pharetra nec in. Ultrices in nisl
            potenti vitae tempus. Auctor consectetur luctus eu in amet sagittis.
            Dis urna, vel hendrerit convallis Senectus feugiat faucibus commodo
            egestas leo vitae in morbi. Enim arcu dignissim mauris, eu, eget
          </p>

          <p>
            pharetra odio amet pellentesque. Egestas nisi adipiscing sed in
            lectus. Vitae ultrices malesuada aliquet Faucibus consectetur tempus
            adipiscing vitae. Nec blandit tincidunt nibh nisi, quam volutpat. In
            lacus laoreet diam risus. Mauris, risus faucibus sagittis sagittis
            tincidunt id justo. Diam massa pretium consequat mauris viverra.
            Sagittis eu libero
          </p>

          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nec et
            ipsum ullamcorper venenatis fringilla. Pretium, purus eu nec
            vulputate vel habitant egestas. Congue ornare at ipsum, viverra.
            Vitae magna faucibus eros, lectus sociis. Etiam nunc amet id
            dignissim. Feugiat id tempor vel sit in ornare turpis posuere. Eu
            quisque integer non rhoncus elementum vel. Quis nec viverra lectus
            augue nec praesent volutpat tortor. Ipsum eget sed tempus luctus
            nisl. Ut etiam molestie mattis at faucibus mi at pellentesque.
            Pellentesque morbi nunc, curabitur arcu euismod suscipit. Duis mi
            sapien, nisl, pulvinar donec non dictum
          </p>

          <p>
            Laoreet mauris odio ut nec. Nisl, sed adipiscing dignissim arcu
            placerat ornare pharetra nec in. Ultrices in nisl potenti vitae
            tempus. Auctor consectetur luctus eu in amet sagittis. Dis urna, vel
            hendrerit convallis cursus id. Senectus feugiat faucibus commodo
            egestas leo vitae in morbi. Enim arcu dignissim mauris, eu, eget
            pharetra odio amet pellentesque. Egestas nisi adipiscing sed in
            lectus. Vitae ultrices malesuada aliquet dignissim. Faucibus non
            tristique eu.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ./end blog-single -->
@include('layout.footer')
@include('layout.foot')

