<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda Surat Keluar</title>

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

    <h2 class="text-center">Agenda Surat Keluar</h2>

    <hr>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>No Surat</th>
                <th>Tanggal</th>
                <th>Perihal</th>
                <th>Penerima</th>
                <th>Pengirim</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $dt)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $dt->reference_number ?? '' }}</td>
                    <td>{{ $dt->date ?? '' }}</td>
                    <td>{{ $dt->purpose ?? '' }}</td>
                    <td>{{ $dt->to ?? '' }}</td>
                    <td>{{ $dt->sender ?? '' }}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>

    <br>

    <div id="detailProgram" class="mb-4" style="text-align: center; position: absolute; right: 0; width: 200px;">

        <p style="margin: 0; text-align: left; "> Kapuas Hulu,{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
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
