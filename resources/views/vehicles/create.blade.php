@extends('layouts.admin')

@section('title', 'Tambah Kendaraan')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Tambah Kendaraan</h4>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('vehicles.store') }}">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Plat Nomor</label>
                    <input type="text" name="plate_number" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="owner_name" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Warna</label>
                    <input type="text" name="color" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Merek</label>
                    <input type="text" name="make" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Kendaraan</label>
                    <input type="text" name="vehicle_type" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="year" class="form-control" min="1900" max="{{ date('Y') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Bahan Bakar</label>
                    <select name="fuel_type" class="form-control" required>
                        <option value="">-- Pilih Jenis Bahan Bakar --</option>
                        <option value="Bensin">Bensin</option>
                        <option value="Solar">Solar</option>
                        <option value="Listrik">Listrik</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                </div>

            </div>

            <button class="btn btn-primary mt-3">
                Simpan
            </button>
        </form>

    </div>
</div>
@endsection
