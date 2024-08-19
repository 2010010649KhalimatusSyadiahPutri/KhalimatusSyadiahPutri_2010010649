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
                    {{-- <div class="card-header">
                        <p>{{ $title ?? '' }}</p>
                    </div> --}}
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-7">
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-2">
                                    <a href="{{ route(auth()->user()->position->name . '.absensi.index', ['cetak' => 1]) }}"
                                        class="btn btn-outline-success btn-block">Cetak Rekap Absensi</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route(auth()->user()->position->name . '.absensi.create') }}"
                                        class="btn btn-success btn-block">Absensi</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal dan Waktu</th>
                                        <th class="text-center">Petugas</th>
                                        <th class="text-center">Pangkat</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Keterangan</th>
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
                                            <td class="text-center">{{ $dt->status ?? '' }}</td>
                                            <td>{{ $dt->notes ?? '' }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="row">
                                {!! $data->links() !!}
                            </div>
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
