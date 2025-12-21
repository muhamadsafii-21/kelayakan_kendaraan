@extends('layouts.admin')

@section('title', 'Uji Kelayakan Kendaraan')

@section('content')

<div class="container-fluid">

    <!-- Judul Halaman -->
    <div class="row mb-3">
        <div class="col">
            <h4 class="font-weight-bold">Uji Kelayakan Kendaraan</h4>
        </div>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('test_results.store') }}" method="POST">
                @csrf

                <!-- PILIH KENDARAAN -->
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Pilih Kendaraan</label>
                    <select name="vehicle_id" class="form-control">
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">
                                {{ $vehicle->plate_number }} - {{ $vehicle->owner_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- TANGGAL UJI -->
                <div class="form-group mb-4">
                    <label class="font-weight-bold">Tanggal Uji</label>
                    <input type="date" name="test_date" class="form-control">
                </div>

                <!-- PENILAIAN KRITERIA -->
                <h5 class="font-weight-bold mt-4">Penilaian Kriteria</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Kriteria</th>
                                <th class="text-center">Layak</th>
                                <th class="text-center">Tidak Layak</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $items = [
                                    'rem'        => 'Umur Rem',
                                    'emisi'      => 'Kadar Emisi CO',
                                    'lampu'      => 'Kondisi Lampu Utama',
                                    'ban'        => 'Kedalaman Alur Ban',
                                    'oli'        => 'Oli Mesin',
                                    'kebisingan' => 'Uji Kebisingan',
                                    'dimensi'    => 'Pengukuran Dimensi',
                                ];
                            @endphp

                            @foreach ($items as $key => $label)
                            <tr>
                                <td>{{ $label }}</td>

                                <td class="text-center">
                                    <input type="radio" name="{{ $key }}_status" value="Layak">
                                </td>

                                <td class="text-center">
                                    <input type="radio" name="{{ $key }}_status" value="Tidak Layak">
                                </td>

                                <td>
                                    <input type="text" name="{{ $key }}_notes" class="form-control">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- CATATAN UMUM -->
                <div class="form-group mt-4">
                    <label class="font-weight-bold">Catatan Umum</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="btn btn-primary mt-3">
                    Simpan Hasil Uji
                </button>

            </form>

        </div>
    </div>

</div>

@endsection
