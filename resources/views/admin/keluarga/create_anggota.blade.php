@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow ">

            <form id="form" class="px-10 py-10 bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('keluarga') }}" method="POST">
                <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-full ">
                    {{ $page->title }}
                </h1>
                @csrf
                {{-- Kepala Keluarga --}}
                <div class="col-span-2 pb-5 mb-5">
                    <label for="kepala_keluarga" class="block mb-2 text-sm font-bold text-gray-900 ">Pilih Kepala Keluarga<span class="text-red-500">*</span></label>
                    <select name="kepala_keluarga" id="kepala_keluarga" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block  p-2.5 " required >
                        <option value="">Pilih Kepala Keluarga</option>
                        @foreach ($penduduk as $daftarPenduduk)
                        <option value="{{$daftarPenduduk->nama}}">{{$daftarPenduduk->nama}}</option>    
                        @endforeach
                    </select>
                </div>
                {{-- Istri --}}
                <div class="col-span-2 pb-5 mb-5">
                    <label for="istri" class="block mb-2 text-sm font-bold text-gray-900 ">Istri</label>
                    <select name="istri" id="istri" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block  p-2.5 ">
                        <option value="">Istri</option>
                        <option value="">--Kosong--</option>    
                        @foreach ($penduduk as $daftarPenduduk)
                        <option value="{{$daftarPenduduk->nama}}">{{$daftarPenduduk->nama}}</option>    
                        @endforeach
                    </select>
                </div>
                <hr class="col-span-4">
                
                {{-- Anggota Keluarga --}}
                <div class="col-span-2" id="anggota-keluarga-container">
                    <div class="anggota-keluarga mb-5">
                        <label for="anggota_keluarga_1" class="mb-2 text-sm font-bold text-gray-900">Anggota Keluarga 1</label>
                        <select name="anggota_keluarga[]" id="anggota_keluarga_1" class="anggota-keluarga-input shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                            <option value="">Pilih Anggota Keluarga 1</option>
                            @foreach ($penduduk as $daftarPenduduk)
                            <option value="{{$daftarPenduduk->nama}}">{{$daftarPenduduk->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button id="tambah-anggota-button" class="block justify-start w-52 bg-teal-500 text-sm text-center font-medium text-white py-2 px-4 rounded-lg mt-4 col-span-full">Tambah Anggota Keluarga</button>
                
                {{-- Jumlah anggota keluarga, warga bekerja dan belum bekerja --}}
                <input type="hidden" name="total_anggota_keluarga" id="total_anggota_keluarga" value="1">
                <input type="hidden" name="total_orang_kerja" id="total_orang_kerja" value="">
                <input type="hidden" name="total_tanggungan" id="total_tanggungan" value="">       
                
                <!-- Other form inputs here -->
                <div class="flex justify-between group col-span-full mt-5">
                    <a href="{{ url('keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-40 sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-40 sm:w-auto px-5 py-2.5 text-center ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


@include('layout.end')
<script>
    // Function to add new family member input fields
    function addFamilyMember() {
        var anggotaKeluargaContainer = document.getElementById('anggota-keluarga-container');
        var newAnggotaKeluargaDiv = document.createElement('div');
        var totalAnggotaInput = document.getElementById('total_anggota_keluarga');

        // Increment the total number of family members
        var totalAnggota = parseInt(totalAnggotaInput.value) + 1;
        totalAnggotaInput.value = totalAnggota;

        // Create HTML elements for the new family member input fields
        newAnggotaKeluargaDiv.className = 'anggota-keluarga mb-5';
        newAnggotaKeluargaDiv.innerHTML = `
        <div class="col-span-2">
            <label for="anggota_keluarga_${totalAnggota}" class="block mb-2 text-sm font-bold text-gray-900">Anggota Keluarga ${totalAnggota}</label>
            <select name="anggota_keluarga[]" id="anggota_keluarga_${totalAnggota}" class="anggota-keluarga-input shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block p-2.5" required>
                <option value="">Pilih Anggota Keluarga ${totalAnggota}</option>
                @foreach ($penduduk as $daftarPenduduk)
                <option value="{{$daftarPenduduk->nama}}">{{$daftarPenduduk->nama}}</option>
                @endforeach
            </select>
        </div>
        `;

        // Append the new family member input fields to the container
        anggotaKeluargaContainer.appendChild(newAnggotaKeluargaDiv);

        // Update total anggota keluarga
        document.getElementById('total_anggota').textContent = totalAnggota;
    }

    // Event listener for the "Tambah Anggota Keluarga" button
    document.getElementById('tambah-anggota-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        addFamilyMember(); // Call the function to add new family member input fields
    });

    // Function to calculate total family members (including head of family)
    function calculateTotalFamilyMembers() {
        var kepalaKeluargaSelect = document.getElementById('kepala_keluarga');
        var anggotaKeluargaSelects = document.querySelectorAll('[name="anggota_keluarga[]"]');
        var totalAnggotaInput = document.getElementById('total_anggota_keluarga');
        var totalAnggota = anggotaKeluargaSelects.length + (kepalaKeluargaSelect.value ? 1 : 0);
        totalAnggotaInput.value = totalAnggota;
    }

    // Event listener for change in head of family selection
    document.getElementById('kepala_keluarga').addEventListener('change', calculateTotalFamilyMembers);

    // Initial calculation of total family members
    calculateTotalFamilyMembers();
</script>
