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
                    <div class="card-header">
                        <h4>Edit Data Kecabangan</h4>
                    </div>

                    <div class="card-body p-4">

                        @include('components.alert')

                        <form method="POST" action="{{ route('admin.branching.update', $data) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name">Nama Kecabangan</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Masukan Nama Kecabangan" value="{{ $data->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success mr-2">Simpan</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
