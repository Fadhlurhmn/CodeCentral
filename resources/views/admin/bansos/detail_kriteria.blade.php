<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Keluarga Penerimaan Bantuan Sosial</title>
    <!-- Tambahkan link ke CSS Bootstrap atau CSS kustom Anda di sini -->
    <!-- Contoh: <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
</head>
<body>
    <div class="container">
        <h1>Detail Keluarga Penerimaan Bantuan Sosial</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor Keluarga</th>
                    <th>Nama Kepala Keluarga</th>
                    <th>Nama Kriteria</th>
                    <th>Nilai Kriteria</th>
                </tr>
            </thead>
            <tbody>
                <td>{{ $detail[0]->nomor_keluarga }}</td>
                <td>{{ $detail[0]->nama_kepala_keluarga }}</td>
                @foreach ($detail as $data)
                <tr>
                    <td>{{ $data->nama_kriteria }}</td>
                    <td>{{ $data->nilai_kriteria }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
