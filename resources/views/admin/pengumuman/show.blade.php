@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        {{-- start breadcrumb --}}
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">{{$breadcrumb->title}}</h1>
        </div>
        {{-- end breadcrumb --}}

        {{-- start box preview --}}
        <div class="min-w-max p-5 shadow mx-5 bg-white">
            {{-- tampilan judul --}}
            <div class="text-2xl font-bold capitalize">
                {{ $pengumuman->judul_pengumuman }}
            </div>

            {{-- tampilan tanggal publish --}}
            <div class="text-base text-slate-400 font-light mb-4">
                Dipublikasikan pada {{ $pengumuman->created_at }}
            </div>
            
            {{-- tampilan image/ lampiran (kalo mau dibatesin cuma image boleh) --}}
            <div class="max-w-prose mb-4">
                <img src="{{ $pengumuman->lampiran }}" alt="no image">
            </div>

            {{-- tampilan content pengumuman --}}
            <div class="indent-8 text-lg text-wrap max-w-prose">
                {!! $pengumuman->deskripsi !!}
            </div>
        </div>
        {{-- end box preview --}}
    </div>
</div>

@include('layout.end')
