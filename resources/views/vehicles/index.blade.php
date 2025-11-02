<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Data Kendaraan</h2>
    </x-slot>

    <div class="p-6">
        <!-- 🔹 Baris atas: tombol tambah + pencarian -->
        <div class="flex justify-between items-center mb-4">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('vehicles.create') }}" 
                   class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 shadow">
                    + Tambah Kendaraan
                </a>
            @endif

            <!-- 🔍 Form pencarian di kanan -->
            <form method="GET" action="{{ route('vehicles.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama atau plat..."
                       class="border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('vehicles.index') }}" 
                       class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        @if (session('success'))
            <div class="mt-4 p-2 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- 🌈 Tabel berwarna -->
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gradient-to-r from-blue-400 to-blue-600 text-white">
                    <tr>
                        <th class="border px-3 py-2 text-left">No</th>
                        <th class="border px-3 py-2 text-left">Plat Nomor</th>
                        <th class="border px-3 py-2 text-left">Pemilik</th>
                        <th class="border px-3 py-2 text-left">Merek</th>
                        <th class="border px-3 py-2 text-left">Model</th>
                        <th class="border px-3 py-2 text-left">Tahun</th>
                        <th class="border px-3 py-2 text-left">Jenis</th>
                        <th class="border px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $v)
                        <tr class="odd:bg-blue-50 even:bg-white hover:bg-blue-100 transition">
                            <td class="border px-3 py-2 text-center font-semibold text-gray-700">{{ $loop->iteration }}</td>
                            <td class="border px-3 py-2">{{ $v->plate_number }}</td>
                            <td class="border px-3 py-2">{{ $v->owner_name }}</td>
                            <td class="border px-3 py-2">{{ $v->make }}</td>
                            <td class="border px-3 py-2">{{ $v->model }}</td>
                            <td class="border px-3 py-2">{{ $v->year }}</td>
                            <td class="border px-3 py-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                    {{ $v->vehicle_type }}
                                </span>
                            </td>
                            <td class="border px-3 py-2 text-center">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('vehicles.edit', $v) }}" 
                                       class="px-2 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition">Edit</a>
                                    <form action="{{ route('vehicles.destroy', $v) }}" method="POST" 
                                          onsubmit="return confirm('Hapus kendaraan ini?')" 
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 italic">Hanya bisa melihat</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
