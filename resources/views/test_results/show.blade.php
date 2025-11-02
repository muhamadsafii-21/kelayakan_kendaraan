<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Hasil Uji Kendaraan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Kendaraan:</strong> {{ $test_result->vehicle->plate_number }}</p>
                <p><strong>Tanggal Uji:</strong> {{ $test_result->test_date }}</p>
                <p><strong>Petugas:</strong> {{ $test_result->user->name ?? '-' }}</p>

                <h2 class="mt-6 font-semibold text-lg">Nilai Kriteria</h2>
                <table class="table-auto w-full mt-3 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Kriteria</th>
                            <th class="border p-2">Bobot</th>
                            <th class="border p-2">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($test_result->criteria_scores as $code => $score)
                            <tr>
                                <td class="border p-2">{{ $criteria[$code]->name ?? $code }}</td>
                                <td class="border p-2 text-center">{{ $criteria[$code]->weight ?? '-' }}</td>
                                <td class="border p-2 text-center">{{ $score }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <p><strong>Skor Akhir:</strong> {{ number_format($test_result->score, 2) }}</p>
                    <p><strong>Status:</strong> 
                        <span class="{{ strtolower($test_result->status) == 'layak' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($test_result->status) }}
                        </span>
                    </p>
                    <p><strong>Catatan:</strong> {{ $test_result->notes }}</p>
                </div>

                <a href="{{ route('test_results.index') }}" 
                   class="mt-6 inline-block text-blue-600 hover:underline">← Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</x-app-layout>
