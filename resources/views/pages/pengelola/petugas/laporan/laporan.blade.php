<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Id Lelang</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                    Nama Barang</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Tanggal</th>

                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Harga Awal</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Harga Akhir</th>


                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Pemenang</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Action</th>
                <th class="text-secondary opacity-7"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataLelang as $lelang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lelang->id_lelang }}</td>
                    <td>
                        {{ $lelang->barang->nama_barang }}
                    </td>

                    <td>{{ $lelang->tanggal_lelang }}</td>
                    <td>
                        {{ $lelang->barang->harga_awal }}
                    </td>

                    <td>{{ $lelang->harga_akhir }}</td>
                    <td>
                        {{ $lelang->user->name ?? 'belum ada pemenang' }}
                    </td>

                    <td>{{ $lelang->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
