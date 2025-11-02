<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Uji Kendaraan Saya') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="table-auto w-full border-collapse border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">No</th>
                            <th class="border p-2">Kendaraan</th>
                            <th class="border p-2">Tanggal Uji</th>
                            <th class="border p-2">Skor</th>
                            <th class="border p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $test)
                            <tr>
                                <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border p-2">{{ $test->vehicle->plate_number ?? '-' }}</td>
                                <td class="border p-2">{{ $test->test_date }}</td>
                                <td class="border p-2 text-center">{{ number_format($test->score, 2) }}</td>
                                <td class="border p-2 text-center">
                                    <span class="{{ $test->status == 'Layak' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $test->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3 text-gray-500">Belum ada hasil uji.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
