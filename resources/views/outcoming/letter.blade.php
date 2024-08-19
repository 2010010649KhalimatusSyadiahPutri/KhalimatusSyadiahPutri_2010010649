<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat {{ $data->reference_number ?? '' }}</title>

    <style>
        body {
            font-family: serif;
            font-size: 10pt;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
        }

        th,
        td {
            padding: 10px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .d-inline {
            display: inline;
        }

        .text-center {
            text-align: center;
        }

        p {
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>

    <div style="width: fit-content; border-bottom: 1px solid #333333; width: 60%; margin-bottom: 2rem;">
        <h3>KOMANDO DISTRIK MILITER 1011/KUALA KAPUAS</h3>
        <h3>KOMANDO RAYON MILITER 1011-11/KUALA KAPUAS</h3>
    </div>

    <div class="text-center" style="margin-bottom: 2rem;">
        <h3>{{ Str::upper($data->type ?? '') }}</h3>
        <h3>NOMOR: {{ Str::upper($data->reference_number ?? '') }}</h3>
    </div>

    <table>
        <tr>
            <td class="text-left" style="width: 150px">Menimbang</td>
            <td style="width: 20px;">:</td>
            <td>{!! $data->review_content ?? '' !!}</td>
        </tr>
        <tr>
            <td class="text-left" style="width: 150px">Dasar</td>
            <td>:</td>
            <td>{!! $data->base_content ?? '' !!}</td>
        </tr>
    </table>
    <div class="text-center" style="margin-bottom: 2rem;margin-top: 2rem;">
        <h3>MENYATAKAN</h3>
    </div>
    <table>
        <tr>
            <td class="text-left" style="width: 150px">Kepada</td>
            <td style="width: 20px;">:</td>
            <td>{!! $data->to ?? '' !!}</td>
        </tr>
        <tr>
            <td class="text-left" style="width: 150px">Untuk</td>
            <td>:</td>
            <td>{!! $data->purpose ?? '' !!}</td>
        </tr>
    </table>
    <p style="padding-left: 12px;">Selesai.</p>
    <table style="width: 100%">
        <tr>
            <td style="width: 25%">

            </td>
            <td style="width: 25%">

            </td>
            <td>
                <p>Dikeluarkan di Kapuas Hulu</p>
                <p><u>Pada Tanggal, {{ Carbon\Carbon::parse($data->date)->format('d M Y') }}</u></p>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <p class="text-center">{{ Str::upper($data->signature->fullname ?? '') }}</p>
                <p class="text-center">{{ Str::upper($data->signature->rank->name ?? '') }}
                    {{ Str::upper($data->signature->branching->name ?? '') }} NRP {{ $data->signature->nrp ?? '' }}</p>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            {{-- <td class="text-left" style="width: 150px">Tembusan</td>
            <td>:</td> --}}
            <td>Tembusan : <br>{!! $data->copy_of_letters ?? '' !!}</td>
        </tr>
    </table>
</body>

</html>
