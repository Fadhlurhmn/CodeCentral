@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">

        <div class="w-full h-fit min-w-max p-5 ">
            @include('layout.breadcrumb2')
            <form id="kategori_bansos" method="post" action="{{ url('admin/kategori_bansos/update') }}" class="px-10 py-10 bg-white outline-none outline-4 outline-gray-700 rounded-xl">
                @csrf
                <div class="grid grid-cols-4 gap-4 text-sm">
                    <div class="col-span-full">
                        <table class="min-w-full bg-white border rounded-lg">
                            <thead class="bg-teal-500 text-center">
                                <tr>
                                    <th class="py-2 px-4 font-normal border border-teal-300">Nama Kategori</th>
                                    <th class="py-2 px-4 font-normal border border-teal-300">Pengirim</th>
                                    <th class="py-2 px-4 font-normal border border-teal-300">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="kategoriTableBody">
                                @foreach ($bansos as $item)
                                    <tr>
                                        <td class="border px-4 py-2">
                                            <input type="hidden" name="id[]" value="{{ $item->id_bansos }}">
                                            <input type="text" name="nama[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" value="{{ $item->nama }}" required>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <input type="number" name="pengirim[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" value="{{ $item->pengirim }}" required>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ url('admin/kategori_bansos/' . $item->id_bansos . '/delete') }}" class="btn btn-danger ml-2 mr-2 flex-col" onclick="return confirm('Apakah Anda yakin ingin menghapus data kategori ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <button id="addRow" type="button" class="p-2 mt-5 text-xs text-center shadow-md bg-teal-300 hover:bg-teal-400 text-teal-700 hover:text-teal-800 hover:shadow-teal-500 transition duration-300 ease-in-out rounded-lg">Tambah Data</button>
    
                <div class="flex py-2 mt-5 justify-start group col-span-full">
                    <a href="{{ url('admin/bansos/index') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.end')

<script>
    $(document).ready(function() {
        $('#addRow').click(function() {
            $('#kategoriTableBody').append(`
                <tr>
                    <td class="border px-4 py-2">
                        <input type="hidden" name="id[]" value="">
                        <input type="text" name="nama[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" required>
                    </td>
                    <td class="border px-4 py-2">
                        <input type="number" name="pengirim[]" class="form-control mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs" required>
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <button type="button" class="removeRow bg-red-600 text-white px-3 py-1 rounded-md shadow hover:bg-red-700">Hapus</button>
                    </td>
                </tr>
            `);
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });
    });
</script>
{{-- <script>
    document.getElementById('satpamForm').addEventListener('submit', function(event) {
        let isValid = true;
        let pengirim = document.querySelectorAll('input[name="pengirim[]"]');
    
        phoneInputs.forEach(function(input) {
            if (input.value.length !== 12) {
                isValid = false;
                input.classList.add('border-red-500');
                alert('Nomor telepon harus terdiri dari 12 digit');
            } else {
                input.classList.remove('border-red-500');
            }
        });
    
        if (!isValid) {
            event.preventDefault();
        }
    });
</script> --}}