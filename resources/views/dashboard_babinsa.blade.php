@extends('layouts.admin')

@section('title', 'Dashboard Danramil')

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
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
