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

                        <form method="POST" action="{{ route(auth()->user()->position->name . '.keuangan.pengeluaran.update', $data) }}">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="date">Tanggal Diberikan</label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ $data->date }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Jenis</label>
                                        <input type="text" name="type" id="type" class="form-control" placeholder="Jenis Kegiatan" value="{{ $data->type }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Sumber Dana</label>
                                        <select name="operational_id" id="operational_id" class="form-control">
                                            @foreach($operasional as $sumber_dana)
                                                <option value="{{ $sumber_dana->id }}" {{ $sumber_dana->id == $data->operational_id ? 'selected' : ''}}>{{$sumber_dana->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Total</label>
                                        <input type="number" name="total" id="total" class="form-control" value="{{ $data->total }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $data->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">File Laporan</label>
                                        <input type="file" name="report" id="report" class="form-control">
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->position->name == 'admin')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="user_id">Petugas</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            @foreach (\App\Models\User::all() as $user)
                                                <option value="{{ $user->id ?? '' }}" {{ $user->id == $data->user_id ? 'selected' : ''}}>{{ $user->position->name ?? '' }} - {{ $user->fullname ?? '' }} - {{ $user->rank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

