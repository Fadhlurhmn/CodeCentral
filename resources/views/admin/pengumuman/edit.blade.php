@include('layout.start')

@include('layout.a_navbar')
    
<div class="h-screen flex flex-row">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        {{-- start breadcrumb --}}
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-2xl font-bold">{{ $breadcrumb->title }}</h1>
        </div>
        {{-- end breadcrumb --}}
        <div class="w-full h-fit p-5">

            @if(!$pengumuman)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg " data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/pengumuman') }}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            <form id="form_pengumuman" action="{{ url('admin/pengumuman/' . $pengumuman->id_pengumuman) }}" method="POST" enctype="multipart/form-data">
                <div class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-4 ">
                        {{ $page->title }}
                    </h1>
                    @csrf
                    {{-- @method('PUT') --}}

                    <!-- Display errors -->
                    @if ($errors->any())
                    <div class="col-span-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Ada yang salah!</strong>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    {{-- judul_pengumuman --}}
                    <label for="judul_pengumuman" class="block mb-2 text-xs font-bold text-gray-900 col-span-4">Judul</label>
                    <input type="text" name="judul_pengumuman" id="judul_pengumuman" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5 " placeholder="Masukkan Judul" value="{{ $pengumuman->judul_pengumuman }}" required />
                    {{-- id_user penulis --}}
                    <input type="hidden" name="id_user" id="id_user" value="{{ $pengumuman->id_user }}" required />

                    {{-- created_at (buat testing aja, created_at udah auto generate dari laravel migration) --}}
                    <input type="hidden" name="created_at" id="created_at" value="{{ $pengumuman->created_at }}" required />

                    {{-- deskripsi --}}
                    <div class="col-span-4 mt-2">
                        <label for="deskripsi" class="block mb-2 text-xs font-bold text-gray-900">Deskripsi</label>
                        <div id="editor">
                            <textarea name="deskripsi" value="{{ $pengumuman->deskripsi }}" class="normal-case">
                            
                            </textarea> 
                        </div>
                         
                     </div>

                    {{-- Lampiran --}}
                    <label for="lampiran" class="block mt-2 text-xs font-bold text-gray-900 col-span-4">Lampiran</label>
                    <div class="relative col-span-2 rounded-lg w-full h-full transition duration-300 ease-in-out mt-2">
                        <label for="lampiran" class="text-xs font-medium cursor-pointer text-white text-center py-2 px-4 bg-teal-500 rounded-lg hover:bg-teal-600 transition duration-300 ease-in-out">
                            Submit Gambar Lampiran (Max ukuran 2MB)
                        </label>
                        <input type="file" name="lampiran" id="lampiran" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"/>
                        
                        <span id="file-name" class="text-xs text-gray-700 mt-2 block"></span>
                    </div>
                    <div id="uploadIndicator_foto" class="hidden col-span-4">
                        <!-- Contoh: ikon atau pesan teks -->
                        <span class="text-green-500 text-sm">Gambar Terunggah</span>
                    </div>
                    <div class="mt-3 mb-2 col-span-4">
                        <p class="text-sm">Gambar Sebelumnya : </p>
                        <img src="{{ asset('img/'. $pengumuman->lampiran) }}" class="img-thumbnail w-96" />                        
                    </div>
                    
                    {{-- Submit --}}
                    <div class="flex col-span-2">
                        <a href="{{ url('admin/pengumuman') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center ">Simpan</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
        {{-- start box form create --}}
        
    </div>
</div>

@push('js')
<script>
    // ckeditor plugin init
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
        toolbar: [ 'undo', 'redo', '|','bold', 'italic', '|', 'link', 'numberedList', 'bulletedList' ]
        } )
        .then(editor => {
            const oldData = '{!! $pengumuman->deskripsi !!}';

            editor.setData(oldData);
        })

        .catch( error => {
            console.error( error );
        } );

    const lampiran = document.getElementById('lampiran');

    const uploadIndicator_foto = document.getElementById('uploadIndicator_foto');
    lampiran.addEventListener('change', function() {
        if (lampiran.files.length > 0) {
            uploadIndicator_foto.classList.remove('hidden');
        } else {
            uploadIndicator_foto.classList.add('hidden');
        }
    });
</script>
@endpush
@include('layout.end')