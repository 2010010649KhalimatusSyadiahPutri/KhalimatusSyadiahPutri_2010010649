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

                        <form method="POST" action="{{ route('admin.pendataan-kegiatan.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="time">Tanggal Kegiatan</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                                            placeholder="Waktu Tanggal">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Kegiatan</label>
                                        <input type="text" name="jenis" id="jenis" class="form-control"
                                            placeholder="Jenis Kegiatan">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" placeholder="deskripsi"></textarea>
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->position->name == 'admin')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="user_id">Petugas</label>
                                        <select name="iser+od" id="iser+od" class="form-control">
                                            @foreach (\App\Models\User::all() as $user)
                                                <option value="{{ $user->id }}">{{ $user->position->name ?? '' }} - {{ $user->fullname ?? '' }} - {{ $user->rank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id ?? ''}}" class="form-control">
                            @endif


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
