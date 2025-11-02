<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ARRAMCO TOUR & TRAVEL') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen flex">
    <!-- Sidebar kiri -->
    <aside class="w-64 bg-blue-500 text-white flex flex-col">
        <div class="p-4 text-2xl font-bold text-center border-b border-blue-700">
            ARRAMCO TOUR & TRAVEL
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-blue-600 transition {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('vehicles.index') }}"
               class="block px-3 py-2 rounded hover:bg-blue-600 transition {{ request()->routeIs('vehicles.*') ? 'bg-blue-800' : '' }}">
                Data Kendaraan
            </a>

            <a href="{{ route('test_results.index') }}"
               class="block px-3 py-2 rounded hover:bg-blue-600 transition {{ request()->routeIs('test_results.*') ? 'bg-blue-800' : '' }}">
                Hasil Uji
            </a>
        </nav>
    </aside>

    <!-- Konten utama -->
    <div class="flex-1 flex flex-col">
        <!-- Header atas -->
        <header class="bg-white shadow p-4 flex justify-between items-center relative">
            <h1 class="text-xl font-semibold text-blue-700"></h1>

            <!-- Dropdown user -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <i data-lucide="user-circle" class="w-8 h-8 text-blue-600"></i>
                </button>

                <div x-show="open" @click.away="open = false"
                     class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-50">
                    <form method="POST" action="{{ route('logout') }}" class="p-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-gray-100 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Area konten -->
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</div>

<!-- Aktifkan ikon dan Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
<script>lucide.createIcons();</script>
</body>
</html>
