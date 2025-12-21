@extends('layouts.admin')

@section('title', 'Edit Data Kendaraan')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Edit Data Kendaraan</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <input type="text" name="plate_number"
                                    value="{{ old('plate_number', $vehicle->plate_number) }}"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Pemilik</label>
                                <input type="text" name="owner_name"
                                    value="{{ old('owner_name', $vehicle->owner_name) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" name="color"
                                    value="{{ old('color', $vehicle->color) }}"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Merek</label>
                                <input type="text" name="make"
                                    value="{{ old('make', $vehicle->make) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kendaraan</label>
                                <input type="text" name="vehicle_type"
                                    value="{{ old('vehicle_type', $vehicle->vehicle_type) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="year"
                                    value="{{ old('year', $vehicle->year) }}"
                                    class="form-control"
                                    min="1900" max="{{ date('Y') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bahan Bakar</label>
                                <select name="fuel_type" class="form-control" required>
                                    <option value="Bensin" {{ $vehicle->fuel_type == 'Bensin' ? 'selected' : '' }}>Bensin</option>
                                    <option value="Solar" {{ $vehicle->fuel_type == 'Solar' ? 'selected' : '' }}>Solar</option>
                                    <option value="Listrik" {{ $vehicle->fuel_type == 'Listrik' ? 'selected' : '' }}>Listrik</option>
                                    <option value="Hybrid" {{ $vehicle->fuel_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        Simpan Perubahan
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
