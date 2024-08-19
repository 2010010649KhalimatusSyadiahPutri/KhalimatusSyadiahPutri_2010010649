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

                        <form method="POST" action="{{ route('admin.pendataan-kegiatan.update', $data->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Kegiatan</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                                            value="{{ Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Kegiatan</label>
                                        <input type="text" name="jenis" id="jenis" class="form-control"
                                            value="{{ $data->jenis }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control">{{ $data->deskripsi }}</textarea>
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
