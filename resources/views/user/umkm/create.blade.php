@include('layout.head')
@include('layout.u_navbar')
<!-- floating assets -->
<img
  class="floating-bubble-1 absolute right-0 top-0 -z-[1]"
  src="images/floating-bubble-1.svg"
  alt=""
/>
<img
  class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]"
  src="images/floating-bubble-2.svg"
  alt=""
/>
<img
  class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]"
  src="images/floating-bubble-3.svg"
  alt=""
/>
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero pt-16 pb-14">
    <div class="container">
      <div class="page-hero-content mx-auto max-w-[768px] text-center">
          <h1 class="mb-5 mt-8">
              UMKM
          </h1>
          <p>
            Selamat datang di halaman UMKM <span class="font-bold">RW 3 Tlogomas.</span> 
            <br>Di sini, Anda dapat menemukan berbagai produk dan layanan unggulan dari pelaku UMKM di lingkungan kami. Dukung usaha lokal untuk memperkuat perekonomian UMKM.
          </p>
      </div>
    </div>
  </section>
  <!-- end Common hero -->

{{-- Umkm Form --}}
<section class="section pt-0">
  <div class="container">
    <div class="col-12 md:order-1">
      <form class="px-0 lg:px-60" action="#" method="POST">
        <div class="form-group mb-5">
            <label class="form-label" for="nama_usaha">Nama Usaha</label>
            <input
              class="form-control"
              type="text"
              id="nama_usaha"
              name="nama_usaha"
              placeholder="Masukkan nama usaha anda"
              value="{{ old('nama_usaha') }}"
              required
            />
            @error('nama_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-5">
            <label class="form-label" for="deskripsi_usaha">Deskripsi Usaha</label>
            <textarea
                    class="w-full rounded-lg border-border text-dark placeholder:text-[#B0B0B0] focus:border-primary focus:ring-transparent"
                    id="deskripsi_usaha"
                    name="deskripsi_usaha"
                    rows="10"
                    placeholder="Deskripsikan usaha anda"
                    value="{{ old('deskripsi_usaha') }}" 
                    maxlength="200"
                    required
                ></textarea>
            @error('deskripsi_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-5">
            <label class="form-label" for="jenis_usaha">Jenis usaha</label>
            <select name="jenis_usaha" id="jenis_usaha" class="form-select" required>
              <option value="">Pilih jenis usaha</option>
              <option value="fnb">FnB</option>
              <option value="Fashion">Fashion</option>
              <option value="Jasa">Jasa</option>
              <option value="Kerajinan">Kerajinan</option>
              <option value="Lainnya">Lainnya</option>
            </select>
            @error('jenis_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-5">
            <label class="form-label" for="berkas_usaha">Foto Usaha (MAX 2MB)</label>
            <input
                class="block h-[60px] w-full text-sm border border-gray-200 bg-white text-dark rounded-lg cursor-pointer focus:outline-none file:rounded-l-lg file:text-dark file:h-[60px] file:px-4 file:border-0"
                type="file"
                id="berkas_usaha"
                name="berkas_usaha"
                value="{{ old('berkas_usaha') }}">
            @error('berkas_usaha')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mb-5">
          <label class="form-label" for="nama">Nama</label>
          <input
            class="form-control"
            type="text"
            id="nama"
            name="nama"
            placeholder="Masukkan nama lengkap anda" 
            value="{{ old('nama') }}"
            required
          />
          @error('nama')
              <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group mb-5">
          <label class="form-label" for="nik">NIK</label>
          <input
            class="form-control"
            type="number"
            id="nik"
            name="nik"
            placeholder="Masukkan NIK anda"
            value="{{ old('nik') }}"
            required
          />
          @error('nik')
              <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
          @enderror
        </div>
        <button
          class="btn btn-primary block w-full"
          type="submit">
          Submit
        </button>
      </form>
    </div>
  </div>
</section>
{{-- end Umkm Form --}}

@include('layout.footer')

