<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold text-indigo-700 mb-4">Dashboard Pemilik Mobil</h2>

            <p class="text-gray-600 mb-6">Selamat datang, {{ Auth::user()->name }} 👋</p>

            <h3 class="text-lg font-semibold mb-3">Data Kendaraan Anda</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border px-3 py-2">Plat Nomor</th>
                        <th class="border px-3 py-2">Merek</th>
                        <th class="border px-3 py-2">Model</th>
                        <th class="border px-3 py-2">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td class="border px-3 py-2">{{ $vehicle->plate_number }}</td>
                            <td class="border px-3 py-2">{{ $vehicle->make }}</td>
                            <td class="border px-3 py-2">{{ $vehicle->model }}</td>
                            <td class="border px-3 py-2">{{ $vehicle->year }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
