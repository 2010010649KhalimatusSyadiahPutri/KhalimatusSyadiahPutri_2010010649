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
    <h2 class="text-center">Laporan Bencana Alam</h2>

    <hr>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Bencana</th>
                <th>Wilayah</th>
                <th>Petugas</th>
                <th class="text-center">Korban Jiwa</th>
                <th class="text-center">Laki-Laki</th>
                <th class="text-center">Perempuan</th>
                <th class="text-center">Anak-Anak</th>
                <th class="text-center">Remaja</th>
                <th class="text-center">Dewasa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $dt)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $dt->time ?? '' }}</td>
                    <td>{{ $dt->disaster_type ?? '' }}</td>
                    <td>{{ $dt->assignment_area->district->name ?? '' }}</td>
                    <td>{{ $dt->officer->fullname ?? '' }}</td>
                    <td class="text-center">{{ $dt->fatalities ?? '' }}</td>
                    <td class="text-center">{{ $dt->fatality_of_males ?? '' }}</td>
                    <td class="text-center">{{ $dt->fatality_of_females ?? '' }}</td>
                    <td class="text-center">{{ $dt->children ?? '' }}</td>
                    <td class="text-center">{{ $dt->elderly ?? '' }}</td>
                    <td class="text-center">{{ $dt->mature ?? '' }}</td>
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
