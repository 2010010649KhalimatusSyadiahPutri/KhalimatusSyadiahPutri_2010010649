@extends('layouts.admin')

@section('title', $title ?? '')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title ?? 'ini title kosong' }}</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-body">

                        @include('components.alert')

                        <form method="POST" action="{{ route('admin.public-activity.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="time">Waktu Kegiatan</label>
                                        <input type="date" name="time" id="time" class="form-control"
                                            placeholder="Waktu Kegiatan">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="office_id">Petugas</label>
                                        @if (auth()->user()->position->name == 'admin')
                                            <select name="officer_id" id="officer_id" class="form-control">
                                                @foreach ($officer as $off)
                                                    <option value="{{ $off->id ?? '' }}">{{ $off->position->name ?? '' }} -
                                                        {{ $off->name ?? '' }} - {{ $off->rank->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="officer_id" id="officer_id" class="form-control">
                                                @foreach ($officer as $off)
                                                    @if ($off->id == auth()->user()->id)
                                                        <option value="{{ $off->id ?? '' }}">
                                                            {{ $off->position->name ?? '' }} - {{ $off->name ?? '' }} -
                                                            {{ $off->rank->name ?? '' }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Kegiatan</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Kegiatan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Keterangan</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="akan dilaksanakan">Akan Dilaksanakan</option>
                                        <option value="sedang berlangsung">Sedang Berlangsung</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 my-2">
                                    <label for="status">Wilayah</label>
                                    <select name="assignment_area_id" id="assignment_area_id" class="form-control">
                                        @foreach (\App\Models\AssignmentArea::all() as $assignment)
                                            <option value="{{ $assignment->id }}">
                                                {{ $assignment->district->name ?? '' }} -
                                                {{ $assignment->anggota->fullname ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="attachments">Lampiran</label>
                                        <input type="file" name="attachments[]" id="attachments" class="form-control"
                                            multiple>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
