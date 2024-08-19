<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kehadiran Petugas {{ \Carbon\Carbon::now()->format('Y-m-d') }}</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
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
            text-align: left;
            /* Default text alignment */
        }

        th.text-center,
        td.text-center {
            text-align: center;
            /* Center text alignment for specific columns */
        }

        .text-center {
            text-align: center;
        }

        .table-header {
            font-weight: bold;
        }
    </style>
</head>


<body>
    <div style="width: fit-content; border-bottom: 1px solid #333333; width: 60%; margin-bottom: 2rem;">
        <h3 style="margin: 0;">KOMANDO DISTRIK MILITER 1011/KUALA KAPUAS</h3>
        <h3 style="margin: 0;">KOMANDO RAYON MILITER 1011-11/KUALA KAPUAS</h3>
    </div>
    <h2 class="text-center">Laporan Keharidan Petugas</h2>

    <hr>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal dan Waktu</th>
                <th>Petugas</th>
                <th>Pangkat</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $dt)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($dt->created_at) }}</td>
                    <td>{{ $dt->user->fullname ?? ($dt->user->name ?? '') }}</td>
                    <td>{{ $dt->user->position->name ?? '' }}</td>
                    <td>{{ $dt->user->rank->name ?? '' }}</td>
                    <td>{{ $dt->status ?? '' }}</td>
                    <td>{{ $dt->notes ?? '' }}</td>
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
