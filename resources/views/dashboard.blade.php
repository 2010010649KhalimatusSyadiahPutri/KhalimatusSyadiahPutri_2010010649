@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? 'ini title kosong' }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="primary">{{ \App\Models\User::count() }}</h3>
                                        <span>Jumlah Anggota</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-support primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="primary">{{ \App\Models\IncomingLetter::count() }}</h3>
                                        <span>Surat Masuk</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-support primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="primary">{{ \App\Models\OutcomingLetter::count() }}</h3>
                                        <span>Surat Keluar</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-support primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="primary">{{ number_format(\App\Models\Operational::sum('total') ?? 0) }}</h3>
                                        <span>Anggaran</span>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-support primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Bencana Alam</h3>
                        </div>
                        <div class="card-body">
                            {!! $bencana->container() !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Kegiatan Masyarakat</h3>
                        </div>
                        <div class="card-body">
                            {!! $kegiatan->container() !!}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ $bencana->cdn() }}"></script>
<script src="{{ $kegiatan->cdn() }}"></script>

{{ $bencana->script() }}
{{ $kegiatan->script() }}
@endpush
