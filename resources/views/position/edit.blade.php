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

                        <form method="POST" action="{{ url("danramil/jabatan/$data->id/update") }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama Jabatan </label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Masukan Nama Jabatan" value="{{ $data->name }}">
                            </div>

                            <button type="submit" class="btn btn-success">Simpan Jabatan</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
