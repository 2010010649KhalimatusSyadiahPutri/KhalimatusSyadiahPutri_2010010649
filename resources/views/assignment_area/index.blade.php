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

        .table td.text-left {
            text-align: left;
        }

        .table-actions {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .search-form .form-control {
            width: 100%;
        }

        .card-body {
            padding: 2rem;
        }

        .btn-block {
            padding: 0.75rem 1.5rem;
        }

        .section-header {
            background-color: #f7f7f7;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .table {
            margin-top: 1.5rem;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>{{ $title ?? 'Judul Tidak Tersedia' }}</h1>
            </div>

            <div class="section-body">
                @include('components.alert')

                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3" method="GET" action="{{ route('admin.assignment-area.index') }}">
                                <div class="col-md-5">
                                    <input type="search" name="search" id="search" class="form-control"
                                        placeholder="Cari Nomor Petugas atau Wilayah Penugasan">
                                </div>

                                <div class="col-md-3">
                                    <select name="year" id="year" class="form-control">
                                        <option value="">-- Pilih Tahun --</option>
                                        @for ($i = date('Y'); $i >= 2010; $i--)
                                            <option value="{{ $i }}"
                                                {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                                <div class="col-md-2 text-right">
                                    <a href="{{ route('admin.assignment-area.index', ['cetak' => 1, 'year' => request('year')]) }}"
                                        class="btn btn-outline-success btn-block">
                                        <i class="fas fa-print"></i> Cetak Laporan
                                    </a>
                                </div>
                                <div class="col-md-2 text-right">
                                    <a href="{{ route('admin.assignment-area.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pimpinan</th>
                                        <th>Petugas</th>
                                        <th>Kecamatan</th>
                                        <th>Jumlah Populasi</th>
                                        <th>Jumlah Kepala Keluarga</th>
                                        <th>Jumlah Laki-Laki</th>
                                        <th>Jumlah Perempuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $dt)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-left">{{ $dt->pimpinan->fullname ?? '' }}</td>
                                            <td class="text-left">{{ $dt->anggota->fullname ?? ($dt->anggota->name ?? '') }}
                                            </td>
                                            <td class="text-left">{{ $dt->district->name ?? '' }}</td>
                                            <td>{{ $dt->total_population ?? '' }}</td>
                                            <td>{{ $dt->total_head_of_family ?? '' }}</td>
                                            <td>{{ $dt->total_of_male ?? '' }}</td>
                                            <td>{{ $dt->total_of_female ?? '' }}</td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.assignment-area.edit', $dt) }}"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form method="post"
                                                        action="{{ route('admin.assignment-area.destroy', $dt) }}"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col">
                                    {!! $data->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
@endpush
