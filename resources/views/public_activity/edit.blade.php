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

                        <form method="POST" action="{{ route('admin.public-activity.update', $data) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="time">Waktu Kegiatan</label>
                                        <input type="date" name="time" id="time" class="form-control" placeholder="Waktu Kegiatan" value="{{ Carbon\Carbon::parse($data->time)->format('Y-m-d') }}">
                                    </div>
                                </div>
    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="office_id">Petugas</label>
                                        <select name="officer_id" id="officer_id" class="form-control">
                                            @foreach ($officer as $off)
                                                <option value="{{ $off->id ?? '' }}" {{ $off->id == $data->officer_id ? 'selected' : '' }}>{{ $off->position->name ?? '' }} - {{ $off->name ?? '' }} - {{ $off->rank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Kegiatan</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Kegiatan" value="{{ $data->title ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Keterangan</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $data->description ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12">
                                    <label for="status">Wilayah</label>
                                    <select name="assignment_area_id" id="assignment_area_id" class="form-control">
                                        @foreach (\App\Models\AssignmentArea::all() as $assignment)
                                            <option value="{{ $assignment->id }}" {{ $assignment->id == $data->assignment_area_id ? 'selected' : '' }}>{{ $assignment->district->name ?? '' }} - {{ $assignment->anggota->fullname ?? '' }}</option>
                                        @endforeach
                                    </select>
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

