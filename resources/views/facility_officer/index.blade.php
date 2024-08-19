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
                <h1>{{ $title ?? 'Title Kosong' }}</h1>
            </div>

            <div class="section-body">
                @include('components.alert')

                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title ?? '' }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3 align-items-end">
                                <div class="col-md-7">
                                    <input type="search" name="search[name]" id="search" class="form-control"
                                        placeholder="Cari Nama Fasilitas">
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
                                {{-- <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                                </div> --}}

                                <div class="col-md-2">
                                    <a href="{{ route('admin.facility-officer.index', ['cetak' => 1, 'year' => request('year')]) }}"
                                        class="btn btn-outline-success w-100">
                                        <i class="fas fa-print"></i> Cetak
                                    </a>
                                </div>

                                <div class="col-md-2">
                                    <a href="{{ route('admin.facility-officer.create') }}" class="btn btn-success w-100">
                                        <i class="fas fa-plus"></i> Tambah Fasilitas
                                    </a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Kondisi</th>
                                        <th>Petugas</th>
                                        <th>Waktu Perawatan</th>
                                        <th>Gambar</th> <!-- Kolom baru untuk file -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $dt)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dt->type ?? '' }}</td>
                                            <td>{{ $dt->name ?? '' }}</td>
                                            <td>{{ $dt->description ?? '' }}</td>
                                            <td>{{ $dt->quantity ?? '' }}</td>
                                            <td>{{ $dt->condition ?? '' }}</td>
                                            <td>{{ $dt->officer->name ?? '' }}</td>
                                            <td>{{ $dt->maintenance_time ?? '' }}</td>
                                            <td>
                                                @if ($dt->image)
                                                    <img src="{{ asset('storage/' . $dt->image) }}" alt="Image"
                                                        style="max-width: 100px;">
                                                @else
                                                    Tidak ada file
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.facility-officer.edit', $dt) }}"
                                                    class="btn btn-sm btn-success">
                                                    Edit
                                                </a>
                                                <form method="post"
                                                    action="{{ route('admin.facility-officer.destroy', $dt) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Data fasilitas belum tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {!! $data->links() !!}
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
