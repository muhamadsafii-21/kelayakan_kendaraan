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
    $query = \App\Models\TestResult::with('vehicle', 'user')->latest();

    // 🔍 Filter pencarian
    if ($request->has('search')) {
        $search = strtolower($request->search);

        $query->whereHas('vehicle', function ($q) use ($search) {
            $q->where('plate_number', 'like', "%{$search}%");
        })
        ->orWhere(function ($q) use ($search) {
            if ($search === 'layak') {
                $q->where('status', 'Layak');
            } elseif ($search === 'tidak layak') {
                $q->where('status', 'Tidak Layak');
            }
        });
    }

    $tests = $query->get();

    return view('test_results.index', compact('tests'));
}
public function create()
{
    $vehicles = \App\Models\Vehicle::all();
    $criteria = \App\Models\Criterion::all();

    return view('test_results.create', compact('vehicles', 'criteria'));
}

    public function store(Request $request)
{
    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'test_date' => 'required|date',
        'rem' => 'required|numeric',
        'emisi' => 'required|numeric',
        'lampu' => 'required|string',
        'ban' => 'required|numeric',
        'notes' => 'nullable|string',
    ]);

    $details = [];
    $statusKeseluruhan = 'Layak';

    // 🔹 Penilaian REM
    if ($request->rem < 24000) {
        $details['Rem'] = 'Tidak Layak (umur rem < 24.000 km)';
        $statusKeseluruhan = 'Tidak Layak';
    } else {
        $details['Rem'] = 'Layak';
    }

    // 🔹 Penilaian EMISI GAS BUANG
    if ($request->emisi > 1.5) {
        $details['Emisi Gas Buang'] = 'Perlu Pemeriksaan (CO > 1.5%)';
        if ($statusKeseluruhan != 'Tidak Layak') {
            $statusKeseluruhan = 'Perlu Pemeriksaan';
        }
    } else {
        $details['Emisi Gas Buang'] = 'Layak';
    }

    // 🔹 Penilaian LAMPU
    if (strtolower($request->lampu) != 'berfungsi') {
        $details['Lampu'] = 'Tidak Layak (lampu tidak berfungsi)';
        $statusKeseluruhan = 'Tidak Layak';
    } else {
        $details['Lampu'] = 'Layak';
    }

    // 🔹 Penilaian BAN
    if ($request->ban < 1.6) {
        $details['Ban'] = 'Perlu Pemeriksaan (alur < 1.6 mm)';
        if ($statusKeseluruhan != 'Tidak Layak') {
            $statusKeseluruhan = 'Perlu Pemeriksaan';
        }
    } else {
        $details['Ban'] = 'Layak';
    }

    // 🔹 Simpan hasil
    TestResult::create([
        'vehicle_id' => $request->vehicle_id,
        'user_id' => auth()->id(),
        'test_date' => $request->test_date,
        'criteria_scores' => [
            'rem' => $request->rem,
            'emisi' => $request->emisi,
            'lampu' => $request->lampu,
            'ban' => $request->ban,
        ],
        'score' => null, // tidak pakai skor rata-rata
        'status' => $statusKeseluruhan,
        'notes' => $request->notes,
        'details' => json_encode($details),
    ]);

    return redirect()->route('test_results.index')->with('success', 'Hasil uji tersimpan.');
}

    public function show(TestResult $test_result)
    {
        $criteria = Criterion::all()->keyBy('code');
        return view('test_results.show', compact('test_result', 'criteria'));
    }
    // cetak pdf
    public function printPdf(TestResult $test_result)
{
    $criteria = \App\Models\Criterion::all()->keyBy('code');
    $pdf = Pdf::loadView('test_results.pdf', compact('test_result', 'criteria'))
              ->setPaper('A4', 'portrait');

    $filename = 'Hasil_Uji_' . $test_result->vehicle->plate_number . '.pdf';

    return $pdf->download($filename);
}

    public function edit(TestResult $test_result)
{
    $vehicles = Vehicle::all();
    $criteria = Criterion::all();
    return view('test_results.edit', compact('test_result', 'vehicles', 'criteria'));
}
public function destroy(TestResult $test_result)
{
    $test_result->delete();
    return redirect()->route('test_results.index')->with('success', 'Data hasil uji dihapus.');
}
public function userResults()
{
    $tests = \App\Models\TestResult::where('user_id', auth()->id())->get();
    return view('test_results.user_index', compact('tests'));
}



public function update(Request $request, TestResult $test_result)
{
    $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'test_date' => 'required|date',
        'rem' => 'required|numeric',
        'emisi' => 'required|numeric',
        'lampu' => 'required|string',
        'ban' => 'required|numeric',
        'notes' => 'nullable|string',
    ]);

    $details = [];
    $statusKeseluruhan = 'Layak';

    // Penilaian sama seperti di store()
    if ($request->rem < 24000) {
        $details['Rem'] = 'Tidak Layak (umur rem < 24.000 km)';
        $statusKeseluruhan = 'Tidak Layak';
    } else {
        $details['Rem'] = 'Layak';
    }

    if ($request->emisi > 1.5) {
        $details['Emisi Gas Buang'] = 'Perlu Pemeriksaan (CO > 1.5%)';
        if ($statusKeseluruhan != 'Tidak Layak') {
            $statusKeseluruhan = 'Perlu Pemeriksaan';
        }
    } else {
        $details['Emisi Gas Buang'] = 'Layak';
    }

    if (strtolower($request->lampu) != 'berfungsi') {
        $details['Lampu'] = 'Tidak Layak (lampu tidak berfungsi)';
        $statusKeseluruhan = 'Tidak Layak';
    } else {
        $details['Lampu'] = 'Layak';
    }

    if ($request->ban < 1.6) {
        $details['Ban'] = 'Perlu Pemeriksaan (alur < 1.6 mm)';
        if ($statusKeseluruhan != 'Tidak Layak') {
            $statusKeseluruhan = 'Perlu Pemeriksaan';
        }
    } else {
        $details['Ban'] = 'Layak';
    }

    // Update hasil
    $test_result->update([
        'vehicle_id' => $request->vehicle_id,
        'test_date' => $request->test_date,
        'criteria_scores' => [
            'rem' => $request->rem,
            'emisi' => $request->emisi,
            'lampu' => $request->lampu,
            'ban' => $request->ban,
        ],
        'score' => null,
        'status' => $statusKeseluruhan,
        'notes' => $request->notes,
        'details' => json_encode($details),
    ]);

    return redirect()->route('test_results.index')->with('success', 'Hasil uji diperbarui.');
}

}
