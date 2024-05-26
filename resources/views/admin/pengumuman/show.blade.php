@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        {{-- start breadcrumb --}}
        @include('layout.breadcrumb')
        {{-- end breadcrumb --}}

        {{-- start box preview --}}
        <div class="min-w-max p-5 shadow mx-5 bg-white">
            {{-- tampilan judul --}}
            <div class="text-2xl font-bold capitalize">
                {{ $pengumuman->judul_pengumuman }}
            </div>

            {{-- tampilan tanggal publish --}}
            <div class="flex justify-between">
                <div class="text-base text-slate-400 font-light mb-4">
                    Ditulis oleh {{ $pengumuman->id_user }}
                </div>
                <div class="text-base text-slate-400 font-light mb-4">
                    {{ $pengumuman->created_at }}
                </div>
            </div>
            @if (session('success'))
            <!-- Menampilkan pesan sukses jika ada session 'success' -->
            <div class="col-span-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

            {{-- tampilan image/ lampiran (kalo mau dibatesin cuma image boleh) --}}
            <div class="mb-8">
                <img src="{{ $pengumuman->lampiran }}" class="object-cover w-full h-96" alt="no image">
            </div>

            {{-- tampilan content pengumuman --}}
            <div class="flex justify-center just">
                <div class="mb-4 text-lg text-wrap max-w-prose">
                    {!! $pengumuman->deskripsi !!}
                </div>
            </div>


            <a href="{{ url('admin/pengumuman') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
        </div>
        {{-- end box preview --}}
    </div>
</div>

@include('layout.end')
