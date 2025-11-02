<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Tambah Kendaraan</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('vehicles.store') }}">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Plat Nomor</label>
                    <input type="text" name="plate_number" class="w-full border rounded p-2" required>
                </div>
                <div>
                    <label>Nama Pemilik</label>
                    <input type="text" name="owner_name" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Merek</label>
                    <input type="text" name="make" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Model</label>
                    <input type="text" name="model" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Tahun</label>
                    <input type="number" name="year" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Jenis Kendaraan</label>
                    <input type="text" name="vehicle_type" class="w-full border rounded p-2">
                </div>
            </div>

            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
