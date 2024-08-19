@extends('layouts.admin')

@section('title', $title ?? '')

@push('style')
    <!-- CSS Libraries -->
    <style>
        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table-actions {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .search-form .form-control {
            width: calc(100% - 90px);
        }

        .search-form .btn {
            width: 80px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1 class="d-inline-block">{{ $title ?? 'Ini title kosong' }}</h1>
                {{-- <div>
                    <a href="{{ url('danramil/pangkat/export-excel') }}" class="btn btn-success btn-sm">Export Pangkat</a>
                    <a href="{{ url('danramil/pagkat/print-pdf') }}" class="btn btn-warning btn-sm">Cetak PDF</a>
                </div> --}}
            </div>

            <div class="section-body">

                @include('components.alert')

                <div class="card">
                    {{-- <div class="card-header">
                        <h4>Pangkat Anggota</h4>
                    </div> --}}
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-md-9">
                                    <input type="search" name="search[name]" id="search" class="form-control"
                                        value="{{ request()->get('search')['name'] ?? '' }}" placeholder="Cari Pangkat">
                                </div>

                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary btn-block">Cari</button>
                                </div>

                                <div class="col-md-2">
                                    <a href="{{ route('admin.rank.create') }}" class="btn btn-success btn-block">Tambah
                                        Pangkat</a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pangkat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.rank.edit', $user) }}"
                                                        class="btn btn-warning btn-sm">Edit Data</a>

                                                    <form method="post" action="{{ route('admin.rank.destroy', $user) }}"
                                                        class="d-inline-block"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->

    <!-- Page Specific JS File -->
@endpush
