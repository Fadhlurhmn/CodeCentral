@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl">{{$page->title}}</h1>
        </div>
        <div class="w-full h-screen min-w-max p-5 shadow overflow-y-scroll">
            <form class="px-10 py-10 min-w-full bg-white grid grid-cols-4 gap-x-20 gap-y-2 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('admin/akun') }}" method="POST" enctype="multipart/form-data">
                <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-4">
                    Edit data akun
                </h1>
                @csrf
                <label for="id_level" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Jabatan<span class="text-red-500">*</span></label>
                <input list="jabatan-list" name="id_level" id="id_level" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Pilih Jabatan" required>
                <datalist id="jabatan-list">
                    @foreach($level as $item)
                    <option value="{{ $item->id_level }}">{{ $item->nama_level }}</option>
                    @endforeach
                </datalist>
                @error('id_level')
                <small class="form-text text-danger col-span-4">{{ $message }}</small>
                @enderror

                <label for="id_penduduk" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Nama<span class="text-red-500">*</span></label>
                <input list="nama-list" name="id_penduduk" id="id_penduduk" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Pilih Nama" required>
                <datalist id="nama-list">
                    @foreach($penduduk as $item)
                    <option value="{{ $item->id_penduduk }}">{{ $item->nama }}</option>
                    @endforeach
                </datalist>
                @error('id_penduduk')
                <small class="form-text text-danger col-span-4">{{ $message }}</small>
                @enderror

                <label for="username" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Username<span class="text-red-500">*</span></label>
                <input type="text" name="username" id="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Username" required />
                @error('username')
                <small class="form-text text-danger col-span-4">{{ $message }}</small>
                @enderror

                <label for="password" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5" placeholder="Masukkan Password" required />
                @error('password')
                <small class="form-text text-danger col-span-4">{{ $message }}</small>
                @enderror

                <label for="status_akun" class="block mb-2 text-sm font-bold text-gray-900 col-span-4">Status Akun<span class="text-red-500">*</span></label>
                <select name="status_akun" id="status_akun" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block col-span-4 p-2.5">
                    <option value="{{ $user->status_akun }}">{{ $user->status_akun }}</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
                @error('status_akun')
                <small class="form-text text-danger col-span-4">{{ $message }}</small>
                @enderror

                <div class="flex col-span-2">
                    <a href="{{ url('admin/akun') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('layout.end')

<script>
document.getElementById('id_level').addEventListener('input', function(e) {
    var options = document.getElementById('jabatan-list').options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].value === e.target.value) {
            e.target.setAttribute('data-id', options[i].getAttribute('data-id'));
        }
    }
});

document.getElementById('id_penduduk').addEventListener('input', function(e) {
    var options = document.getElementById('nama-list').options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].value === e.target.value) {
            e.target.setAttribute('data-id', options[i].getAttribute('data-id'));
        }
    }
});
</script>
