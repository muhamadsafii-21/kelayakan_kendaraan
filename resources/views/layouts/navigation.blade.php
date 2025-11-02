<nav x-data="{ open: false }" class="flex h-screen bg-gray-100">
    <!-- Sidebar kiri -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-4 text-2xl font-bold text-center border-b border-gray-700">
            {{ __('ARRAMCO TOUR & TRAVEL') }}
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block text-white hover:bg-gray-700 rounded px-3 py-2">
                Dashboard
            </x-nav-link>

            <x-nav-link :href="route('vehicles.index')" :active="request()->routeIs('vehicles.*')" class="block text-white hover:bg-gray-700 rounded px-3 py-2">
                Data Kendaraan
            </x-nav-link>

            <x-nav-link :href="route('test_results.index')" :active="request()->routeIs('test_results.*')" class="block text-white hover:bg-gray-700 rounded px-3 py-2">
                Hasil Uji
            </x-nav-link>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-gray-700">
            @csrf
            <button type="submit" class="w-full text-left text-red-400 hover:text-red-600">
                Keluar
            </button>
        </form>
    </aside>

    <!-- Area konten utama -->
    <div class="flex-1 flex flex-col">
        <!-- Header atas -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">
                {{ __('ARRAMCO TOUR & TRAVEL') }}
            </h1>

            <div class="flex items-center space-x-3">
                <span class="text-gray-600">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" 
                     alt="Avatar" class="w-8 h-8 rounded-full">
            </div>
        </header>

        <!-- Isi konten -->
        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</nav>
