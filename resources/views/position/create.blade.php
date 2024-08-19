@extends('layouts.admin')

@section('title', $title ?? '')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title ?? 'Tambah Data Jabatan' }}</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class ="card-header">
                        <h4> Form Jabtan</h4>
                    </div>
                    <div class="card-body p-4">

                        @include('components.alert')

                        <form method="POST" action="{{ url('danramil/jabatan/store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama Jabatan</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Masukan Nama Jabatan">
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success">Simpan Jabatan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
