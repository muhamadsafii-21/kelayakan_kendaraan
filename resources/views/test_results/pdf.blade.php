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
        .layak { color: green; font-weight: bold; }
        .tidak-layak { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Laporan Hasil Uji Kelayakan Kendaraan</h1>
    <hr>

    <p><strong>No. Polisi:</strong> {{ $test_result->vehicle->plate_number }}</p>
    <p><strong>Pemilik:</strong> {{ $test_result->vehicle->owner_name ?? '-' }}</p>
    <p><strong>Tanggal Uji:</strong> {{ $test_result->test_date }}</p>
    <p><strong>Petugas:</strong> {{ $test_result->user->name ?? '-' }}</p>

    <h2>Hasil Pemeriksaan</h2>

    @php
        $criteria = json_decode($test_result->criteria_scores, true) ?? [];
        $all_criteria = [
            'rem' => 'Umur Rem',
            'emisi' => 'Kadar Emisi CO',
            'lampu' => 'Kondisi Lampu Utama',
            'ban' => 'Kedalaman Alur Ban',
            'oli' => 'Oli Mesin',
            'kebisingan' => 'Uji Kebisingan',
            'dimensi' => 'Pengukuran Dimensi'
        ];
    @endphp

    @if(!empty($criteria))
        <table>
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Hasil</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_criteria as $key => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td class="{{ ($criteria[$key]['status'] ?? '') == 'Layak' ? 'layak' : 'tidak-layak' }}">
                            {{ $criteria[$key]['status'] ?? '-' }}
                        </td>
                        <td>{{ $criteria[$key]['notes'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data detail pemeriksaan.</p>
    @endif

    <br>
    <p class="status">
        <strong>Status Akhir:</strong>
        <span class="{{ $test_result->status == 'Layak' ? 'layak' : 'tidak-layak' }}">
            {{ strtoupper($test_result->status) }}
        </span>
    </p>

    <p><strong>Catatan:</strong> {{ $test_result->notes ?? '-' }}</p>

    <br><br>
    <p style="text-align:right;">{{ now()->format('d-m-Y') }}</p>
</body>
</html>
