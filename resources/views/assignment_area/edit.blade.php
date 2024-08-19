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

                        <form method="POST" action="{{ route('admin.assignment-area.update', $data) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                                    <div class="form-group">
                                        <label for="pimpinan_id">Pimpinan</label>
                                        <select name="pimpinan_id" id="pimpinan_id" class="form-control">
                                            @foreach (\App\Models\User::where('position_id', 1)->get() as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == $data->pimpinan_id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="anggota_id">Anggota</label>
                                        <select name="anggota_id" id="anggota_id" class="form-control">
                                            @foreach (\App\Models\User::where('position_id', 2)->get() as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == $data->anggota_id ? 'selected' : '' }}>
                                                    {{ $user->fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="total_population">Jumlah Masyarakat</label>
                                        <input type="number" name="total_population" id="total_population"
                                            class="form-control" placeholder="Jumlah Maysarakat"
                                            value="{{ $data->total_population ?? 0 }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="total_head_of_family">Jumlah KK</label>
                                        <input type="number" name="total_head_of_family" id="total_head_of_family"
                                            class="form-control" placeholder="Jumlah Kepala Keluarga"
                                            value="{{ $data->total_head_of_family ?? 0 }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="total_of_male">Jumlah Laki-Laki</label>
                                        <input type="number" name="total_of_male" id="total_of_male" class="form-control"
                                            placeholder="Jumlah Laki-Laki" value="{{ $data->total_of_male ?? 0 }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="total_of_female">Jumlah Perempuan</label>
                                        <input type="number" name="total_of_female" id="total_of_female"
                                            class="form-control" placeholder="Jumlah Perempuan"
                                            value="{{ $data->total_of_female ?? 0 }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        <input type="number" name="area" id="area" class="form-control"
                                            placeholder="Jumlah Perempuan" value="{{ $data->area ?? 0 }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="district_id">Kecamatan</label>
                                        <select name="district_id" id="district_id" class="form-control">
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}"
                                                    {{ $district->id == $data->district_id ? 'selected' : '' }}>
                                                    {{ $district->name }}</option>
                                            @endforeach
                                        </select>
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
