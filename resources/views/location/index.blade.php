@extends('layouts.admin')

@section('title', $title ?? '')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1 class="d-inline-block">{{ $title ?? 'ini title kosong' }}</h1>
            </div>

            <div class="section-body">

                @include('components.alert')

                <div class="card">
                    <div class="card-header">
                        <p>{{ $title ?? '' }}</p>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="table-location">
                            <thead>
                                <tr class="text-center">
                                    <th>Provinsi</th>
                                    <th>Kota / Kabupaten</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan / Desa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <th>No</th>--}}
{{--                                <th>Nama</th>--}}
{{--                                <th>Aksi</th>--}}
{{--                            </tr>--}}
{{--                            @forelse($data as $key => $user)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$key + 1}}</td>--}}
{{--                                    <td>{{$user->name}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{ url('danramil/pangkat/' . $user->id . '/edit') }}" class="btn btn-success">Edit Data</a>--}}

{{--                                        <form method="post" action="{{ url('danramil/pangkat/' . $user->id . '/delete') }}">--}}
{{--                                            @method('DELETE')--}}
{{--                                            @csrf--}}
{{--                                            <button type="submit" class="btn btn-danger">Hapus</button>--}}
{{--                                        </form>--}}

{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @empty--}}
{{--                            @endforelse--}}
{{--                        </table>--}}
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <script>
        let url = '';

        window.onload = function () {
            getLokasiTable();
        }

        function getLokasiTable(param = '')
        {
            $.ajax({
                url: "{{ url('admin/lokasi/ajax') }}" + param,
                type: 'GET',
                dataType: 'json',
                async: false,
                success: function(data) {
                    let html = "";
                    data.table.forEach(function (item) {
                        let getCityParam = "?wilayah[cities][province_code]=" + item.province.code;
                        let getDistrictParam = getCityParam + '&wilayah[districts][city_code]=' + (item.city == null ? null : item.city.code);
                        let getVillageParam = getDistrictParam + '&wilayah[villages][district_code]=' + (item.district == null ? null : item.district.code);

                        html += '<tr>';
                        html += '<td onclick="getLokasiTable(\''+getCityParam+'\')">'+item.province.name+'</td>';
                        html += '<td onclick="getLokasiTable(\''+getDistrictParam+'\')">'+(item.city == null ? '' : item.city.name)+'</td>';
                        html += '<td onclick="getLokasiTable(\''+getVillageParam+'\')">'+(item.district == null ? '' : item.district.name)+'</td>';
                        html += '<td>'+(item.village == null ? '' : item.village.name)+'</td>';
                        html += '<td></td>';
                        html += '</tr>';
                    })
                    $('#table-location tbody').html(html)
                },
                fail: function (err) {
                    console.log(err)
                }
            })

        }
    </script>

    <!-- Page Specific JS File -->
@endpush
