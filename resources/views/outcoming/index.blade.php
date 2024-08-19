@extends('layouts.admin')

@section('title', $title ?? '')

@push('style')
    <!-- CSS Libraries -->
    {{-- <style>
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
            width: calc(100% - 90px);
        }

        .search-form .btn {
            width: 80px;
        }
    </style> --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>{{ $title ?? 'ini title kosong' }}</h1>
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
                                <div class="col-md-7">
                                    <input type="search" name="search[reference_number]" id="search" class="form-control"
                                        placeholder="Cari Nomor Surat Keluar">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.outcoming-letter.index', ['cetak' => 1]) }}"
                                        class="btn btn-outline-success btn-block">Cetak Agenda Surat Keluar</a>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.outcoming-letter.create') }}"
                                        class="btn btn-success btn-block">Tambah Surat Keluar</a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>Penerima</th>
                                        <th>Pengirim</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $dt)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $dt->reference_number ?? '' }}</td>
                                            <td class="text-center">{{ $dt->date ?? '' }}</td>
                                            <td>{{ $dt->purpose ?? '' }}</td>
                                            <td>{{ $dt->to ?? '' }}</td>
                                            <td>{{ $dt->sender ?? '' }}</td>
                                            <td>
                                                <div class="table-actions">
                                                    <a href="{{ route('admin.outcoming-letter.edit', $dt) }}"
                                                        class="btn btn-success m-1 ">Edit</a>


                                                    <form method="post"
                                                        action="{{ route('admin.outcoming-letter.destroy', $dt) }}"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?' )">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger m-1">Hapus</button>
                                                    </form>

                                                    <a href="{{ route('admin.outcoming-letter.show', $dt) }}"
                                                        class="btn btn-primary m-1 ">
                                                        Detail
                                                    </a>

                                                    <a href="{{ route('admin.outcoming-letter.show', $dt) }}?cetak=1"
                                                        class="btn btn-info m-1">
                                                        Cetak Surat
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data surat keluar.</td>
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

    <!-- Page Specific JS File -->
@endpush
