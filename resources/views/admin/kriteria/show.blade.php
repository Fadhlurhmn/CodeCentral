<table>
    <thead>
        <tr>
            <th>Kriteria</th>
            <th>Bobot</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kriteria as $item)
            <tr>
                <td>{{ $item->nama_kriteria }}</td>
                <td>{{ $item->bobot }}</td>
            </tr>
        @endforeach
    </tbody>
    <a href="{{ url('admin/kriteria/update')}}">Ubah Kriteria</a>
</table>
