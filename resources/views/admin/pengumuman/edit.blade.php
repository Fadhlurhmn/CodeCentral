@include('layout.start')
@include('layout.a_navbar')

<div class="h-screen flex flex-row">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white overflow-auto">
        <div class="w-full h-fit p-5">
            {{-- start breadcrumb --}}
            @include('layout.breadcrumb2')
            {{-- end breadcrumb --}}

            <!-- Display errors if no announcement found -->
            @if(!$pengumuman)
            <div class="my-5 bg-white border border-red-500 text-red-500 px-4 py-3 rounded-lg alert">
                <h5 class="font-semibold"><i class="fas fa-ban mr-2"></i>Kesalahan!</h5>
                <p>Data yang Anda cari tidak ditemukan</p>
                <button type="button" class="px-5 mt-2 close bg-red-300/30 rounded-lg" data-dismiss="alert" aria-label="Close" onclick="window.location.href = '{{ url('admin/pengumuman') }}';">
                    close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @else
            <!-- Form to edit announcement -->
            <form id="form_pengumuman" action="{{ url('admin/pengumuman/' . $pengumuman->id_pengumuman) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="p-10 bg-white grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-2">
                        {{ $page->title }}
                    </h1>

                    <!-- Display errors if any -->
                    @if ($errors->any())
                    <div class="col-span-2">
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

                    <!-- Announcement title -->
                    <label for="judul_pengumuman" class="block mb-2 text-xs font-bold text-gray-900 col-span-2 lg:col-span-1">Judul</label>
                    <input type="text" name="judul_pengumuman" id="judul_pengumuman" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-2 lg:col-span-1 p-2.5" placeholder="Masukkan Judul" value="{{ $pengumuman->judul_pengumuman }}" required />

                    <!-- Hidden inputs for user ID and created_at -->
                    <input type="hidden" name="id_user" id="id_user" value="{{ $pengumuman->id_user }}" required />
                    <input type="hidden" name="created_at" id="created_at" value="{{ $pengumuman->created_at }}" required />

                    <!-- Announcement description -->
                    <div class="col-span-2 lg:col-span-1 mt-2">
                        <label for="deskripsi" class="block mb-2 text-xs font-bold text-gray-900">Deskripsi</label>
                        <div id="editor">
                            <textarea name="deskripsi" class="normal-case">{{ $pengumuman->deskripsi }}</textarea>
                        </div>
                    </div>

                    <!-- Thumbnail input -->
                    <div class="relative w-full group col-span-2 lg:col-span-1">
                        <label for="thumbnail" class="block mt-2 text-xs font-bold text-gray-900 col-span-2">Thumbnail <span class="font-normal">(File gambar max ukuran 2MB)</span> </label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="block w-full text-sm bg-gray-50 border border-gray-300 rounded-lg
                            file:mr-4 file:py-2 file:px-4
                            file:border-0 file:rounded-l-lg
                            file:text-xs file:font-medium
                            file:bg-teal-400
                            hover:file:bg-teal-600
                        "/>
                    </div>

                    <!-- Display current thumbnail -->
                    <div class="mt-3 mb-2 col-span-2">
                        <p class="block mt-2 text-xs font-bold text-gray-900 col-span-2">Thumbnail sebelumnya: </p>
                        <img src="{{ asset('storage/'. $pengumuman->thumbnail) }}" alt="{{ $pengumuman->judul_pengumuman }}" class="img-thumbnail w-96" />
                    </div>

                    <!-- Submit and cancel buttons -->
                    <div class="flex col-span-2">
                        <a href="{{ url('admin/pengumuman') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

@push('js')
<script>
    // Initialize ClassicEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            }
        })
        .then(editor => {
            const oldData = '{!! $pengumuman->deskripsi !!}';
            editor.setData(oldData);
            // Handle form submit
            document.querySelector('form').addEventListener('submit', (event) => {
                event.preventDefault();
                const form = event.target;
                // Set textarea value with editor data
                document.querySelector('textarea[name="deskripsi"]').value = editor.getData();

                // Confirm publish or save as draft
                Swal.fire({
                    title: 'Publikasikan sekarang?',
                    icon: 'question',
                    showCancelButton: true,
                    showCloseButton: true,
                    cancelButtonText: 'Tidak',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    confirmButtonColor: '#38b2ac',
                    reverseButtons: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Set status to "Publikasi" and submit form
                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="status_pengumuman" value="Publikasi">');
                        form.submit();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Set status to "Draf" and submit form
                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="status_pengumuman" value="Draf">');
                        form.submit();
                    }
                });
            });
        })
        .catch(error => {
            console.error(error);
        });

    // Handle thumbnail upload indicator
    const thumbnail = document.getElementById('thumbnail');
    const uploadIndicator_foto = document.getElementById('uploadIndicator_foto');
    thumbnail.addEventListener('change', function() {
        if (thumbnail.files.length > 0) {
            uploadIndicator_foto.classList.remove('hidden');
        } else {
            uploadIndicator_foto.classList.add('hidden');
        }
    });
</script>
@endpush

@include('layout.end')
