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

                        <form method="POST" action="{{ route('admin.anggota.update', $data) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Masukan Nama" value="{{ $data->name ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="fullname">Nama Lengkap</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control"
                                            placeholder="Masukan Nama lengkap" value="{{ $data->fullname ?? '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Masukan Email" value="{{ $data->email ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Masukan Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">NRP</label>
                                        <input type="text" name="nrp" id="nrp" class="form-control"
                                            placeholder="Masukan NRP" value="{{ $data->nrp }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">No. telpone</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            placeholder="Masukan No Telpon" value="{{ $data->phone_number }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="rank_id">Pangkat</label>
                                        <select name="rank_id" id="rank_id" class="form-control">
                                            @foreach (\App\Models\Rank::all() as $rank)
                                                <option value="{{ $rank->id }}"
                                                    {{ $data->rank_id == $rank->id ? 'selected' : '' }}>{{ $rank->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="position_id">Jabatan</label>
                                        <select name="position_id" id="position_id" class="form-control">
                                            @foreach (\App\Models\Position::all() as $position)
                                                <option value="{{ $position->id }}"
                                                    {{ $data->position_id == $position->id ? 'selected' : '' }}>
                                                    {{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="branching_id">Kecabangan</label>
                                        <select name="branching_id" id="branching_id" class="form-control">
                                            @foreach (\App\Models\Branching::all() as $branching)
                                                <option value="{{ $branching->id }}"
                                                    {{ $data->branching_id == $branching->id ? 'selected' : '' }}>
                                                    {{ $branching->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success mr-2">Simpan Anggota</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
