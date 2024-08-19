<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Anggota {{ \Carbon\Carbon::now()->format('Y-m-d') }}</title>

    <style>
        table {
            width: 100%;
        }

        table, tr, th, td {
            border: 0.5px solid #333333;
        }

        th, td {
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

    </style>
</head>
<body>

    <h2 class="text-center">Laporan Data Anggota Periode {{ \Carbon\Carbon::now()->format('d M Y') }}</h2>

    <hr>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Posisi</th>
                <th>Pangkat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataUrut as $index => $anggota)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $anggota->name ?? '' }}</td>
                    <td>{{ $anggota->email ?? '' }}</td>
                    <td class="text-center">{{ $anggota->position->name ?? '' }}</td>
                    <td class="text-center">{{ $anggota->rank->name ?? 'anggota biasa' }}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</body>
</html>
