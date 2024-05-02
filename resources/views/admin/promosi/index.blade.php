@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- start content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16"> 
    <h1 class="py-5 ml-5 text-3xl text-gray-900 font-bold">{{$breadcrumb->title}}</h1>

    <div class="container p-5 mb-5 bg-teal-600 text-lg grid grid-cols-2 items-center">
      <p class="mb-3 text-white text-xl">{{$page->title}}</p>
      <br>
      <a href="{{ url('admin/promosi/daftar') }}" class="px-3 py-1 bg-teal-400 text-teal-900 text-center text-sm font-medium rounded-full justify-self-start">cek daftar permintaan</a>
    </div>
  
    {{-- Search form --}}
    <form action="{{ url()->current() }}" method="GET" class="mb-4">
      <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari nama usaha..." class="px-4 py-2 border border-gray-300 rounded-md">
      <button type="submit" class="px-4 py-2 bg-teal-400 text-teal-900 rounded-md ml-2">Cari</button>
    </form>
  
    {{-- Place your code here --}}
    <div class="container bg-white text-lg grid grid-cols-6 gap-5 p-5 mx-auto overflow-y-auto" style="max-height: 80vh;">
        {{-- Bagian Promosi Usaha Warga --}}
          {{-- Usaha warga dari database --}}
            @foreach ($promosi as $umkm)
            <a href="{{ url('admin/promosi/show/' . $umkm->id_umkm) }}" class="group relative block overflow-hidden rounded-md">
              <img
                src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt=""
                class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"/>
            
              <div class="relative border border-gray-100 bg-white p-2">
                <h2 class="mt-2 text-sm font-semibold text-gray-900">{{$umkm->nama_usaha}}</h2>
                <p class="mt-0.5 text-sm text-gray-700">{{$umkm->deskripsi}}</p>
                <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
                <p class="mt-0.5 text-xs text-gray-700">{{$umkm->alamat}}</p>
                  {{-- Filter status pengajuan --}}
                    @php
                        $bgColor = '';

                        switch($umkm->status_pengajuan) {
                            case 'tidak aktif':
                                $bgColor = 'bg-red-600/60';
                                break;
                            case 'pending':
                                $bgColor = 'bg-yellow-600/60';
                                break;
                            case 'aktif':
                                $bgColor = 'bg-teal-600/60';
                                break;
                            default:
                                $bgColor = 'bg-gray-600/60'; // Warna default jika tidak cocok dengan kondisi di atas
                                break;
                        }
                    @endphp
                    {{-- End filter status --}}
                  <p class="mt-0.5 {{ $bgColor }} text-white px-2 rounded-full inline-block">{{ $umkm->status_pengajuan }}</p>

                  <form action="{{ url('admin/promosi/'.$umkm->id_umkm.'/show') }}" class="mt-2">
                  <button type="submit" class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                    Lihat Detail
                  </button>
                </form>
              </div>
            </a>
            @endforeach
          {{-- End Usaha warga dari database --}}

          {{-- Usaha Warga 1 --}}
          <a href="{{url('admin/promosi/show')}}" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
            />
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Sate Maranggi Pak Ahmadi</h2>
              <p class="mt-0.5 text-sm text-gray-700">Cita rasa legenda sate maranggi</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
              <p class="mt-0.5 bg-teal-600/60 text-white px-2 rounded-full inline-block">aktif</p>
              <form action="{{ url('admin/promosi/show') }}" class="mt-2">
                <button type="submit" class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 2 --}}
          <a href="{{url('admin/promosi/show')}}" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1611520189922-f7b1ba7d801e?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"/>
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Sate Maranggi Pak Ahmadi</h2>
              <p class="mt-0.5 text-sm text-gray-700">Cita rasa legenda sate maranggi</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
              <p class="mt-0.5 bg-red-600/60 text-white px-2 rounded-full inline-block">tidak aktif</p>
              <form action="{{ url('admin/promosi/show') }}" class="mt-2">
                <button type="submit" class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 3 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1514327567052-1eed4e4902c1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"/>
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Burger brother</h2>
              <p class="mt-0.5 text-sm text-gray-700">Menjual burger aneka topping</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Pinggir Jalan Mawar Rt.2</p>
              <p class="mt-0.5 bg-teal-600/60 text-white px-2 rounded-full inline-block">aktif</p>
              <form class="mt-4">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
          {{-- Usaha Warga 2 --}}
          <a href="#" class="group relative block overflow-hidden rounded-md">
            <img
              src="https://images.unsplash.com/photo-1514327567052-1eed4e4902c1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              alt=""
              class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"/>
          
            <div class="relative border border-gray-100 bg-white p-2">
              <h2 class="mt-2 text-sm font-semibold text-gray-900">Burger brother</h2>
              <p class="mt-0.5 text-sm text-gray-700">Menjual burger aneka topping dan hot dog</p>
              <p class="mt-0.5 text-xs text-gray-700">Lokasi :</p>
              <p class="mt-0.5 text-xs text-gray-700">Sebelah gang rt.4</p>
          
              <form class="mt-4">
                <button class="block w-full rounded bg-teal-400 p-2 text-sm font-normal transition hover:scale-105">
                  Lihat Detail
                </button>
              </form>
            </div>
          </a>
        {{-- End Bagian Usaha Warga --}}
    </div>
  <!-- end content -->
</div>
<!-- end wrapper -->

{{-- Start tabel data --}}
{{-- <div class="relatives mt-5 h-80 overflow-x-auto p-5 shadow">
  <table id="table_promosi" class="table-auto text-center border w-full min-w-max cursor-default">
      <thead class="bg-teal-400">
          <tr>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">No</th>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Nama Usaha</th>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Gambar</th>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Deskripsi</th>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Status</th>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Alamat</th>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r">Countdown</th>
              <th class="p-3 text-lg font-normal justify-between tracking-wide border-r bg-">Aksi</th>
          </tr>
      </thead>
  </table>
</div> --}}
{{-- End tabel data --}}
@include('layout.end')

{{-- @push('js')
<script>
    $(document).ready(function() {
        var table = $('#table_promosi').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('promosi/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [{
                    data: "DT_RowIndex",
                    className: "text-center text-sm",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nik",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "alamat",
                    className: "text-sm",
                    orderable: false,
                },
                {
                    data: "rt",
                    className: "text-sm",
                    orderable: true,
                    searchable: true
                },
                // {
                //     data: "keluarga.nomor_keluarga",
                //     className: "text-sm",
                //     orderable: true,
                // },
                {
                    data: "status_data",
                    className: "text-sm",
                    orderable: false,
                    render: function(data, type, row) {
                        if (data === 'Aktif') {
                            return '<div class="rounded-full bg-emerald-500/60 text-emerald-800 py-1 px-2">' + data + '</div>';
                        } else {
                            return '<div class="rounded-full bg-red-500/60 text-red-900 py-1 px-2">' + data + '</div>';
                        }
                    }
                },
                {
                    data: "status_penduduk",
                    className: "text-sm",
                    orderable: false,
                },
                {
                    data: "aksi",
                    className: "flex text-sm",
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endpush --}}
