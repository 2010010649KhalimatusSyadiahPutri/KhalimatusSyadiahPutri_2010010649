<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kegiatan Publik {{ \Carbon\Carbon::now()->format('Y-m-d') }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header-title {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        .header-title h3 {
            margin: 0;
            font-size: 18px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin: 20px 0;
        }

        hr {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td.text-center {
            text-align: center;
        }

        .signature {
            text-align: right;
            margin-top: 40px;
            margin-right: 50px;
        }

        .signature p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div style="width: fit-content; border-bottom: 1px solid #333333; width: 60%; margin-bottom: 2rem;">
        <h3 style="margin: 0;">KOMANDO DISTRIK MILITER 1011/KUALA KAPUAS</h3>
        <h3 style="margin: 0;">KOMANDO RAYON MILITER 1011-11/KUALA KAPUAS</h3>
    </div>

    <h2>Laporan Kegiatan Publik</h2>

    <hr>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Kegiatan</th>
                <th>Keterangan</th>
                <th>Wilayah</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $dt)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $dt->time ?? '' }}</td>
                    <td>{{ $dt->title ?? '' }}</td>
                    <td>{{ $dt->description ?? '' }}</td>
                    <td>{{ $dt->assignment_area->district->name ?? '' }} -
                        {{ $dt->assignment_area->anggota->name ?? '' }}</td>
                    <td>{{ $dt->officer->name ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature" style="text-align:right;">
        <p>Kapuas Hulu, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <br><br><br>
        <p class="text-center">Suherman
            <br> Kav NRP 789123456
        </p>
    </div>
</body>

</html>
