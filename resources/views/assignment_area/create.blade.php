@extends('layouts.admin')

@section('title', $title ?? '')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $title ?? 'Tambah Data Wilayah Penugasan' }}</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        @include('components.alert')

                        <form method="POST" action="{{ route('admin.assignment-area.store') }}">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pimpinan_id">Pimpinan</label>
                                        <select name="pimpinan_id" id="pimpinan_id" class="form-control">
                                            <option value="" disabled selected>-- Pilih Pimpinan --</option>
                                            @foreach (\App\Models\User::where('position_id', 1)->get() as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="anggota_id">Nama Anggota</label>
                                        <select name="anggota_id" id="anggota_id" class="form-control">
                                            <option value="" disabled selected>-- Pilih Anggota --</option>
                                            @foreach (\App\Models\User::where('position_id', 2)->get() as $user)
                                                <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_population">Jumlah Masyarakat</label>
                                        <input type="number" name="total_population" id="total_population"
                                            class="form-control" placeholder="Masukkan Jumlah Masyarakat">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_head_of_family">Jumlah Kepala Keluarga</label>
                                        <input type="number" name="total_head_of_family" id="total_head_of_family"
                                            class="form-control" placeholder="Masukkan Jumlah Kepala Keluarga">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_of_male">Jumlah Laki-Laki</label>
                                        <input type="number" name="total_of_male" id="total_of_male" class="form-control"
                                            placeholder="Masukkan Jumlah Laki-Laki">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_of_female">Jumlah Perempuan</label>
                                        <input type="number" name="total_of_female" id="total_of_female"
                                            class="form-control" placeholder="Masukkan Jumlah Perempuan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Kode Wilayah</label>
                                        <input type="text" name="area" id="area" class="form-control"
                                            placeholder="Masukkan Kode Wilayah">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="district_id">Kecamatan</label>
                                        <select name="district_id" id="district_id" class="form-control">
                                            <option value="" disabled selected>-- Pilih Kecamatan --</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
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
