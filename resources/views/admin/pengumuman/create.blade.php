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

        {{-- start box form create --}}
        <div class="w-full min-w-max p-5 shadow">
            <form class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('pengumuman') }}" method="POST">
                {{-- title box form --}}
                <h1 class="p-5 mb-5 font-semibold text-left rtl:text-right text-gray-900 bg-teal-400 col-span-4 rounded-lg">
                    {{ $page->title }}
                </h1>
                @csrf
                {{-- input judul_pengumuman --}}
                <div class="relative z-0 w-full mb-5 group font-bold col-span-4">
                    <input type="text" name="judul_pengumuman" id="judul_pengumuman" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " required />
                    <label for="judul_pengumuman" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Judul</label>
                </div>

                {{-- input textarea deskripsi --}}
                <div class="relative w-full mb-5 group col-span-4">
                    <label for="deskripsi" class="peer-focus:font-medium font-bold text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Isi Pengumuman</label>
                    <textarea name="deskripsi" id="editor" class="normal-case">

                    </textarea>
                </div>

                {{-- input gambar --}}
                <div class="relative w-full mb-5 group col-span-4">
                    <label for="gambar" class="peer-focus:font-medium font-bold text-sm text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:text-gray-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Lampiran</label>
                    <input type="file" class="block w-full text-sm text-slate-400 border border-slate-400 rounded-xl
                        file:mr-4 file:py-2 file:px-4
                        file:border-0 file:rounded-l-xl
                        file:text-sm file:font-semibold
                        file:bg-teal-400 file:text-black
                        hover:file:bg-teal-600
                    "/>
                </div>
                
                {{-- submit button --}}
                <div class="flex justify-between col-span-2">
                    <a href="{{ url('pengumuman') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                </div>
            </form>
        </div>
        {{-- end box form create --}}
    </div>
</div>

@push('js')
<script>
    // ckeditor plugin init
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
        toolbar: [ 'undo', 'redo', '|','bold', 'italic', '|', 'link', 'numberedList', 'bulletedList' ]
        } )

        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
@include('layout.end')