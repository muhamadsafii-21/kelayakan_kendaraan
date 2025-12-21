<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestResult;
use App\Models\Vehicle;
use App\Models\Criterion;
use Barryvdh\DomPDF\Facade\Pdf;

class TestResultController extends Controller
{
   public function index(Request $request)
{
    $search = strtolower($request->search);

    $tests = TestResult::with('vehicle', 'user')
        ->when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                // Cari berdasarkan nomor polisi kendaraan
                $q->whereHas('vehicle', function ($v) use ($search) {
                    $v->where('plate_number', 'like', "%{$search}%");
                });

                // Cari berdasarkan status
                $q->orWhere('status', 'like', "%{$search}%");

                // Cari berdasarkan catatan
                $q->orWhere('notes', 'like', "%{$search}%");

                // Cari berdasarkan tanggal
                $q->orWhere('test_date', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

    return view('test_results.index', ['test_results' => $tests]);
}


    public function create()
    {
        // ✅ Ambil semua kendaraan dan kriteria
        $vehicles = Vehicle::all();
        $criteria = Criterion::all();

        // ✅ Kirim ke view
        return view('test_results.create', compact('vehicles', 'criteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required',
            'test_date' => 'required|date',
        ]);

        // Simpan seluruh kriteria ke dalam JSON
        $criteria_scores = [
    'rem' => [
        'status' => $request->rem_status,
        'notes' => $request->rem_notes,
    ],
    'emisi' => [
        'status' => $request->emisi_status,
        'notes' => $request->emisi_notes,
    ],
    'lampu' => [
        'status' => $request->lampu_status,
        'notes' => $request->lampu_notes,
    ],
    'ban' => [
        'status' => $request->ban_status,
        'notes' => $request->ban_notes,
    ],
    'oli' => [
        'status' => $request->oli_status,
        'notes' => $request->oli_notes,
    ],
    // 'klakson' => [
    //     'status' => $request->klakson_status,
    //     'notes' => $request->klakson_notes,
    // ],
    'kebisingan' => [
        'status' => $request->kebisingan_status,
        'notes' => $request->kebisingan_notes,
    ],
    'dimensi' => [
        'status' => $request->dimensi_status,
        'notes' => $request->dimensi_notes,
    ],
];

        // Tentukan status akhir otomatis
        $all_layak = collect($criteria_scores)->every(fn($item) => $item['status'] === 'Layak');
        $status = $all_layak ? 'Layak' : 'Tidak Layak';

        // Simpan ke database
        TestResult::create([
            'vehicle_id' => $request->vehicle_id,
            'user_id' => auth()->id(),
            'test_date' => $request->test_date,
            'criteria_scores' => json_encode($criteria_scores),
            'status' => $status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('test_results.index')->with('success', 'Data hasil uji berhasil disimpan.');
    }

    public function show(TestResult $test_result)
    {
        $test_result->load('vehicle');
        return view('test_results.show', compact('test_result'));
    }

    // ✅ Cetak PDF
    public function printPdf(TestResult $test_result)
    {
        $criteria = Criterion::all()->keyBy('code');
        $pdf = Pdf::loadView('test_results.pdf', compact('test_result', 'criteria'))
                  ->setPaper('A4', 'portrait');

        $filename = 'Hasil_Uji_' . $test_result->vehicle->plate_number . '.pdf';
        return $pdf->download($filename);
    }

    public function edit(TestResult $test_result)
    {
        // ✅ Tambahkan pengiriman $vehicles dan $criteria
        $vehicles = Vehicle::all();
        $criteria = Criterion::all();

        return view('test_results.edit', compact('test_result', 'vehicles', 'criteria'));
    }

    public function update(Request $request, TestResult $test_result)
{
    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'test_date' => 'required|date',
        'notes' => 'nullable|string',
        // jangan paksa criteria_scores sebagai array karena kita pakai nama masing2 field
    ]);

    $criteria_scores = [
        'rem' => [
            'status' => $request->rem_status ?? null,
            'notes' => $request->rem_notes ?? null,
        ],
        'emisi' => [
            'status' => $request->emisi_status ?? null,
            'notes' => $request->emisi_notes ?? null,
        ],
        'lampu' => [
            'status' => $request->lampu_status ?? null,
            'notes' => $request->lampu_notes ?? null,
        ],
        'ban' => [
            'status' => $request->ban_status ?? null,
            'notes' => $request->ban_notes ?? null,
        ],
        'oli' => [
            'status' => $request->oli_status ?? null,
            'notes' => $request->oli_notes ?? null,
        ],
        'kebisingan' => [
            'status' => $request->kebisingan_status ?? null,
            'notes' => $request->kebisingan_notes ?? null,
        ],
        'dimensi' => [
            'status' => $request->dimensi_status ?? null,
            'notes' => $request->dimensi_notes ?? null,
        ],
    ];

    // Jika user mengisi dropdown status di form, pakai itu.
    // Kalau tidak ada (null/empty), maka hitung dari kriteria (fallback).
    if ($request->filled('status')) {
        $status = $request->status;
    } else {
        // pastikan setiap status terisi -> bila ada yang null anggap tidak layak
        $allLayak = collect($criteria_scores)->every(function ($item) {
            return isset($item['status']) && $item['status'] === 'Layak';
        });
        $status = $allLayak ? 'Layak' : 'Tidak Layak';
    }

    $test_result->update([
        'vehicle_id' => $request->vehicle_id,
        'test_date' => $request->test_date,
        'criteria_scores' => json_encode($criteria_scores),
        'status' => $status,
        'notes' => $request->notes,
    ]);

    return redirect()->route('test_results.index')->with('success', 'Data hasil uji berhasil diperbarui!');
}

    public function destroy(TestResult $test_result)
    {
        $test_result->delete();
        return redirect()->route('test_results.index')->with('success', 'Data hasil uji dihapus.');
    }

    public function userResults()
    {
        $tests = TestResult::where('user_id', auth()->id())->get();
        return view('test_results.user_index', compact('tests'));
    }
}
