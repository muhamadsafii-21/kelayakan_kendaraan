@extends('layouts.admin')

@section('title', 'Hasil Uji Kelayakan Kendaraan')

@section('content')
<div class="container-fluid">

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📝 Hasil Uji Kelayakan Kendaraan</h4>

        <a href="{{ route('test_results.create') }}" class="btn btn-primary">
            + Tambah Hasil Uji
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('test_results.index') }}" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}"
                class="form-control" placeholder="Cari no polisi / catatan...">
        </div>

        <div class="col-md-auto">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>

        @if(request('search'))
            <div class="col-md-auto">
                <a href="{{ route('test_results.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        @endif
    </form>

    {{-- Card Table --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Daftar Hasil Pemeriksaan</strong>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Kendaraan</th>
                            <th>Tanggal Uji</th>
                            <th>Rem</th>
                            <th>Emisi</th>
                            <th>Lampu</th>
                            <th>Ban</th>
                            <th>Oli Mesin</th>
                            <th>Kebisingan</th>
                            <th>Dimensi</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($test_results as $result)
                            @php
                                $criteria = json_decode($result->criteria_scores, true);
                            @endphp

                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $result->vehicle->plate_number }}</td>
                                <td>{{ $result->test_date }}</td>

                                @foreach (['rem','emisi','lampu','ban','oli','kebisingan','dimensi'] as $key)
                                    <td class="text-center">
                                        <strong>{{ $criteria[$key]['status'] ?? '-' }}</strong><br>
                                        <small class="text-muted">{{ $criteria[$key]['notes'] ?? '' }}</small>
                                    </td>
                                @endforeach

                                <td>
                                    @if ($result->status == 'Layak')
                                        <span class="badge badge-success">✔ LAYAK</span>
                                    @else
                                        <span class="badge badge-danger">✘ TIDAK LAYAK</span>
                                    @endif
                                </td>

                                <td>{{ $result->notes }}</td>

                                <td class="text-center">
                                    <a href="{{ route('test_results.show', $result->id) }}" class="btn btn-sm btn-info">
                                        Lihat
                                    </a>

                                    <a href="{{ route('test_results.edit', $result->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('test_results.destroy', $result->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-muted p-4">
                                    Tidak ada data hasil uji.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
