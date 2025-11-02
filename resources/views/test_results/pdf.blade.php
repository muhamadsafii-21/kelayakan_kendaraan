<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Uji Kendaraan</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .status { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Laporan Hasil Uji Kelayakan Kendaraan</h1>
    <hr>

    <p><strong>No. Polisi:</strong> {{ $test_result->vehicle->plate_number }}</p>
    <p><strong>Pemilik:</strong> {{ $test_result->vehicle->owner_name ?? '-' }}</p>
    <p><strong>Tanggal Uji:</strong> {{ $test_result->test_date }}</p>
    <p><strong>Petugas:</strong> {{ $test_result->user->name ?? '-' }}</p>

    <h2>Hasil Penilaian</h2>
    <table>
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($test_result->criteria_scores as $code => $score)
                <tr>
                    <td>{{ $criteria[$code]->name ?? $code }}</td>
                    <td>{{ $criteria[$code]->weight ?? '-' }}</td>
                    <td>{{ $score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Skor Akhir:</strong> {{ number_format($test_result->score, 2) }}</p>
    <p class="status"><strong>Status:</strong> 
        {{ strtoupper($test_result->status) }}
    </p>

    <p><strong>Catatan:</strong> {{ $test_result->notes ?? '-' }}</p>

    <br><br>
    <p style="text-align:right;">{{ now()->format('d-m-Y') }}</p>
</body>
</html>
