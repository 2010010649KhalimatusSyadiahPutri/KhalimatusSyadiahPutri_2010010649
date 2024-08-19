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

                        <form method="POST" action="{{ route('admin.outcoming-letter.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="reference_number">Nomor Surat</label>
                                        <input type="text" name="reference_number" id="reference_number" class="form-control" placeholder="Masukan No Surat">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="type">Jenis Surat</label>
                                        <input type="text" name="type" id="type" class="form-control" placeholder="Masukan Jenis Surat">
                                    </div>
                                </div>
    
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="date" name="date" id="date" class="form-control" placeholder="Masukan Tanggal">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="purpose">Perihal</label>
                                        <textarea name="purpose" id="purpose" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="sender">Pengirim Surat</label>
                                        <input type="text" name="sender" id="sender" placeholder="Pengirim" class="form-control" list="senderlist" autocomplete="off" />
                                        <datalist id="senderlist">
                                            @foreach (\App\Models\User::all() as $user)
                                            <option value="{{ $user->fullname ?? '' }}">{{ $user->fullname ?? '' }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="to">Tujuan Pengiriman</label>
                                        <input type="text" name="to" id="to" placeholder="Tujuan Pengirim" class="form-control" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="to">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="segera">Segera</option>
                                            <option value="rahasia">Rahasia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="base_content">Dasar</label>
                                        <textarea name="base_content" id="base_content" class="form-control summernote"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="review_content">Meninjau</label>
                                        <textarea name="review_content" id="review_content" class="form-control summernote"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="signature_name">Bertanda Tangan</label>
                                        <select name="signature_name" id="signature_name" class="form-control">
                                            @foreach (\App\Models\User::all() as $user)
                                            <option value="{{ $user->id ?? '' }}">{{ $user->position->name ?? '' }} - {{ $user->fullname ?? '' }} - {{ $user->rank->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="copy_of_letters">Tembusan</label>
                                        <textarea name="copy_of_letters" id="copy_of_letters" class="form-control summernote"></textarea>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250
            });
        });
    </script>
@endpush

