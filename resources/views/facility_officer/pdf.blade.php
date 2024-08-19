<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Fasilitas {{ \Carbon\Carbon::now()->format('Y-m-d') }}</title>

    <style>
        table {
            width: 100%;
        }

        table,
        tr,
        th,
        td {
            border: 0.5px solid #333333;
        }

        th,
        td {
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <div style="width: fit-content; border-bottom: 1px solid #333333; width: 60%; margin-bottom: 2rem;">
        <h3 style="margin: 0;">KOMANDO DISTRIK MILITER 1011/KUALA KAPUAS</h3>
        <h3 style="margin: 0;">KOMANDO RAYON MILITER 1011-11/KUALA KAPUAS</h3>
    </div>
    <h2 class="text-center">Laporan Fasilitas Petugas</h2>
    <hr>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Jenis</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Petugas</th>
                <th>Waktu Perawatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $dt)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $dt->type ?? '' }}</td>
                    <td>{{ $dt->name ?? '' }}</td>
                    <td>{{ $dt->description ?? '' }}</td>
                    <td class="text-center">{{ $dt->quantity ?? '' }}</td>
                    <td class="text-center">{{ $dt->condition ?? '' }}</td>
                    <td>{{ $dt->officer->name ?? '' }}</td>
                    <td>{{ $dt->maintenance_time ?? '' }}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    <br>

    <div id="detailProgram" class="mb-4" style="text-align: center; position: absolute; right: 0; width: 200px;">

        <p style="margin: 0; text-align: center; "> Kapuas Hulu, {{ \Carbon\Carbon::now()->format('d F Y') }}

        </p>
        <br>
        <br>
        <br>
        <br>
        <p style="margin: 0;">Suherman
            <br> Kpt Kav NRP 789123456
        </p>

    </div>
</body>

</html>
