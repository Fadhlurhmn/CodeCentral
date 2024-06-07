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
            Bansos
        </h1>
        <p>
            Anda dapat menemukan informasi terkini mengenai program bantuan sosial yang tersedia bagi warga. Temukan detail tentang berbagai jenis bantuan, syarat dan cara pengajuan, serta jadwal distribusi bantuan sosial.
        </p>
    </div>
  </div>
</section>
<!-- end Common hero -->

{{-- Bansos Form --}}
<section class="section pt-0">
    <div class="container">
      <div class="col-12 md:order-1">
        @if ($histori->isEmpty())
          <h2 class="h4 mb-4 px-0 lg:px-60">Data belum tersedia</h2>
        @else
          <h2 class="h4 mb-4 px-0 lg:px-60">Daftar Penerima Bansos {{$histori[0]->nama_bansos}}</h2>
          <div class="relative overflow-x-auto px-0 lg:px-60">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                  <thead class="text-xs text-white bg-primary uppercase">
                      <tr>
                          <th scope="col" class="px-6 py-3">
                              No
                          </th>
                          <th scope="col" class="px-6 py-3">
                              Nama
                          </th>
                          <th scope="col" class="px-6 py-3">
                              Alamat
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($histori as $index => $penerimaan)
                      <tr class="bg-white border-b">
                          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                              {{ $index + 1 }}
                          </th>
                          <td class="px-6 py-4">
                              {{ $penerimaan->nama_kepala_keluarga }}
                          </td>
                          <td class="px-6 py-4">
                              {{ $penerimaan->alamat }}
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
        @endif
      </div>
    </div>
</section>
{{-- end Bansos Form --}}

@include('layout.footer')
