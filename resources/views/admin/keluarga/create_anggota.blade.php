@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-white">

        <div class="w-full h-fit min-w-max p-5 ">
            @include('layout.breadcrumb2')
            <form id="form" action="{{ url('admin/keluarga/'.$keluarga.'/anggota') }}" method="POST">
                @csrf
                <div class="px-10 py-10 text-xs bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline-none outline-4 outline-gray-700 rounded-xl">
                    @if ($errors->any())
                        <div id="errorMessage" class="col-span-full bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Oops! Ada kesalahan:</strong>
                            <ul class="mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button id="closeButton" type="button" class="absolute top-0 right-0 px-4 py-3 focus:outline-none">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>
                    @endif

                    {{-- Hidden input for keluarga ID --}}
                    <input type="hidden" name="id_keluarga" value="{{ $keluarga }}">
                    <div class="flex justify-around col-span-full">
                        <label for="id_penduduk" class="block text-sm font-bold text-gray-700">Anggota Keluarga</label>
                        <label for="peran_keluarga" class="block text-sm font-bold text-gray-700">Peran Keluarga</label>
                    </div>
                    {{-- Input for orang --}}
                    @for($i=1; $i <= $totalOrang; $i++)
                    <div class="col-span-2 mb-3">
                        <select name="id_penduduk[]" id="id_penduduk" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs">
                            <option disabled selected>Pilih Warga</option>
                            @foreach ($penduduk as $orang)
                                <option value="{{ $orang->id_penduduk }}">{{ $orang->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($i==1)
                    {{-- Input for peran keluarga --}}
                    <div class="col-span-2 mb-3">
                        <select name="peran_keluarga[]" id="peran_keluarga" class="mt-1 block w-full py-2 font-semibold px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs">
                            <option value="Kepala Keluarga" selected>Kepala Keluarga</option>
                        </select>
                    </div>
                    @else
                    {{-- Input for peran keluarga --}}
                    <div class="col-span-2 mb-3">
                        <select name="peran_keluarga[]" id="peran_keluarga" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs">
                            <option disabled selected>Pilih Peran</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                        </select>
                    </div>
                    @endif
                    @endfor
                    <div class="flex py-2 px-3 mt-5 justify-start group col-span-2">
                        <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-xs w-32 sm:w-auto px-5 py-2.5 text-center">Simpan</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

@include('layout.end')

<script>
    // Function to add family member fields
    function addFamilyMember() {
        var familyMembersDiv = document.getElementById("family_members");
        var numberOfFamilyMembers = familyMembersDiv.children.length + 2; // Get the current number of family members and add 1
        
        // Create select for penduduk
        var pendudukSelect = document.createElement("select");
        pendudukSelect.name = "id_penduduk[]";
        pendudukSelect.className = "mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs";
        
        // Copy options from existing select
        var existingSelect = document.getElementById("id_penduduk");
        for (var i = 0; i < existingSelect.options.length; i++) {
            var option = document.createElement("option");
            option.text = existingSelect.options[i].text;
            option.value = existingSelect.options[i].value;
            pendudukSelect.add(option);
        }

        // Create select for peran keluarga
        var peranKeluargaSelect = document.createElement("select");
        peranKeluargaSelect.name = "peran_keluarga[]";
        peranKeluargaSelect.className = "mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-xs";
        
        // Copy options from existing select
        var existingPeranSelect = document.getElementById("peran_keluarga");
        for (var i = 0; i < existingPeranSelect.options.length; i++) {
            var option = document.createElement("option");
            option.text = existingPeranSelect.options[i].text;
            option.value = existingPeranSelect.options[i].value;
            peranKeluargaSelect.add(option);
        }

        // Create label for the family member
        var labelPenduduk = document.createElement("label");
        labelPenduduk.innerText = "Penduduk " + numberOfFamilyMembers;
        labelPenduduk.className = "block text-xs font-medium text-gray-700";

        var labelPeranKeluarga = document.createElement("label");
        labelPeranKeluarga.innerText = "Peran Keluarga " + numberOfFamilyMembers;
        labelPeranKeluarga.className = "block text-xs font-medium text-gray-700";

        // Create div to contain label and selects
        var familyMemberDiv = document.createElement("div");
        familyMemberDiv.className = "col-span-full";
        familyMemberDiv.appendChild(labelPenduduk);
        familyMemberDiv.appendChild(pendudukSelect);
        familyMemberDiv.appendChild(labelPeranKeluarga); // Add the label for peran keluarga
        familyMemberDiv.appendChild(peranKeluargaSelect);

        // Append new family member div to main container
        familyMembersDiv.appendChild(familyMemberDiv);
    }

    // Function to remove last family member fields
    function removeFamilyMember() {
        var familyMembersDiv = document.getElementById("family_members");
        var children = familyMembersDiv.children;
        if (children.length > 0) {
            familyMembersDiv.removeChild(children[children.length - 1]);
        }
    }

    document.getElementById('closeButton').addEventListener('click', function() {
        document.getElementById('errorMessage').style.display = 'none';
    });
</script>
