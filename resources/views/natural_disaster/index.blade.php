@extends('layouts.admin')

@section('title', $title ?? '')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1 class="d-inline-block">{{ $title ?? 'ini title kosong' }}</h1>
            </div>

            <div class="section-body">

                @include('components.alert')

                <div class="card">
                    {{-- <div class="card-header">
                        <p>{{ $title ?? '' }}</p>
                    </div> --}}
                    <div class="card-body">
                        <div class="mb-4">
                            <form class="row g-3">
                                <div class="col-7">
                                    <input type="search" name="search[disaster_type]" id="search" class="form-control"
                                        placeholder="Cari Bencana">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Cari</button>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.natural-disaster.index', ['cetak' => 1]) }}"
                                        class="btn btn-outline-success btn-block">Cetak Laporan Bencana</a>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('admin.natural-disaster.create') }}"
                                        class="btn btn-success btn-block">Tambah Laporan Bencana</a>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Bencana</th>
                                        <th>Wilayah Penugasan</th>
                                        <th>Nama Petugas</th>
                                        <th>Korban Jiwa</th>
                                        <th>Korban Laki-Laki</th>
                                        <th>Korban Perempuan</th>
                                        <th>Korban Anak-Anak</th>
                                        <th>Korban Dewasa</th>
                                        <th>Kornam Lansia</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @forelse($data as $key => $dt)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $dt->time ?? '' }}</td>
                                        <td>{{ $dt->disaster_type ?? '' }}</td>
                                        <td>{{ $dt->assignment_area->district->name ?? '' }}</td>
                                        <td>{{ $dt->officer->fullname ?? '' }}</td>
                                        <td class="text-center">{{ $dt->fatalities ?? '' }}</td>
                                        <td class="text-center">{{ $dt->fatality_of_males ?? '' }}</td>
                                        <td class="text-center">{{ $dt->fatality_of_females ?? '' }}</td>
                                        <td class="text-center">{{ $dt->children ?? '' }}</td>
                                        <td class="text-center">{{ $dt->elderly ?? '' }}</td>
                                        <td class="text-center">{{ $dt->mature ?? '' }}</td>
                                        <th class="text-center">
                                            <a href="{{ route('admin.natural-disaster.edit', $dt) }}"
                                                class="btn btn-success m-2">
                                                Edit
                                            </a>

                                            <form method="post"
                                                action="{{ route('admin.natural-disaster.destroy', $dt) }}"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </th>
                                    </tr>
                                @empty
                                @endforelse
                            </table>

                            <div class="row">
                                {!! $data->links() !!}
                            </div>
                        </div>
                    </div>

                </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
