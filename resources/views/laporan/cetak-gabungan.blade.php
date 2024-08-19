<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Gabungan {{ \Carbon\Carbon::now()->format('Y-m-d') }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h3,
        h2 {
            margin: 0;
            padding: 0;
        }

        .header-title {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        hr {
            margin: 20px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            margin-top: 40px;
            margin-bottom: 10px;
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

        th.text-center,
        td.text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .signature {
            text-align: center;
            position: absolute;
            right: 0;
            bottom: 50px;
            transform: translateX(50%);
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div style="width: fit-content; border-bottom: 1px solid #333333; width: 60%; margin-bottom: 2rem;">
        <h3 style="margin: 0;">KOMANDO DISTRIK MILITER 1011/KUALA KAPUAS</h3>
        <h3 style="margin: 0;">KOMANDO RAYON MILITER 1011-11/KUALA KAPUAS</h3>
    </div>

    <h2>Laporan Gabungan Dana Masuk dan Dana Keluar</h2>

    <hr>

    <h3>Pengelolaan Dana Masuk</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Dana</th>
                <th class="text-right">Total Dana</th>
                <th>Deskripsi</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataMasuk as $key => $dt)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $dt->date }}</td>
                    <td>{{ $dt->type }}</td>
                    <td class="text-right">{{ number_format($dt->total, 0) }}</td>
                    <td>{{ $dt->description }}</td>
                    <td>{{ $dt->user->name ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>Pengeluaran Dana</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Anggaran</th>
                <th>Jenis</th>
                <th class="text-right">Total</th>
                <th>Deskripsi</th>
                <th>Laporan</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataKeluar as $key => $dt)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $dt->date }}</td>
                    <td>{{ $dt->sumber_dana->type ?? '' }}</td>
                    <td>{{ $dt->type }}</td>
                    <td class="text-right">{{ number_format($dt->total, 0) }}</td>
                    <td>{{ $dt->description }}</td>
                    <td class="text-center">
                        <a href="{{ $dt->report_link }}">Download</a>
                    </td>
                    <td>{{ $dt->user->name ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div id="detailProgram" class="mb-4" style="text-align: center; position: absolute; right: 0; width: 200px;">

        <p style="margin: 0; text-align: left; "> Kapuas Hulu,{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <br>
        <br>
        <br>
        <br>
        <p style="margin: 0;">Suherman
            <br> Kpt Kav NRP 789123456
        </p>
</body>

</html>
