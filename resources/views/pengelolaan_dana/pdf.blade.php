<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Anggota {{ \Carbon\Carbon::now()->format('Y-m-d') }}</title>

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

    <h2>Laporan Pengelolaan Dana</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Deskripsi</th>
        </tr>
        @forelse($data as $key => $activity)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $activity->tanggal ?? '' }}</td>
                <td>{{ $activity->jenis ?? '' }}</td>
                <td>{{ $activity->nominal ?? '' }}</td>
                <td>{{ $activity->keterangan ?? '' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Data tidak tersedia</td>
            </tr>
        @endforelse
    </table>


    <div class="signature; mb-4;" style="text-align:center; position:absolute; right:0;">
        <p>Kapuas Hulu, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <br><br><br>
        <p>Suherman</p>
        <p>Kpt Kav NRP 789123456</p>
    </div>

    {{-- <div class="signature" id="detailProgram" class="mb-4"
            style="text-align: center; position: absolute; right: 0; width: 200px;">
            <p>Kapuas Hulu, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            <p class="name text-center">Suherman<br>Kpt Kav NRP 789123456</p>
        </div> --}}
</body>

</html>
