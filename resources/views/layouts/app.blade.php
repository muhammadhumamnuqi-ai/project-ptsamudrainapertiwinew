<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIP ABK - PT. Samudra Ina Pertiwi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Heroicons / FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
    @yield('styles')
</head>
<body class="h-full text-slate-800 antialiased">
    @include('sweetalert::alert')

    <div class="min-h-full flex">
        <!-- Sidebar Desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-slate-900 border-r border-slate-800">
            <div class="flex flex-col flex-1 min-h-0">
                <!-- Logo -->
                <div class="flex items-center h-24 flex-shrink-0 px-6 bg-slate-900 border-b border-slate-800">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto mr-3">
                    <span class="text-white font-bold text-lg tracking-wider">SAMUDRA SIP</span>
                </div>
                <!-- Navigation -->
                <div class="flex-1 flex flex-col overflow-y-auto px-4 py-4 space-y-6">
                    <div class="space-y-1">
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider px-3 mb-2">Main Menu</p>
                        
                        <!-- Dashboard Links by Role -->
                        @if(auth()->user()->hasRole('super_admin'))
                            <a href="{{ route('dashboard.admin') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('dashboard.admin') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i class="fa-solid fa-chart-line w-6 text-center mr-2"></i>
                                Dashboard Admin
                            </a>
                            <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.users*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i class="fa-solid fa-users-gear w-6 text-center mr-2"></i>
                                Kelola Pengguna
                            </a>
                            <a href="{{ route('admin.logs') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('admin.logs') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i class="fa-solid fa-clock-rotate-left w-6 text-center mr-2"></i>
                                Log Aktivitas
                            </a>
                        @endif

                        @if(auth()->user()->hasRole('operator') || auth()->user()->hasRole('super_admin'))
                            <a href="{{ route('dashboard.operator') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('dashboard.operator') || request()->routeIs('operator.abk.show') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i class="fa-solid fa-users w-6 text-center mr-2"></i>
                                Dashboard Operator
                            </a>
                            <a href="{{ route('reports.export.pdf') }}" target="_blank" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all text-slate-400 hover:bg-slate-800 hover:text-white">
                                <i class="fa-solid fa-print w-6 text-center mr-2"></i>
                                Cetak Laporan PDF
                            </a>
                            <a href="{{ route('reports.export.csv') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all text-slate-400 hover:bg-slate-800 hover:text-white">
                                <i class="fa-solid fa-file-excel w-6 text-center mr-2"></i>
                                Ekspor Excel/CSV
                            </a>
                        @endif

                        @if(auth()->user()->hasRole('abk'))
                            <a href="{{ route('dashboard.abk') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all {{ request()->routeIs('dashboard.abk') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                                <i class="fa-solid fa-user-tie w-6 text-center mr-2"></i>
                                Status Pendaftaran
                            </a>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-slate-800 space-y-1">
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider px-3 mb-2">Sistem</p>
                        <a href="/" class="flex items-center px-3 py-2 text-sm font-medium text-slate-400 rounded-lg hover:bg-slate-800 hover:text-white transition-all">
                            <i class="fa-solid fa-house w-6 text-center mr-2"></i>
                            Halaman Utama
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-3 py-2 text-sm font-medium text-red-400 rounded-lg hover:bg-red-500/10 hover:text-red-300 transition-all text-left">
                                <i class="fa-solid fa-right-from-bracket w-6 text-center mr-2"></i>
                                Keluar Aplikasi
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Logged User Card -->
                <div class="flex-shrink-0 flex bg-slate-950 p-4 border-t border-slate-800">
                    <div class="flex items-center">
                        <div>
                            @php
                                $profile = auth()->user()->profilAbk;
                                $photoPath = ($profile && $profile->foto_profil) ? asset('storage/' . $profile->foto_profil) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop';
                            @endphp
                            <img class="inline-block h-9 w-9 rounded-full object-cover ring-2 ring-blue-500/50" src="{{ $photoPath }}" alt="Foto">
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-semibold text-white truncate max-w-[140px]">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">{{ str_replace('_', ' ', auth()->user()->role) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="md:pl-64 flex flex-col flex-1 min-w-0">
            <!-- Mobile Header -->
            <div class="sticky top-0 z-10 flex-shrink-0 flex h-20 bg-white shadow border-b border-slate-200 md:hidden justify-between items-center px-4">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto mr-3">
                    <span class="font-bold text-slate-900 text-base">PT. SIP</span>
                </div>
                
                <div class="flex items-center space-x-3">
                    <!-- Simple Profile Indicator -->
                    <span class="text-xs font-semibold text-slate-600">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 text-sm"><i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                </div>
            </div>

            <!-- Page Body -->
            <main class="flex-1 py-8 px-4 sm:px-6 md:px-8">
                <!-- Page Title Area -->
                <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">@yield('page_title', 'Dashboard')</h1>
                        <p class="text-sm text-slate-500 mt-1">@yield('page_subtitle', 'Sistem Pendaftaran dan Penempatan ABK')</p>
                    </div>
                    <div>
                        @yield('page_actions')
                    </div>
                </div>

                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
