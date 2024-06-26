{{-- Style Untuk Custom Scrollbar --}}
<style>
    /* For WebKit browsers (Chrome, Safari) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
    }

    /* For Firefox */
    .custom-scrollbar {
        scrollbar-width: none;  /* Remove scrollbar space */
        -ms-overflow-style: none;  /* IE and Edge */
    }

    /* To make sure the custom-scrollbar class is applied properly */
    .custom-scrollbar {
        overflow-y: auto;
    }
</style>

@include('layout.start')

@include('layout.a_navbar')

<!-- Container utama dengan tampilan flex -->
<div class="h-screen flex flex-row">
    @include('layout.a_sidebar') <!-- Menyertakan sidebar -->

    <!-- Bagian konten utama -->
    <div class="flex-grow bg-white overflow-auto custom-scrollbar">
        <!-- Container untuk form edit data akun -->
        <div class="w-full h-fit min-w-max p-5 shadow">
            <!-- Menampilkan breadcrumb -->
            @include('layout.breadcrumb2')

            <form class="px-10 py-10 min-w-full bg-white grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/akun/' . $user->id_user) }}" method="POST">
                <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-2">
                    {{ $page->title }}
                </h1>

                @csrf <!-- Token CSRF untuk keamanan -->
                @method('PUT') <!-- Metode PUT untuk update data -->

                <!-- Display errors -->
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

                <!-- Input untuk Jabatan -->
                <label for="id_level" class="block mb-2 text-sm font-bold text-gray-900 col-span-2 lg:col-span-1">Jabatan<span class="text-red-500">*</span></label>
                <input type="text" list="jabatan-list" id="jabatan-search" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-2 lg:col-span-1 p-2.5" placeholder="Cari Jabatan" value="{{ $user->level->nama_level }}" required>
                <datalist id="jabatan-list">
                    @foreach($level as $item)
                        <option data-id="{{ $item->id_level }}" value="{{ $item->nama_level }}">{{ $item->nama_level }}</option>
                    @endforeach
                </datalist>
                <input type="hidden" name="id_level" id="id_level" value="{{ $user->id_level }}">

                <!-- Input untuk Nama -->
                <label for="id_penduduk" class="block mb-2 text-sm font-bold text-gray-900 col-span-2 lg:col-span-1">Nama<span class="text-red-500">*</span></label>
                <input type="text" list="nama-list" id="penduduk-search" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-2 lg:col-span-1 p-2.5" placeholder="Cari Nama atau NIK" value="{{ $user->penduduk->nama }} - {{ $user->penduduk->nik }}" required>
                <datalist id="nama-list">
                    @foreach($penduduk as $item)
                        <option data-id="{{ $item->id_penduduk }}" value="{{ $item->nama }} - {{ $item->nik }}">{{ $item->nama }} - {{ $item->nik }}</option>
                    @endforeach
                </datalist>
                <input type="hidden" name="id_penduduk" id="id_penduduk" value="{{ $user->id_penduduk }}">

                <!-- Input untuk Username -->
                <label for="username" class="block mb-2 text-sm font-bold text-gray-900 col-span-2 lg:col-span-1">Username<span class="text-red-500">*</span></label>
                <input type="text" name="username" id="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-2 lg:col-span-1 p-2.5" placeholder="Masukkan Username" value="{{ $user->username }}" required />

                <!-- Input untuk Password -->
                <label for="password" class="block mb-2 text-sm font-bold text-gray-900 col-span-2 lg:col-span-1">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-2 lg:col-span-1 p-2.5" placeholder="Masukkan Password"/>

                <!-- Hanya tampilkan input status_akun jika user yang sedang diupdate bukan admin yang sedang login -->
                @if(Auth::id() != $user->id_user || $user->level->nama_level != 'Admin')
                    <!-- Input untuk Status Akun -->
                    <label for="status_akun" class="block mb-2 text-sm font-bold text-gray-900 col-span-2 lg:col-span-1">Status Akun<span class="text-red-500">*</span></label>
                    <select name="status_akun" id="status_akun" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-2 lg:col-span-1 p-2.5">
                        <option value="Aktif" @if($user->status_akun == 'Aktif') selected @endif>Aktif</option>
                        <option value="Nonaktif" @if($user->status_akun == 'Nonaktif') selected @endif>Nonaktif</option>
                    </select>
                @endif

                <!-- Tombol Batal dan Simpan -->
                <div class="flex col-span-2 mt-4">
                    <a href="{{ url('admin/akun') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')

<!-- Script untuk mengisi data-id pada input -->
<script>
document.getElementById('jabatan-search').addEventListener('input', function(e) {
    var options = document.getElementById('jabatan-list').options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].value === e.target.value) {
            document.getElementById('id_level').value = options[i].getAttribute('data-id');
        }
    }
});

document.getElementById('penduduk-search').addEventListener('input', function(e) {
    var options = document.getElementById('nama-list').options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].value === e.target.value) {
            document.getElementById('id_penduduk').value = options[i].getAttribute('data-id');
        }
    }
});
</script>
