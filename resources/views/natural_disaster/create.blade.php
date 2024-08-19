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

                        <form method="POST" action="{{ route('admin.natural-disaster.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="time">Tanggal</label>
                                        <input type="date" name="time" id="time" class="form-control"
                                            value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                            placeholder="Masukan Tanggal Kejadian">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="disaster_type">Jenis Bencan</label>
                                        <select name="disaster_type" id="disaster_type" class="form-control" required>
                                            <option value="Banjir">Banjir</option>
                                            <option value="Kebakaran Hutan">Kebakaran Hutan</option>
                                            <option value="Tanah Longsor">Tanah Longsor</option>
                                            <option value="Kekeringan">Kekeringan</option>
                                            <option value="Puting Beliung">Puting Beliung</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="disaster_type">Jenis Bencana</label>
                                        <input type="text" name="disaster_type" id="disaster_type" class="form-control" placeholder="Jenis Bencana">
                                    </div>
                                </div> --}}
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="purpose">Wilayah Kerja</label>
                                        <select name="assignment_area_id" id="assignment_area_id" class="form-control">
                                            @foreach (\App\Models\AssignmentArea::get() as $assignment)
                                                <option value="{{ $assignment->id }}">
                                                    {{ $assignment->district->name ?? '' }} -
                                                    {{ $assignment->anggota->fullname ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sender">Petugas</label>
                                        <select name="officer_id" id="officer_id" class="form-control">
                                            @foreach (\App\Models\User::get() as $user)
                                                <option value="{{ $user->id }}">{{ $user->position->name ?? '' }} -
                                                    {{ $user->name ?? '' }} - {{ $user->rank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="fatalities">Korban Jiwa</label>
                                        <input type="number" name="fatalities" id="fatalities" class="form-control"
                                            placeholder="Korban Jiwa">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="fatality_of_males">Laki-Laki</label>
                                    <input type="number" name="fatality_of_males" id="fatality_of_males"
                                        class="form-control" placeholder="Korban Laki-Laki">
                                </div>
                                <div class="col-4">
                                    <label for="fatality_of_females">Perempuan</label>
                                    <input type="number" name="fatality_of_females" id="fatality_of_females"
                                        class="form-control" placeholder="Korban Perempuan">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="children">Anak-Anak</label>
                                        <input type="number" name="children" id="children" class="form-control"
                                            placeholder="Korban Anak">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="elderly">Remaja</label>
                                    <input type="number" name="elderly" id="elderly" class="form-control"
                                        placeholder="Korban Remaja">
                                </div>
                                <div class="col-4">
                                    <label for="mature">Dewasa</label>
                                    <input type="number" name="mature" id="mature" class="form-control"
                                        placeholder="Korban Dewasa">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-warning">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
