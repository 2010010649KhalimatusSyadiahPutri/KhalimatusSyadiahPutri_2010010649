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
                    <a href="{{ url('danramil/jabatan/create') }}" class="btn btn-primary btn-sm">Tambah jabatan</a>
                    <a href="{{ url('danramil/jabatan/export-excel') }}" class="btn btn-success btn-sm">Export jabatan</a>
                    <a href="{{ url('danramil/jabatan/print-pdf') }}" class="btn btn-warning btn-sm">Cetak PDF</a>
                </div> --}}
            </div>

            <div class="section-body">

                @include('components.alert')

                <div class="card">
                    {{-- <div class="card-header">
                        <p>Pendataan Kegiatan Anggota</p>
                    </div> --}}
                    <div class="card-body">

                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-7">
                                    <input type="search" name="search[title]" id="search" class="form-control"
                                        placeholder="Cari Kegiatan" value="{{ request()->get('search')['title'] ?? '' }}">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.pendataan-kegiatan.index', ['cetak' => 1]) }}"
                                        class="btn btn-outline-success btn-block">Cetak Laporan Kegiatan</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.pendataan-kegiatan.create') }}"
                                        class="btn btn-success btn-block">Tambah Laporan Kegiatan</a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Nama Anggota</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                @forelse($data as $key => $activity)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $activity->tanggal ?? '' }}</td>
                                        <td>{{ $activity->jenis ?? '' }}</td>
                                        <td>{{ $activity->user->fullname ?? '' }}</td>
                                        <td>{{ $activity->deskripsi ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('admin.pendataan-kegiatan.edit', $activity) }}"
                                                class="btn btn-success m-1">Edit Data</a>

                                            <form method="post"
                                                action="{{ route(auth()->user()->position->name . '.pendataan-kegiatan.destroy', $activity) }}"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger m-1">Hapus</button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
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

    <script>
        $('#modalActivity').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var activityId = button.data('id');

            var modal = $(this)
            modal.find('.modal-body #activity_id').val(activityId)
        });
    </script>

    <!-- Page Specific JS File -->
@endpush
