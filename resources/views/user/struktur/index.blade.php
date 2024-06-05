@include('layout.head')
@include('layout.u_navbar')
<!-- floating assets -->
<img
  class="floating-bubble-1 absolute right-0 top-0 -z-[1]"
  src="{{ asset('images/floating-bubble-1.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]"
  src="{{ asset('images/floating-bubble-2.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]"
  src="{{ asset('images/floating-bubble-3.svg') }}"
  alt=""
/>
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero pt-16 pb-14">
    <div class="container">
      <div class="page-hero-content mx-auto max-w-[768px] text-center">
          <h1 class="mb-5 mt-8">
              Struktur RW dan RT
          </h1>
          <p> 
            Susunan Kepengurusan RW 4 dan RT Tlogomas.
          </p>
      </div>
    </div>
  </section>
  <!-- end Common hero -->

<section class="section pt-0">
  <div class="container">
    {{-- Categories --}}
    <div class="category-filter mb-10 mt-3 rounded-xl bg-[#EEEEEE] px-4">
        <ul class="filter-list">
          <li>
            <button type="button" onclick="show('rw')" id="item-rw" class="filter-btn btn filter-btn-active btn-sm hover:filter-btn-active">RW</button>
          </li>
          <li>
            <button type="button" onclick="show('rt1')" id="item-rt1" class="filter-btn btn btn-sm hover:filter-btn-active">RT 1</button>
          </li>
          <li> 
            <button type="button" onclick="show('rt2')" id="item-rt2" class="filter-btn btn btn-sm hover:filter-btn-active">RT 2</button>
          </li>
          <li>
            <button type="button" onclick="show('rt3')" id="item-rt3" class="filter-btn btn btn-sm hover:filter-btn-active">RT 3</button>
          </li>
          <li>
            <button type="button" onclick="show('rt4')" id="item-rt4" class="filter-btn btn btn-sm hover:filter-btn-active">RT 4</button>
          </li>
        </ul>
      </div>
      {{-- end Categories --}}

    <div class="col-12 md:order-1">
        <div class="section-struktur grid grid-cols-4 gap-4" id="rw">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">KETUA RW</span>
                            <p>Subiyanto</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">WAKIL KETUA RW</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">SEKERTARIS RW</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">BENDAHARA RW</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RT 1 --}}
        <div class="section-struktur hidden grid grid-cols-4 gap-4" id="rt1">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">KETUA RT 1</span>
                            <p>Hariyanto</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">WAKIL KETUA RT 1</span>
                            <p>Indarwati</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">SEKERTARIS RT 1</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">BENDAHARA RT 1</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RT 2 --}}
        <div class="section-struktur hidden grid grid-cols-4 gap-4" id="rt2">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">KETUA RT 2</span>
                            <p>Chandrawati</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">WAKIL KETUA RT 2</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">SEKERTARIS RT 2</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">BENDAHARA RT 1</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RT 3 --}}
        <div class="section-struktur hidden grid grid-cols-4 gap-4" id="rt3">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">KETUA RT 3</span>
                            <p>Bu Wahyudi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">WAKIL KETUA RT 3</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">SEKERTARIS RT 3</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">BENDAHARA RT 3</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- RT 4 --}}
        <div class="section-struktur hidden grid grid-cols-4 gap-4" id="rt4">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">KETUA RT 4</span>
                            <p>Amelia</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">WAKIL KETUA RT 4</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">SEKERTARIS RT 4</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <img src="{{ asset('img/user1.jpg') }}" class="flex-col max-h-20 max-w-20 rounded-full aspect-square mr-4" alt="Foto Pengurus">
                        <div class="flex-col ">
                            <span class="text-xs my-auto">BENDAHARA RT 4</span>
                            <p>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
  </div>
</section>

@push('js')
    <script>
        function show(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.section-struktur');
            const items = document.querySelectorAll('.filter-btn');
            sections.forEach(
                div => { div.classList.add('hidden');}
            );
            items.forEach(
                button => {button.classList.remove('filter-btn-active');}
            );

            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            const selectedItem = document.getElementById(`item-${sectionId}`);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');
                selectedItem.classList.add('filter-btn-active');
            }
        }
    </script>
@endpush
@include('layout.footer')

