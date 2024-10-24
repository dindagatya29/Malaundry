<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaLaundry - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary { background-color: #51C228; }
        .text-primary { color: #4CAF50; }
        .hover\:bg-primary-dark:hover { background-color: #45a049; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 flex flex-col">
            <div class="p-5 bg-primary">
                <h1 class="text-2xl font-bold text-white">MaLaundry</h1>
            </div>
            <!-- Profile Section -->
            <div class="p-4 bg-gray-700">
                <div class="flex items-center">
                    <img src="https://malaundry.com/logo/20210323145733/logo-text.jpg" alt="Logo" class="w-10 h-10 rounded-full mr-3 object-cover">
                    <div>
                        <p class="font-semibold">{{ Auth::user()->name ?? 'Guest' }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->role ?? 'VISITOR' }}</p>
                    </div>
                </div>
            </div>
            
            
            <nav class="flex-1">
                <p class="px-4 py-2 text-xs text-gray-600 uppercase">Main Navigation</p>
                <a href="{{ route('dashboard') }}" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 8h18m-9 5v6m-4-6a4 4 0 00-8 0m16 0a4 4 0 00-8 0"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('satuan_units.index') }}" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h10M7 4h10"></path>
                    </svg>
                    Satuan Unit
                </a>
                <a href="{{ route('paket_kuotas.index') }}" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l1.292-1.292A1 1 0 015.414 5h13.172a1 1 0 01.707 1.707L21 7m-18 0h18m-18 0v13a2 2 0 002 2h14a2 2 0 002-2V7H3z"></path>
                    </svg>
                    Paket Kuota
                </a>
                <a href="" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2 5h5l-4 3 2 5-5-4-5 4 2-5-4-3h5z"></path>
                    </svg>
                    Register
                </a>
                <a href="" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 13v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m12-6V4a2 2 0 00-2-2H8a2 2 0 00-2 2v3m12 0h-4"></path>
                    </svg>
                    Pengeluaran
                </a>
                <a href="" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v2m6-10l-3-3m0 0l-3 3m3-3v8"></path>
                    </svg>
                    Statistik
                </a>
                <a href="" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17l-4 4m0-4l4-4m-4 4h12m-12 0l4 4m0-4l-4-4"></path>
                    </svg>
                    Kas Laundry
                </a>
                <a href="" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v2m6-10l-3-3m0 0l-3 3m3-3v8"></path>
                    </svg>
                    Pembayaran
                </a>
                <a href="" class="flex items-center py-2 px-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v2m6-10l-3-3m0 0l-3 3m3-3v8"></path>
                    </svg>
                    Laporan Keuangan
                </a>
                

            </nav>
            <div class="p-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-primary shadow-md">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-white">@yield('header')</h1>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-white mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <div class="flex items-center bg-green-600 rounded-full px-3 py-1">
                            <div class="w-8 h-8 rounded-full bg-white mr-2"></div>
                            <span class="text-white font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                            <svg class="w-4 h-4 text-white ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>