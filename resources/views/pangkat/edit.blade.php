@extends('layouts.admin')

@section('title', $title ?? '')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>{{ $title ?? 'Ini title kosong' }}</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4>Edit Data Pangkat</h4>
                    </div>
                    <div class="card-body p-4">

                        @include('components.alert')

                        <form method="POST" action="{{ route('admin.rank.update', $data) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Masukkan Nama Pangkat" value="{{ $data->name ?? '' }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="reset" class="btn btn-secondary mr-2">Reset</button>
                                <button type="submit" class="btn btn-success">Simpan Pangkat</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
