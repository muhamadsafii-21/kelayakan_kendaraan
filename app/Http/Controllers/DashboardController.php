<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\TestResult;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            // Total kendaraan
            'totalKendaraan' => Vehicle::count(),

            // Total lulus berdasarkan kolom status
            'lulus' => TestResult::where('status', 'Layak')->count(),

            // Total tidak lulus
            'gagal' => TestResult::where('status', 'Tidak Layak')->count(),

            // Belum diuji = total kendaraan - kendaraan yang punya hasil uji
            'belumDiuji' => Vehicle::count() - TestResult::count(),

            // Jadwal hari ini (kalau kamu punya table jadwal)
            'jadwalHariIni' => [], // sementara kosong
        ]);
    }
}
