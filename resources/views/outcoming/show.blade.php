@extends('layouts.admin')

@section('title', $title ?? '')

@push('style')
    <!-- CSS Libraries -->
    <style>
        .table:not(.table-sm):not(.table-md):not(.dataTable) th, 
        .table:not(.table-sm):not(.table-md):not(.dataTable) td {
            vertical-align: top;
        }
    </style>
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

                        <table class="table">
                            <tr>
                                <th style="width: 150px">Jenis Surat</th>
                                <td style="width: 5px;">:</td>
                                <td>{{ $data->type ?? '' }}</td>
                                <th style="width: 200px">No Surat</th>
                                <td style="width: 5px;">:</td>
                                <td>{{ $data->reference_number ?? '' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Tanggal Surat</th>
                                <td>:</td>
                                <td>{{ $data->date ?? '' }}</td>
                                <th style="width: 150px">Bertanda Tangan</th>
                                <td style="width: 5px;">:</td>
                                <td>{{ $data->signature->fullname ?? '' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Menimbang</th>
                                <td style="width: 20px;">:</td>
                                <td>{!! $data->review_content ?? ''!!}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Dasar</th>
                                <td>:</td>
                                <td>{!! $data->base_content ?? '' !!}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Kepada</th>
                                <td style="width: 20px;">:</td>
                                <td>{!! $data->to ?? ''!!}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Untuk</th>
                                <td>:</td>
                                <td>{!! $data->purpose ?? '' !!}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px">Tembusan</th>
                                <td>:</td>
                                <td>Tembusan : <br>{!! $data->copy_of_letters ?? '' !!}</td>
                            </tr>
                        </table>

                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
