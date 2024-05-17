@include('layout.start')

@include('layout.a_navbar')
<div class="h-screen min-w-full flex flex-row flex-wrap">
    @include('layout.a_sidebar')

    <!-- strat content -->
    <div class="flex-col flex-grow">
        <div class="container h-full bg-white">
            <div class="p-5 text-sm font-normal text-left rtl:text-right text-gray-900 bg-white border-t-2 border-teal-500">
                <h1 class="pb-5 my-2 text-2xl font-extrabold text-gray-600 "> Detail Bansos A</h1>
                <div class="h-auto p-2">
                    <table id="table_keluarga" class="table-auto text-center  w-full min-w-max cursor-default">
                        <thead class="bg-teal-400">
                            <tr>
                                <th class="p-3 text-sm font-normal justify-between tracking-normal">No</th>
                                <th class="p-3 text-sm font-normal justify-between tracking-normal">No Keluarga</th>
                                <th class="p-3 text-sm font-normal justify-between tracking-normal">Tanggal</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end content -->
</div>


@include('layout.end')