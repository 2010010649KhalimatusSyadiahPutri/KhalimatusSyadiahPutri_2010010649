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
                        <p>Pengelolaan Dana</p>
                    </div> --}}
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-7">
                                    <input type="search" name="search[jenis]" id="search" class="form-control"
                                        placeholder="Cari Data" value="{{ request()->get('search')['title'] ?? '' }}">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.pengelolaan-dana.index', ['cetak' => 1]) }}"
                                        class="btn btn-outline-success btn-block">Cetak Laporan Pengelolaan Dana</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.pengelolaan-dana.create') }}"
                                        class="btn btn-success btn-block">Tambah Laporan Pengelolaan Dana</a>
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
                                        <th class="text-center">Nominal</th>
                                        <th class="text-center">Deksripsi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $key => $dt)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $dt->tanggal ?? '' }}</td>
                                            <td>{{ $dt->jenis ?? '' }}</td>
                                            <td class="text-center">{{ $dt->nominal ?? '' }}</td>
                                            <td>{{ $dt->keterangan ?? '' }}</td>
                                            <td>
                                                <div class="table-actions text-center">
                                                    <a href="{{ route('admin.pengelolaan-dana.edit', $dt) }}"
                                                        class="btn btn-success m-1">Edit Data</a>

                                                    <form method="post"
                                                        action="{{ route(auth()->user()->position->name . '.pengelolaan-dana.destroy', $dt) }}"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger m-1">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada Data</td>
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
