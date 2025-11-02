<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Hasil Uji Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('test_results.update', $test_result->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Kendaraan -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700">Kendaraan</label>
                        <select name="vehicle_id" class="border-gray-300 rounded-md shadow-sm w-full">
                            @foreach($vehicles as $v)
                                <option value="{{ $v->id }}" {{ $v->id == $test_result->vehicle_id ? 'selected' : '' }}>
                                    {{ $v->plate_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Uji -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700">Tanggal Uji</label>
                        <input type="date" name="test_date"
                            value="{{ $test_result->test_date }}"
                            class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <!-- Nilai Kriteria -->
                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-800 mb-2">Nilai Kriteria</h3>
                        @foreach($criteria as $c)
                            <div class="mb-2">
                                <label class="text-gray-700">{{ $c->name }} <span class="text-sm text-gray-500">(Bobot: {{ $c->weight }})</span></label>
                                <input type="number" name="criteria_scores[{{ $c->code }}]"
                                    value="{{ $test_result->criteria_scores[$c->code] ?? 0 }}"
                                    min="1" max="5"
                                    class="border-gray-300 rounded-md shadow-sm w-full">
                            </div>
                        @endforeach
                    </div>

                    <!-- Catatan -->
                    <div class="mb-4">
                        <label class="block mb-1 font-semibold text-gray-700">Catatan</label>
                        <textarea name="notes"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            rows="3">{{ $test_result->notes }}</textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('test_results.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
