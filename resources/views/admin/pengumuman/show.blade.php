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
                    Ditulis oleh {{ $pengumuman->user->username }}
                </div>
                <div class="text-base text-slate-400 font-light mb-4">
                    {{ $pengumuman->created_at->format('d M Y, H:i:s') }}
                </div>
            </div>
            {{-- tampilan content pengumuman --}}
            <div class="flex justify-center just">
                <div class="mb-4 text-lg text-wrap max-w-prose">
                    {!! $pengumuman->deskripsi !!}
                </div>
            </div>


            <a href="{{ url('admin/pengumuman') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-caret-left"></i> Kembali</a>
        </div>
        {{-- end box preview --}}
    </div>
</div>

@include('layout.end')
