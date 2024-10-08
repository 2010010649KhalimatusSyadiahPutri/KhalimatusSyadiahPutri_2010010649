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
                <div>
                    <a href="{{ route('admin.cetakGabungan') }}" class="btn btn-warning btn-sm">Cetak Laporan Gabungan</a>
                </div>
            </div>

            <div class="section-body">
                @include('components.alert')
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-9">
                                    <input type="search" name="search" id="search" class="form-control"
                                        value="{{ request()->get('search') ?? '' }}" placeholder="Cari">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route(auth()->user()->position->name . '.keuangan.operasional.create') }}"
                                        class="btn btn-success btn-block">Berikan Dana</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Dana</th>
                                        <th>Total Dana</th>
                                        <th>Deskripsi</th>
                                        <th>Petugas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @forelse($data as $key => $dt)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $dt->date }}</td>
                                        <td>{{ $dt->type }}</td>
                                        <td class="text-right">{{ number_format($dt->total, 0) }}</td>
                                        <td>{{ $dt->description }}</td>
                                        <td>{{ $dt->user->name ?? '' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route(auth()->user()->position->name . '.keuangan.operasional.edit', $dt) }}"
                                                class="btn btn-success m-2">Edit Data</a>
                                            <form method="post"
                                                action="{{ route(auth()->user()->position->name . '.keuangan.operasional.destroy', $dt) }}"
                                                class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger m-2">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </table>
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
