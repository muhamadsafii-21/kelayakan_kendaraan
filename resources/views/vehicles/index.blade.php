@extends('layouts.admin')

@section('title', 'Data Kendaraan')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between mb-3">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
                + Tambah Kendaraan
            </a>
        @endif

        <form method="GET" action="{{ route('vehicles.index') }}" class="form-inline">
            <input type="text" name="search" value="{{ request('search') }}"
                   class="form-control mr-2" placeholder="Cari plat / warna / bahan bakar">

            <button type="submit" class="btn btn-primary mr-2">Cari</button>

            @if(request('search'))
                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card table --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong>📋 Daftar Kendaraan</strong>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="text-center bg-dark text-white">
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Warna</th>
                            <th>Merek</th>
                            <th>Jenis</th>
                            <th>Tahun</th>
                            <th>Bahan Bakar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($vehicles as $v)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $v->plate_number }}</td>
                                <td>{{ $v->color }}</td>
                                <td>{{ $v->make ?? '-' }}</td>
                                <td>{{ $v->vehicle_type ?? '-' }}</td>
                                <td>{{ $v->year ?? '-' }}</td>
                                <td>{{ $v->fuel_type }}</td>
                                <td class="text-center">

                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('vehicles.edit', $v) }}" 
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('vehicles.destroy', $v) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Hapus kendaraan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Hanya lihat</span>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted p-3">
                                    Tidak ada data kendaraan
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
