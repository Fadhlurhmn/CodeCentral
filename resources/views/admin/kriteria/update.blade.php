@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">
        <div class="w-full h-fit min-w-max p-5">
            <form id="form_kriteria" action="{{ url('admin/kriteria') }}" method="POST">
                @csrf
                <div class="px-10 py-10 text-xs bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline outline-none outline-4 outline-gray-700 rounded-xl">
                    <h1 class="px-5 pb-5 mb-5 font-semibold text-center text-lg rtl:text-right text-gray-900 border-b-2 col-span-full">
                        Penambahan Kriteria
                    </h1>
                    
                    {{-- Kriteria dan Bobot --}}
                    <div class="col-span-4">
                        <label class="block text-sm font-bold text-gray-900">Kriteria dan Bobot</label>
                        <div id="kriteria-container">
                            <div class="flex items-center gap-x-4 mt-2">
                                <input type="text" name="kriteria[]" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Kriteria" required>
                                <input type="number" name="bobot[]" class="bobot-input shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Bobot" oninput="calculateTotalBobot()" required>
                                <select name="jenis[]" id="" class="shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5">
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                                <button type="button" class="remove-kriteria p-2 bg-red-600 text-white hover:bg-red-700 focus:outline-none rounded-lg" onclick="removeKriteria(this)">Hapus</button>
                            </div>
                        </div>
                        <button type="button" class="py-1.5 px-2 mt-2 bg-teal-500 hover:bg-teal-600 text-white focus:outline-none rounded-lg" onclick="addKriteria()">Tambah Kriteria</button>
                    </div>
                        
                    {{-- Button submit --}}
                    <div class="flex py-2 px-3 mt-5 justify-start group col-span-2">
                        <a href="{{ url('admin/bansos') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center mr-2">Batal</a>
                        <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                    </div>
                </div>
            </form>
            

        </div>
    </div>
</div>

@include('layout.end')
<script>
function addKriteria() {
    const container = document.getElementById('kriteria-container');
    const kriteriaDiv = document.createElement('div');
    kriteriaDiv.className = 'flex items-center gap-x-4 mt-2';
    kriteriaDiv.innerHTML = `
        <input type="text" name="kriteria[]" class="shadow-sm w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Kriteria" required>
        <input type="number" name="bobot[]" class="bobot-input shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5 " placeholder="Bobot" oninput="calculateTotalBobot()" required>
        <select name="jenis[]" class="shadow-sm w-24 bg-gray-50 border border-gray-300 text-xs rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5">
            <option value="Benefit">Benefit</option>
            <option value="Cost">Cost</option>
        </select>
        <button type="button" class="remove-kriteria p-2 bg-red-600 text-white hover:bg-red-700 focus:outline-none rounded-lg" onclick="removeKriteria(this)">Hapus</button>
    `;
    container.appendChild(kriteriaDiv);
}
</script>