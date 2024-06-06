<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex flex-col flex-grow p-6 cursor-default">
        <div class="container h-full bg-white shadow-md rounded-lg p-6">
            @include('layout.breadcrumb2')
            <form id="form_kriteria" action="{{ url('rw/kriteria') }}" method="POST">
                
                @csrf
                <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-b-2 border-teal-500">
                    {{-- <h1 class="px-5 pb-5 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-full">
                        Ubah Kriteria
                    </h1> --}}
                    <table class="min-w-full divide-y divide-gray-200 text-center">
                        <thead class="bg-teal-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-xs text-left font-semibold uppercase tracking-wider">Kriteria</th>
                                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-normal">Bobot</th>
                                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider">Jenis</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($kriteria as $item)
                                <tr>
                                    <td class="px-6 py-4 text-left whitespace-nowrap">
                                        {{$item->nama_kriteria}}
                                        <input class="cursor-default" type="text" name="kriteria[]" value="{{$item->nama_kriteria}}" readonly hidden>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input class="text-center bg-gray-50 border border-gray-300 rounded-lg w-16 p-1" type="number" name="bobot[]" id="bobot" value="{{$item->bobot}}" max="100">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select name="jenis[]" id="" class="shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5">
                                            <option value="{{$item->jenis}}" selected hidden>{{$item->jenis}}</option>
                                            <option value="benefit">benefit</option>
                                            <option value="cost">cost</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- Button submit --}}
                </div>

                <div class="flex py-2 px-3 mt-5 justify-start group col-span-2">
                    <a href="{{ url('rw/kriteria/show') }}" class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                    <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

@include('layout.end')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input[name="bobot[]"]').forEach(function(input) {
            input.addEventListener('input', function() {
                if (parseFloat(this.value) > 100) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Nilai bobot tidak boleh lebih dari 100',
                        confirmButtonText: 'OK'
                    });
                    this.value = 100; // Reset the value to 100 if it exceeds 100
                }
            });
        });
    });
</script>
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>    