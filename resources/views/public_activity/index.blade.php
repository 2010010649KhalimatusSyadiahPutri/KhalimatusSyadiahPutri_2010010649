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
                        <p>jabatan Anggota</p>
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
                                    <a href="{{ route('admin.public-activity.index', ['cetak' => 1]) }}"
                                        class="btn btn-outline-success btn-block">Cetak Laporan Kegiatan</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.public-activity.create') }}"
                                        class="btn btn-success btn-block">Tambah Laporan Kegiatan</a>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Wilayah</th>
                                        <th>Petugas</th>
                                        <th>Lampiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @forelse($data as $key => $activity)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $activity->time ?? '' }}</td>
                                        <td>{{ $activity->title ?? '' }}</td>
                                        <td>{{ $activity->description ?? '' }}</td>
                                        <td>
                                            <ul style="margin-left: 0; padding-left:0;">
                                                @foreach ($activity->histories()->get() as $history)
                                                    <li>{{ Str::ucfirst($history->status) }}
                                                        ({{ $history->created_at }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <button class="btn btn-outline-secondary btn-sm my-2" data-toggle="modal"
                                                data-id="{{ $activity->id }}" data-target="#modalActivity">Tambah
                                                Status
                                                Kegiatan Terakhir</button>
                                        </td>
                                        <td>{{ $activity->assignment_area->district->name ?? '' }} -
                                            {{ $activity->assignment_area->anggota->name ?? '' }}</td>
                                        <td>{{ $activity->officer->name ?? '' }}</td>
                                        <td class="py-2" style="white-space: nowrap">
                                            @foreach ($activity->attachments()->get() as $index => $attachment)
                                                <div class="btn btn-outline-secondary btn-block btn-sm">
                                                    <a href="{{ $attachment->file_link }}" class="text-dark mb-1 mx-1"
                                                        target="_blank">Lampiran {{ $index + 1 }}</a> || <a
                                                        href="{{ route('admin.public-activity.deleteAttachment', ['id' => $attachment->id]) }}"
                                                        class="text-danger mb-1 mx-1">x</a>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.public-activity.edit', $activity) }}"
                                                class="btn btn-success m-1">Edit Data</a>

                                            <form method="post"
                                                action="{{ route(auth()->user()->position->name . '.public-activity.destroy', $activity) }}"
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

    <div class="modal fade" id="modalActivity" tabindex="-1" aria-labelledby="modalActivity" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Status Aktivitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route(auth()->user()->position->name . '.public-activity.updateStatus') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-2 pb-0">
                        <div class="row my-3">
                            <div class="col-12">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="akan dilaksanakan">Akan Dilaksanakan</option>
                                    <option value="sedang berlangsung">Sedang Berlangsung</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                <input type="hidden" name="activity_id" id="activity_id">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="attachments">Lampiran</label>
                                    <input type="file" name="attachments[]" id="attachments" class="form-control"
                                        multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
