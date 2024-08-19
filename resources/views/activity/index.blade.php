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
                {{-- <div>
                    <a href="{{ url('danramil/anggota/create') }}" class="btn btn-primary btn-sm">Tambah Anggota</a>
                    <a href="{{ url('danramil/anggota/export-excel') }}" class="btn btn-success btn-sm">Export Anggota</a>
                    <a href="{{ url('danramil/anggota/print-pdf') }}" class="btn btn-warning btn-sm">Cetak PDF</a>
                </div> --}}
            </div>

            <div class="section-body">

                @include('components.alert')

                <div class="card">
                    <div class="card-header">
                        <p>Daftar Kegiatan Petugas</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-7">
                                    <input type="search" name="search" id="search" class="form-control" placeholder="Cari Kegiatan">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route(auth()->user()->position->name . '.activity.create') }}" class="btn btn-success btn-block">Tambah Kegiatan</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route(auth()->user()->position->name . '.activity.index', ['cetak' => 1]) }}" class="btn btn-danger btn-block">Cetak Kegiatan</a>
                                </div>
                            </form>
                        </div>

                    
                        <table class="table table-bordered">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jenis Kegiatan</th>
                                <th>Nama Anggota</th>
                                <th>Deskripsi</th>
                                <th>Lampiran</th>
                                <th>Aksi</th>
                            </tr>
                            @forelse($data as $key => $dt)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $dt->date }}</td>
                                    <td>{{ $dt->type }}</td>
                                    <td>{{  $dt->user->name ?? ''  }}</td>
                                    <td>{{ $dt->description ?? '' }}</td>
                                    <td>
                                        <img src="{{ $dt->image_url ?? '' }}" alt="{{ $dt->image_url }}" srcset="" class="img-thumbnail">
                                    </td>
                                    <td>
                                        <a href="{{ route(auth()->user()->position->name . '.activity.edit', $dt) }}" class="btn btn-success">Edit Data</a>

                                        <form method="post" action="{{ route(auth()->user()->position->name . '.activity.destroy', $dt) }}" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>

                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </table>

                        {{ $data->links() }}
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
