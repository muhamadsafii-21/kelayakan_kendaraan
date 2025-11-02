<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Kendaraan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold">Nomor Polisi</label>
                        <input type="text" name="plate_number" value="{{ old('plate_number', $vehicle->plate_number) }}" class="border rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Nama Pemilik</label>
                        <input type="text" name="owner_name" value="{{ old('owner_name', $vehicle->owner_name) }}" class="border rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Merek</label>
                        <input type="text" name="make" value="{{ old('make', $vehicle->make) }}" class="border rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Model</label>
                        <input type="text" name="model" value="{{ old('model', $vehicle->model) }}" class="border rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Tahun</label>
                        <input type="number" name="year" value="{{ old('year', $vehicle->year) }}" class="border rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Tipe Kendaraan</label>
                        <input type="text" name="vehicle_type" value="{{ old('vehicle_type', $vehicle->vehicle_type) }}" class="border rounded w-full p-2">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
