
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg-indigo-600 p-4 rounded-md shadow-md">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-700 mb-4">Selamat Datang, {{ Auth::user()->name }} 👋</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-green-100 p-4 rounded-lg shadow hover:shadow-lg transition">
                        <h4 class="font-semibold text-green-700">Uji Rem</h4>
                        <p class="text-gray-600 mt-2">Status: <span class="font-bold text-green-600">Lulus</span></p>
                    </div>

                    <div class="bg-yellow-100 p-4 rounded-lg shadow hover:shadow-lg transition">
                        <h4 class="font-semibold text-yellow-700">Uji Emisi</h4>
                        <p class="text-gray-600 mt-2">Status: <span class="font-bold text-yellow-600">Perlu Pemeriksaan</span></p>
                    </div>

                    <div class="bg-blue-100 p-4 rounded-lg shadow hover:shadow-lg transition">
                        <h4 class="font-semibold text-blue-700">Lampu & Kelengkapan</h4>
                        <p class="text-gray-600 mt-2">Status: <span class="font-bold text-blue-600">Lulus</span></p>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-gray-600">Anda saat ini sudah <span class="font-semibold text-indigo-600">logged in</span>.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
