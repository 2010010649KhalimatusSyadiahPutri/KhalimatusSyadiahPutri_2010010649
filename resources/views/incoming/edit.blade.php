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

                        <form method="POST" action="{{ route('admin.incoming-letter.update', $data) }}">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="reference_number">Nomor Surat</label>
                                        <input type="text" name="reference_number" id="reference_number" class="form-control" value="{{ $data->reference_number }}" placeholder="Masukan No Surat">
                                    </div>
                                </div>
    
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="date" name="date" id="date" class="form-control" placeholder="Masukan Tanggal" value="{{ $data->date }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="purpose">Perihal</label>
                                        <textarea name="purpose" id="purpose" cols="30" rows="10" class="form-control">{{ $data->purpose }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sender">Pengirim</label>
                                        <input type="text" name="sender" id="sender" placeholder="Pengirim" value="{{ $data->sender }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sender">Penerima</label>
                                        <select name="recipient" id="recipient" class="form-control">
                                            @foreach (\App\Models\User::all() as $user)
                                                <option value="{{ $user->fullname }}" {{ $user->fullname == $data->recipient ? 'selected' : '' }}>{{ $user->position->name ?? '' }} - {{ $user->fullname ?? '' }} - {{ $user->rank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id ?? ''}}" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-warning">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

