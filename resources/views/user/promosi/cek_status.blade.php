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
              Promosi
          </h1>
          <p>
            Daftarkan usaha Anda untuk mendapatkan kesempatan promosi produk dan layanan di komunitas kami. Bersama, kita bisa memperkuat perekonomian lokal.
          </p>
      </div>
    </div>
  </section>
  <!-- end Common hero -->

{{-- promosi Form --}}
<section class="section pt-0">
    <div class="container">
        <form class="px-0 lg:px-60" action="{{ route('user.cekStatusPengajuan') }}" method="POST" enctype="multipart/form-data">
            @if (session('status_pengajuan'))
                <div class="alert alert-info">
                    {{ session('status_pengajuan') }}
                </div>
            @endif

            @csrf

            <div class="form-group mb-5">
                <label class="form-label mt-3" for="nik">NIK</label>
                <input
                class="form-control"
                type="number"
                id="nik"
                name="nik"
                placeholder="Masukkan NIK"
                value="{{ old('nik') }}"
                />
                <div id="nikError" class="hidden col-span-4 text-red-500 text-xs mt-4">NIK harus diisi dengan 16 karakter</div>
                @error('nik')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('user.promosi') }}" class="text-inherit"><button type="button" class="btn btn-outline-primary block">Kembali</button></a>
                <button type="submit" class="btn btn-primary block" id="verifikasiButton">Verifikasi</button>
            </div>
            
        </form>
    </div>
</section>
{{-- end promosi Form --}}

@push('js')
<script>
// Script tulisan merah dibawah inputan
document.getElementById('nik').addEventListener('input', function() {
    var nikInput = this.value;
    var nikError = document.getElementById('nikError');

    if (nikInput.length !== 16) {
        nikError.classList.remove('hidden');
    } else {
        nikError.classList.add('hidden');
    }
});
</script>
@endpush

@include('layout.footer')
