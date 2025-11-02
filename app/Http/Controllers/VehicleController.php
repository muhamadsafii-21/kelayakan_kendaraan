<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
   public function index(Request $request)
{
    $user = auth()->user();
    $search = $request->input('search'); // ambil kata kunci dari input pencarian

    // Jika admin atau inspector, bisa melihat semua kendaraan
    if ($user->role === 'admin' || $user->role === 'inspector') {
        $query = Vehicle::query();
    } else {
        // Pemilik hanya melihat kendaraannya sendiri
        $query = Vehicle::where('owner_name', $user->name);
    }

    // 🔍 Jika ada pencarian, filter berdasarkan plat nomor atau nama pemilik
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('plate_number', 'like', "%{$search}%")
              ->orWhere('owner_name', 'like', "%{$search}%");
        });
    }

    // Ambil hasil pencarian
    $vehicles = $query->latest()->get();

    return view('vehicles.index', compact('vehicles'));
}

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_number' => 'required|unique:vehicles',
            'owner_name' => 'nullable|string',
            'make' => 'nullable|string',
            'model' => 'nullable|string',
            'year' => 'nullable|digits:4|integer',
            'vehicle_type' => 'nullable|string',
        ]);

        Vehicle::create($validated);
        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'plate_number' => 'required|unique:vehicles,plate_number,' . $vehicle->id,
            'owner_name' => 'nullable|string',
            'make' => 'nullable|string',
            'model' => 'nullable|string',
            'year' => 'nullable|digits:4|integer',
            'vehicle_type' => 'nullable|string',
        ]);

        $vehicle->update($validated);
        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
