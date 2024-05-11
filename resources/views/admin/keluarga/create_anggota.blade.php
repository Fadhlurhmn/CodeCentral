@include('layout.start')

@include('layout.a_navbar')

<div class="h-screen flex flex-row flex-wrap">
    @include('layout.a_sidebar')
    <div class="flex-grow bg-slate-100">
        <div class="flex flex-col">
            <h1 class="py-5 ml-5 text-3xl font-bold">{{$breadcrumb->title}}</h1>
        </div>
        <div class="w-full min-w-max p-5 shadow ">

            <form id="form" class="px-10 py-10 bg-white gap-x-20 gap-y-2 grid grid-cols-4 outline-none outline-4 outline-gray-700 rounded-xl" action="{{ url('keluarga/'.$keluarga) }}" method="POST">
                <h1 class="px-5 pb-5 pt-10 mb-5 font-semibold text-center text-xl rtl:text-right text-gray-900 border-b-2 col-span-full ">
                    {{$page->title}}
                </h1>
                @csrf
            
                {{-- Hidden input for keluarga ID --}}
                <input type="hidden" name="id_keluarga" value="{{ $keluarga }}">
            
                {{-- Input for orang --}}
                <div class="col-span-full">
                    <label for="id_penduduk" class="block text-sm font-medium text-gray-700">Penduduk 1</label>
                    <select name="id_penduduk[]" id="id_penduduk" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                        @foreach ($penduduk as $orang)
                            <option value="{{ $orang->id_penduduk }}">{{ $orang->nama }}</option>
                        @endforeach
                    </select>
                    
                </div>
                
            
                {{-- Input for peran keluarga --}}
                <div class="col-span-full">
                    <label for="peran_keluarga" class="block text-sm font-medium text-gray-700">Peran Keluarga 1</label>
                    <select name="peran_keluarga[]" id="peran_keluarga" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                        <option value="kepala keluarga">Kepala Keluarga</option>
                        <option value="istri">Istri</option>
                        <option value="anak">Anak</option>
                    </select>
                </div>

                <!-- Additional inputs for more family members -->
                <div id="family_members" class="col-span-full"></div>

                <!-- Buttons for adding and removing family members -->
                <div class="flex justify-between group col-span-full mt-5">
                    <button type="button" onclick="addFamilyMember()" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-40 sm:w-auto px-5 py-2.5 text-center mr-2">Tambah Anggota</button>
                    <button type="button" onclick="removeFamilyMember()" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-40 sm:w-auto px-5 py-2.5 text-center mr-2">Kurangi Anggota</button>
                    <a href="{{ url('keluarga') }}" class="text-white bg-teal-400 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-gray-400 font-medium rounded-lg text-sm w-40 sm:w-auto px-5 py-2.5 text-center mr-2">Kembali</a>
                    <button type="submit" class="text-white bg-teal-700 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-40 sm:w-auto px-5 py-2.5 text-center">Submit</button>
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
        pendudukSelect.className = "mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm";
        
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
        peranKeluargaSelect.className = "mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm";
        
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
        labelPenduduk.className = "block text-sm font-medium text-gray-700";

        var labelPeranKeluarga = document.createElement("label");
        labelPeranKeluarga.innerText = "Peran Keluarga " + numberOfFamilyMembers;
        labelPeranKeluarga.className = "block text-sm font-medium text-gray-700";

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
</script>
