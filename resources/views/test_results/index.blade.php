<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Uji Kelayakan Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                <!-- Baris atas: tombol tambah + form pencarian -->
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('test_results.create') }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                        + Tambah Hasil Uji
                    </a>

                    <!-- 🔍 Form pencarian -->
                    <form method="GET" action="{{ route('test_results.index') }}" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari plat atau status..."
                               class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('test_results.index') }}" 
                               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- 🌈 Tabel lebih berwarna -->
                <div class="overflow-x-auto rounded-lg">
                    <table class="w-full border-collapse text-sm">
                        <thead class="bg-gradient-to-r from-blue-400 to-blue-600 text-white">
                            <tr>
                                <th class="border px-4 py-2 text-left">No</th>
                                <th class="border px-4 py-2 text-left">Kendaraan</th>
                                <th class="border px-4 py-2 text-left">Tanggal Uji</th>
                                <!-- <th class="border px-4 py-2 text-center">Nilai Akhir</th> -->
                                <th class="border px-4 py-2 text-center">Status</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tests as $test)
                                <tr class="odd:bg-blue-50 even:bg-white hover:bg-blue-100 transition">
                                    <td class="border px-4 py-2 text-center font-semibold text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $test->vehicle->plate_number ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $test->test_date }}</td>
                                    <!-- <td class="border px-4 py-2 text-center text-blue-800 font-medium">
                                        {{ number_format($test->score, 2) }}
                                    </td> -->
                                    <td class="border px-4 py-2 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                                            {{ $test->status == 'Layak' 
                                                ? 'bg-green-100 text-green-700' 
                                                : 'bg-red-100 text-red-700' }}">
                                            {{ $test->status }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2 text-center space-x-1">
                                        <a href="{{ route('test_results.show', $test->id) }}" 
                                           class="text-blue-600 hover:underline">Lihat</a> |
                                        <a href="{{ route('test_results.edit', $test->id) }}" 
                                           class="text-green-600 hover:underline">Edit</a> |
                                        <a href="{{ route('test_results.pdf', $test->id) }}" 
                                           class="text-purple-600 hover:underline">PDF</a>
                                        
                                        <form action="{{ route('test_results.destroy', $test->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:underline"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
