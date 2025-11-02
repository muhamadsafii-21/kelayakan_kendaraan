<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Uji Kelayakan Kendaraan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('test_results.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Pilih Kendaraan</label>
                        <select name="vehicle_id" id="vehicle_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }} - {{ $vehicle->owner_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="test_date" class="block text-sm font-medium text-gray-700">Tanggal Uji</label>
                        <input type="date" name="test_date" id="test_date" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <h3 class="text-lg font-semibold mt-6 mb-2">Input Nilai Kriteria</h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="rem" class="block text-sm font-medium text-gray-700">Umur Rem (km)</label>
        <input type="number" name="rem" id="rem" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Contoh: 25000">
        <p class="text-xs text-gray-500 mt-1">Jika kurang dari 24.000 km → Tidak Layak</p>
    </div>

    <div>
        <label for="emisi" class="block text-sm font-medium text-gray-700">Kadar Emisi CO (%)</label>
        <input type="number" step="0.1" name="emisi" id="emisi" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Contoh: 1.2">
        <p class="text-xs text-gray-500 mt-1">Jika lebih dari 1.5% → Perlu Pemeriksaan</p>
    </div>

    <div>
        <label for="lampu" class="block text-sm font-medium text-gray-700">Kondisi Lampu Utama</label>
        <select name="lampu" id="lampu" class="mt-1 block w-full border-gray-300 rounded-md">
            <option value="Berfungsi">Berfungsi</option>
            <option value="Tidak Berfungsi">Tidak Berfungsi</option>
        </select>
        <p class="text-xs text-gray-500 mt-1">Jika lampu tidak berfungsi → Tidak Layak</p>
    </div>

    <div>
        <label for="ban" class="block text-sm font-medium text-gray-700">Kedalaman Alur Ban (mm)</label>
        <input type="number" step="0.1" name="ban" id="ban" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Contoh: 2.0">
        <p class="text-xs text-gray-500 mt-1">Jika kurang dari 1.6 mm → Perlu Pemeriksaan</p>
    </div>
</div>

                    <div class="mb-4 mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea name="notes" id="notes" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Simpan Hasil Uji
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
