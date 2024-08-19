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
            </div>

            <div class="section-body">
                @include('components.alert')

                <div class="card">
                    <div class="card-header">
                        <h4>{{ $title ?? '' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3" method="GET">
                                <div class="col-7">
                                    <input type="search" name="search" id="search" class="form-control"
                                        placeholder="Cari Nomor Surat Masuk" value="{{ request('search') }}">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route(auth()->user()->position->name . '.incoming-letter.index', ['cetak' => 1]) }}"
                                        class="btn btn-outline-success btn-block">Cetak Agenda Surat Masuk</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route(auth()->user()->position->name . '.incoming-letter.create') }}"
                                        class="btn btn-success btn-block">Tambah Surat Masuk</a>
                                </div>
                            </form>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Penerima</th>
                                    <th>Pengirim</th>
                                    <th>Lampiran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($data as $key => $dt)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $dt->reference_number ?? '' }}</td>
                                        <td>{{ $dt->date ?? '' }}</td>
                                        <td>{{ $dt->purpose ?? '' }}</td>
                                        <td>{{ $dt->recipient ?? '' }}</td>
                                        <td>{{ $dt->sender ?? '' }}</td>
                                        <td class="text-center">
                                            @foreach ($dt->attachments as $index => $attachment)
                                                <div class="btn btn-outline-secondary btn-sm btn-block my-2">
                                                    <a href="{{ url($attachment->path) }}" class="text-dark mx-1"
                                                        target="_blank">Lampiran {{ $index + 1 }}</a> || <a
                                                        href="{{ route(auth()->user()->position->name . '.incoming-letter.deleteAttachment', ['id' => $attachment->id]) }}"
                                                        class="text-danger mx-1">x</a>
                                                </div>
                                            @endforeach
                                            <button class="btn btn-outline-secondary btn-block btn-sm my-2"
                                                data-toggle="modal" data-id="{{ $dt->id }}"
                                                data-target="#modalAddAttachment">Tambah Lampiran</button>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="{{ route(auth()->user()->position->name . '.incoming-letter.edit', $dt) }}"
                                                    class="btn btn-success m-1">Edit </a>

                                                <form method="post"
                                                    action="{{ route(auth()->user()->position->name . '.incoming-letter.destroy', $dt) }}"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                {!! $data->links() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- Modal Tambah Lampiran -->
    <div class="modal fade" id="modalAddAttachment" tabindex="-1" aria-labelledby="modalAddAttachmentLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddAttachmentLabel">Tambah Lampiran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post"
                    action="{{ route(auth()->user()->position->name . '.incoming-letter.addAttachment') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pt-2 pb-0">
                        <input type="hidden" name="incoming_message_id" id="incoming_message_id">

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
    <!-- JS Libraries -->
    <script>
        $('#modalAddAttachment').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var incomingId = button.data('id');
            var modal = $(this);
            modal.find('.modal-body #incoming_message_id').val(incomingId);
        });
    </script>

    <!-- Page Specific JS File -->
@endpush
