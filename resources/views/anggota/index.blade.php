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
                <h1>{{ $title ?? 'Ini Title Kosong' }}</h1>
            </div>

            <div class="section-body">
                @include('components.alert')

                <div class="card">
                    {{-- <div class="card-header">
                        <p>Daftar Anggota</p>
                    </div> --}}
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-md-9">
                                    <input type="search" name="search[name]" id="search" class="form-control"
                                        placeholder="Cari Anggota" value="{{ request()->get('search')['name'] ?? '' }}">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.anggota.create') }}" class="btn btn-success btn-block">Tambah
                                        Anggota</a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Lengkap</th>
                                        <th>NRP</th>
                                        <th>Email</th>
                                        <th>Telpon</th>
                                        <th>Pangkat</th>
                                        <th>Jabatan</th>
                                        <th>Kecabangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->fullname }}</td>
                                            <td>{{ $user->nrp }}</td>
                                            <td>{{ $user->email ?? '' }}</td>
                                            <td>{{ $user->phone_number ?? '' }}</td>
                                            <td>{{ $user->rank->name ?? '' }}</td>
                                            <td>{{ $user->position->name ?? '' }}</td>
                                            <td>{{ $user->branching->name ?? '' }}</td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.anggota.edit', $user) }}"
                                                        class="btn btn-success">Edit Data</a>
                                                    <form method="post"
                                                        action="{{ route('admin.anggota.destroy', $user) }}"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Apakah Kamu Yakin Menghapus Ini?');">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak Ada Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $data->links() }}
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
