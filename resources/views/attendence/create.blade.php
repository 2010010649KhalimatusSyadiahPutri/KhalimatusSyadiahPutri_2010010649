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

                        <form method="POST" action="{{ route(auth()->user()->position->name . '.absensi.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="datetime">Tanggal dan Waktu</label>
                                        <input type="text" name="datetime" id="datetime" class="form-control" placeholder="Waktu dan Tanggal" value="{{ Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="datetime">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="hadir">Hadir</option>
                                            <option value="ijin">Ijin</option>
                                            <option value="cuti">Cuti</option>
                                            <option value="dinas luar">Dinas Luar</option>
                                            <option value="dinas dalam">Dinas Dalam</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="notes">Keterangan</label>
                                        <textarea name="notes" id="notes" class="form-control" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="user_id">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->fullname }}" disabled>
                                        <input type="hidden" name="anggota_id" id="anggota_id" class="form-control" value="{{ auth()->user()->id }}">
                                    </div>
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

