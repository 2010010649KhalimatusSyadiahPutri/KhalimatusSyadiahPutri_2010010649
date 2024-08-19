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

    <h2 class="text-center">Laporan Penugasan Petugas</h2>
    {{-- <h3 class="text-center">Koramil Kapuas Hulu, Sei Hanyu, Kec. Kapuas Hulu, Kabupaten Kapuas, Kalimantan
        Tengah </h3> --}}

    <hr>

    <table>
        <thead>
            <tr class="table-header text-center">
                <th class="text-center">No</th>
                <th class="text-center">Nama Pimpinan</th>
                <th class="text-center">Nama Petugas</th>
                <th class="text-center">Nama Kecamatan</th>
                <th class="text-center">Jumlah Populasi</th>
                <th class="text-center">Jumlah Kepala Keluarga</th>
                <th class="text-center">Jumlah Laki-Laki</th>
                <th class="text-center">Jumlah Perempuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $key => $dt)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $dt->pimpinan->fullname ?? '' }}</td>
                    <td>{{ $dt->anggota->fullname ?? ($dt->anggota->name ?? '') }}</td>
                    <td>{{ $dt->district->name ?? '' }}</td>
                    <td class="text-center">{{ $dt->total_population ?? '' }}</td>
                    <td class="text-center">{{ $dt->total_head_of_family ?? '' }}</td>
                    <td class="text-center">{{ $dt->total_of_male ?? '' }}</td>
                    <td class="text-center">{{ $dt->total_of_female ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>

    <div id="detailProgram" class="mb-4; signature" style="text-align: center; position: absolute; right: 0; ">

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
