<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Warung Bali Sangeh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-stone-900 text-stone-200">
    <!-- Navigation -->
    <nav class="bg-stone-800 shadow-xl border-b border-stone-700">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-white">
                        <i class="fas fa-utensils text-green-500"></i>
                        Warung Bali Sangeh
                    </h1>
                    <span class="text-sm text-stone-500">Admin Panel</span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="text-stone-400 hover:text-green-400 transition-colors">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('bookings.index') }}" class="text-stone-400 hover:text-green-400 transition-colors">
                        <i class="fas fa-calendar-alt"></i> Bookings
                    </a>
                    <a href="/wbs" class="text-stone-400 hover:text-green-400 transition-colors" target="_blank">
                        <i class="fas fa-eye"></i> Landing Page
                    </a>
                    
                    <!-- User Menu -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-stone-300 hover:text-white transition-colors">
                            <i class="fas fa-user-circle text-2xl"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-stone-800 border border-stone-700 rounded-lg shadow-2xl py-2 hidden group-hover:block z-50">
                            <div class="px-4 py-2 border-b border-stone-700">
                                <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-stone-500">{{ Auth::user()->email }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-stone-700 transition-colors">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-900/50 border border-green-500/50 text-green-300 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-red-900/50 border border-red-500/50 text-red-300 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-stone-800 border-t border-stone-700 mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-stone-500">
            <p>&copy; {{ date('Y') }} Warung Bali Sangeh. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Auto-hide flash messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('[role="alert"]').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
