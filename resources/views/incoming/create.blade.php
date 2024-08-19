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

                        <form method="POST" action="{{ route('admin.incoming-letter.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reference_number">Nomor Surat</label>
                                        <input type="text" name="reference_number" id="reference_number"
                                            class="form-control" placeholder="Masukan No Surat" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="date" name="date" id="date" class="form-control"
                                            placeholder="Masukan Tanggal" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="purpose">Perihal</label>
                                <textarea name="purpose" id="purpose" cols="30" rows="3" class="form-control" placeholder="Masukan Perihal"
                                    required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sender">Pengirim</label>
                                        <input type="text" name="sender" id="sender"
                                            placeholder="Masukan Nama Pengirim" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="recipient">Penerima</label>
                                        <select name="recipient" id="recipient" class="form-control" required>
                                            @foreach (\App\Models\User::all() as $user)
                                                <option value="{{ $user->fullname }}">{{ $user->position->name ?? '' }} -
                                                    {{ $user->fullname ?? '' }} - {{ $user->rank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="user_id" id="user_id"
                                            value="{{ auth()->user()->id ?? '' }}" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="attachments">Lampiran</label>
                                <input type="file" name="attachments[]" id="attachments" class="form-control" multiple
                                    required>
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
