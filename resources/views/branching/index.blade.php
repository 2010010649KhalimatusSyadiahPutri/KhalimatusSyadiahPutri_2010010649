@extends('layouts.admin')

@section('title', $title ?? '')

@push('style')
    <!-- CSS Libraries -->
    <style>
        .table th,
        .table td {
            vertical-align: :middle;
            text-align: center;
        }

        .table-actions {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .search-form .from-control {
            width: calc(100% -90px);
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
                                <div class="col-9">
                                    <input type="search" name="search[name]" id="search" class="form-control"
                                        value="{{ request()->get('search')['name'] ?? '' }}" placeholder="Cari Pangkat">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.branching.create') }}" class="btn btn-success btn-block">Tambah
                                        Kecabangan</a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $dt)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dt->name ?? '' }}</td>
                                            <td>
                                                <div class="table-action">
                                                    <a href="{{ route('admin.branching.edit', $dt) }}"
                                                        class="btn btn-success">
                                                        Edit
                                                    </a>

                                                    <form method="post"
                                                        action="{{ route('admin.branching.destroy', $dt) }}"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus Data Ini?');">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan = "3" class="text-center">Tidak Ada Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="row">
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
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
