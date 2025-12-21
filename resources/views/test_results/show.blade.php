@extends('layouts.admin')

@section('title', 'Detail Hasil Uji Kendaraan')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h4>Detail Hasil Uji Kelayakan Kendaraan</h4>
            </div>

            <div class="card-body">

                {{-- Informasi Kendaraan --}}
                <h5>Informasi Kendaraan</h5>
                <p><strong>No. Polisi:</strong> {{ $test_result->vehicle->plate_number ?? '-' }}</p>
                <p><strong>Nama Pemilik:</strong> {{ $test_result->vehicle->owner_name ?? '-' }}</p>
                <p><strong>Tanggal Uji:</strong> {{ $test_result->test_date }}</p>
                <p><strong>Petugas:</strong> {{ $test_result->user->name ?? '-' }}</p>

                <hr>

                {{-- Detail Pemeriksaan --}}
                <h5>Hasil Pemeriksaan Detail</h5>

                @php
                    $criteria = json_decode($test_result->criteria_scores, true) ?? [];
                    $all_criteria = [
                        'rem' => 'Umur Rem',
                        'emisi' => 'Kadar Emisi CO',
                        'lampu' => 'Kondisi Lampu Utama',
                        'ban' => 'Kedalaman Alur Ban',
                        'oli' => 'Oli Mesin',
                        'kebisingan' => 'Uji Kebisingan',
                        'dimensi' => 'Pengukuran Dimensi',
                    ];
                @endphp

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Kriteria</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_criteria as $key => $label)
                                <tr>
                                    <td>{{ $label }}</td>
                                    <td>
                                        @php $st = $criteria[$key]['status'] ?? '-' @endphp
                                        <span class="badge badge-{{ $st == 'Layak' ? 'success' : 'danger' }}">
                                            {{ $st }}
                                        </span>
                                    </td>
                                    <td>{{ $criteria[$key]['notes'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Status Akhir --}}
                <p class="mt-3">
                    <strong>Status Akhir:</strong>
                    <span class="badge badge-{{ $test_result->status == 'Layak' ? 'success' : 'danger' }} px-3">
                        {{ strtoupper($test_result->status) }}
                    </span>
                </p>

                <p><strong>Catatan:</strong> {{ $test_result->notes ?? '-' }}</p>

                {{-- Tombol --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('test_results.index') }}" class="btn btn-secondary">← Kembali</a>
                    <a href="{{ route('test_results.printPdf', $test_result->id) }}" class="btn btn-primary">🧾 Cetak PDF</a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
