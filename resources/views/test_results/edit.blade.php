@extends('layouts.admin')

@section('title', 'Edit Hasil Uji Kelayakan Kendaraan')

@section('content')
<div class="main-content" style="padding:20px;">

    <div class="card">
        <div class="card-header">
            <h4>Edit Hasil Uji Kelayakan Kendaraan</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('test_results.update', $test_result->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kendaraan -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Kendaraan</label>
                    <select name="vehicle_id" class="form-control">
                        @foreach($vehicles as $v)
                            <option value="{{ $v->id }}" {{ $v->id == $test_result->vehicle_id ? 'selected' : '' }}>
                                {{ $v->plate_number }} - {{ $v->owner_name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Uji -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Tanggal Uji</label>
                    <input type="date" name="test_date" value="{{ $test_result->test_date }}"
                        class="form-control">
                </div>

                <!-- Penilaian Kriteria -->
                <h5 class="font-weight-bold mt-4">Penilaian Kriteria</h5>

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
                    <table class="table table-bordered text-sm">
                        <thead class="bg-light">
                            <tr>
                                <th>Kriteria</th>
                                <th class="text-center">Layak</th>
                                <th class="text-center">Tidak Layak</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_criteria as $key => $label)
                                <tr>
                                    <td>{{ $label }}</td>
                                    <td class="text-center">
                                        <input type="radio" name="{{ $key }}_status" value="Layak"
                                            {{ ($criteria[$key]['status'] ?? '') == 'Layak' ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="radio" name="{{ $key }}_status" value="Tidak Layak"
                                            {{ ($criteria[$key]['status'] ?? '') == 'Tidak Layak' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="text" name="{{ $key }}_notes" class="form-control"
                                            value="{{ $criteria[$key]['notes'] ?? '' }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Catatan Umum -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Catatan Umum</label>
                    <textarea name="notes" class="form-control" rows="3">{{ $test_result->notes }}</textarea>
                </div>

                <!-- Status Akhir -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Status Akhir</label>
                    <select name="status" class="form-control">
                        <option value="Layak" {{ $test_result->status == 'Layak' ? 'selected' : '' }}>Layak</option>
                        <option value="Tidak Layak" {{ $test_result->status == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('test_results.index') }}" class="btn btn-secondary mr-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
