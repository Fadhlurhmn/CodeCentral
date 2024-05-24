@include('layout.head')
@include('layout.header')
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
            Pengaduan
        </h1>
        <p>
            Selamat datang di halaman Pengaduan <span class="font-bold">RW 3 Tlogomas.</span>
            <br>Di sini Anda dapat mengajukan pengaduan atau keluhan terkait dengan lingkungan dan layanan di RW 3 Tlogomas. Silakan gunakan formulir pengaduan yang tersedia untuk bantuan lebih lanjut.
        </p>
    </div>
  </div>
</section>
<!-- end Common hero -->

{{-- Pengaduan Form --}}
<section class="section pt-0">
  <div class="container">
    <div class="col-12 md:order-1">
      <form class="px-0 lg:px-60" action="#" method="POST">
        <div class="form-group mb-5">
          <div class="form-group mb-5">
            <label class="form-label" for="judul_pengaduan">Judul Pengaduan</label>
            <input
              class="form-control"
              type="text"
              id="judul_pengaduan"
              name="judul_pengaduan"
              placeholder="Masukkan judul pengaduan anda"
              value="{{ old('judul_pengaduan') }}"
              required
            />
            @error('judul_pengaduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-5">
            <label class="form-label" for="isi_pengaduan">Isi Pengaduan</label>
            <textarea
                    class="w-full rounded-lg border-border text-dark placeholder:text-[#B0B0B0] focus:border-primary focus:ring-transparent"
                    id="isi_pengaduan"
                    name="isi_pengaduan"
                    rows="10"
                    placeholder="Deskripsikan pengaduan anda"
                    value="{{ old('isi_pengaduan') }}" 
                    maxlength="500"
                    required
                ></textarea>
            @error('isi_pengaduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-5">
            <label class="form-label" for="tanggal_pengaduan">Tanggal Kejadian</label>
            <input
                    class="form-control"
                    type="date"
                    id="tanggal_pengaduan"
                    name="tanggal_pengaduan"
                    value="{{ old('tanggal_pengaduan') }}" 
                    required>
            @error('tanggal_pengaduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-5">
            <label class="form-label" for="penerima_aduan">Sampaikan aduan ke:</label>
            <select name="penerima_aduan" id="penerima_aduan" class="form-select" required>
              <option value="">Pilih penerima aduan</option>
              <option value="RW">RW</option>
              <option value="RT-1">RT 1</option>
              <option value="RT-2">RT 2</option>
              <option value="RT-3">RT 3</option>
              <option value="RT-4">RT 4</option>
            </select>
            @error('penerima_aduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-5">
            <label class="form-label" for="berkas_pengaduan">Lampiran (MAX 2MB)</label>
            <input
                    class="block h-[60px] w-full text-sm border border-gray-200 bg-white text-dark rounded-lg cursor-pointer focus:outline-none file:rounded-l-lg file:text-dark file:h-[60px] file:px-4 file:border-0"
                    type="file"
                    id="berkas_pengaduan"
                    name="berkas_pengaduan"
                    value="{{ old('berkas_pengaduan') }}">
            @error('berkas_pengaduan')
                <small class="text-red-500 text-sm ml-3">{{ $message }}</small>
            @enderror
          </div>
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
{{-- end Pengaduan Form --}}

@include('layout.footer')
@include('layout.foot')
