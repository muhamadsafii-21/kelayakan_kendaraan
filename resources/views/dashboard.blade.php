@extends('layouts.admin')

@section('content')

<div class="row">

    <!-- Total Kendaraan -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalKendaraan }}</h3>
                <p>Total Kendaraan</p>
            </div>
            <div class="icon"><i class="fas fa-bus"></i></div>
        </div>
    </div>

    <!-- Layak -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $lulus }}</h3>
                <p>Kendaraan Layak</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
        </div>
    </div>

    <!-- Tidak Layak -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $gagal }}</h3>
                <p>Kendaraan Tidak Layak</p>
            </div>
            <div class="icon"><i class="fas fa-times-circle"></i></div>
        </div>
    </div>

    <!-- Belum Diuji -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $belumDiuji }}</h3>
                <p>Belum Diuji</p>
            </div>
            <div class="icon"><i class="fas fa-clock"></i></div>
        </div>
    </div>

</div>

<div class="row">

    <!-- Grafik -->
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Grafik Hasil Uji Kendaraan</h3>
            </div>
            <div class="card-body">
                <canvas id="chartUji"></canvas>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartUji'), {
        type: 'bar',
        data: {
            labels: ['Layak', 'Tidak Layak', 'Belum Diuji'],
            datasets: [{
                label: 'Jumlah Kendaraan',
                data: [
                    {{ $lulus }},
                    {{ $gagal }},
                    {{ $belumDiuji }}
                ]
            }]
        }
    });
</script>
@endpush
