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

                        <form method="POST" action="{{ route('admin.facility-officer.update', $data) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Jenis Fasilitas</label>
                                        <input type="text" name="type" id="type" class="form-control"
                                            placeholder="Jenis fasilitas" value="{{ $data->type ?? '' }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Fasilitas</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Masukkan Nama Fasilitas" value="{{ $data->name ?? '' }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Deskripsi fasilitas"
                                            required>{{ $data->description ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Jumlah</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control"
                                            placeholder="Jumlah" value="{{ $data->quantity ?? 0 }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="condition">Kondisi</label>
                                        <select name="condition" id="condition" class="form-control" required>
                                            <option value="Bagus" {{ $data->condition == 'Bagus' ? 'selected' : '' }}>Bagus
                                            </option>
                                            <option value="Cukup" {{ $data->condition == 'Cukup' ? 'selected' : '' }}>Cukup
                                            </option>
                                            <option value="Kurang Bagus"
                                                {{ $data->condition == 'Kurang Bagus' ? 'selected' : '' }}>Kurang Bagus
                                            </option>
                                            <option value="Rusak" {{ $data->condition == 'Rusak' ? 'selected' : '' }}>Rusak
                                            </option>
                                            <option value="Tidak Layak"
                                                {{ $data->condition == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="maintenance_time">Waktu Perawatan Selanjutnya</label>
                                        <input type="date" name="maintenance_time" id="maintenance_time"
                                            class="form-control" value="{{ $data->maintenance_time ?? '' }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="officer_id">Petugas</label>
                                        <select name="officer_id" id="officer_id" class="form-control select2" required>
                                            @foreach (\App\Models\User::all() as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == $data->officer_id ? 'selected' : '' }}>
                                                    {{ $user->position->name ?? '' }} - {{ $user->fullname ?? '' }} -
                                                    {{ $user->rank->name ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">File</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
