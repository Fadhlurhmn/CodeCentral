@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="p-5 flex flex-col">
            @include('layout.breadcrumb2')
        </div>

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
                    {{ $pengumuman->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i:s') }}
                </div>
            </div>
            {{-- tampilan content pengumuman --}}
            <div class="flex justify-center just">
                <div class="mb-4 text-lg text-wrap max-w-prose">
                    {!! $pengumuman->deskripsi !!}
                </div>
            </div>


            <a href="{{ url('admin/pengumuman') }}" class="shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg font-medium text-sm w-full sm:w-auto px-5 py-2.5 text-center"><i class="fas fa-caret-left"></i> Kembali</a>
        </div>
        {{-- end box preview --}}
    </div>
</div>

@include('layout.end')
