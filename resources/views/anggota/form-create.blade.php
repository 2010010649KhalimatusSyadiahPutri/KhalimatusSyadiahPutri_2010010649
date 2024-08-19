@extends('layouts.admin')

@section('title', $title ?? '')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title ?? 'Ini Title Kosong' }}</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @include('components.alert')

                        <form method="POST" action="{{ route('admin.anggota.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Masukan Nama">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname">Nama Lengkap</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control"
                                            placeholder="Masukan Nama Lengkap">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Masukan Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Masukan Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nrp">NRP</label>
                                        <input type="text" name="nrp" id="nrp" class="form-control"
                                            placeholder="Masukan NRP">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">No. Telepon</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            placeholder="Masukan No. Telepon">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rank_id">Pangkat</label>
                                        <select name="rank_id" id="rank_id" class="form-control">
                                            @foreach (\App\Models\Rank::all() as $rank)
                                                <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="position_id">Jabatan</label>
                                        <select name="position_id" id="position_id" class="form-control">
                                            @foreach (\App\Models\Position::all() as $position)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="branching_id">Kecabangan</label>
                                        <select name="branching_id" id="branching_id" class="form-control">
                                            @foreach (\App\Models\Branching::all() as $branching)
                                                <option value="{{ $branching->id }}">{{ $branching->name }}</option>
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
