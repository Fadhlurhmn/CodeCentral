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
              <p class="text-xl text-center font-bold text-gray-600">Tidak ada Bansos yang Tersedia</p>
          @else
          
            <div class="flex justify-end px-0 lg:px-60">
              <div class="w-full"></div>
              <select name="list_penerima" id="list_penerima" class="form-select max-w-fit mb-4">
                @foreach ($histori as $index => $penerimaanGroup)
                    <option value="table-bansos-{{ $loop->iteration }}">{{ $index }}</option>
                @endforeach
              </select>
            </div>
              
            @foreach ($histori as $index => $penerimaanGroup)
                <div id="table-bansos-{{ $loop->iteration }}" class="{{ $loop->first ? '' : 'hidden' }} px-0 lg:px-60">
                    <h2 class="h4 mb-2">Daftar Penerima Bansos {{ $index }}</h2>
                    <p class="mb-4">Tanggal Pembagian Bansos: {{ $penerimaanGroup->first()->tanggal_pemberian }}</p>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-white bg-primary uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penerimaanGroup as $item)
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</th>
                                        <td class="px-6 py-4">{{ $item->nama_kepala_keluarga }}</td>
                                        <td class="px-6 py-4">{{ $item->alamat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
          @endif
      </div>
  </div>
</section>
{{-- end Bansos Form --}}

@push('js')
    
<script>
  document.getElementById('list_penerima').addEventListener('change', function() {
      var selectedValue = this.value;
      document.querySelectorAll('[id^="table-bansos-"]').forEach(function(table) {
          if (table.id === selectedValue) {
              table.classList.remove('hidden');
          } else {
              table.classList.add('hidden');
          }
      });
  });
</script>
@endpush

@include('layout.footer')
