<aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-2xl transition-transform duration-300 z-40">
    <!-- Logo Section -->
    <div class="flex items-center justify-between p-6 border-b border-blue-500">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-xl font-bold">Yoga App</span>
        </div>
        <button id="closeSidebar" class="lg:hidden text-white hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-6 px-4">
        <ul class="space-y-2">
            <li>
                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->is('/') ? 'bg-blue-700' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="font-medium">Home</span>
                </a>
            </li>
            <li>
                <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->is('dashboard') ? 'bg-blue-700' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/produk" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->is('produk*') ? 'bg-blue-700' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="font-medium">Produk</span>
                </a>
            </li>
            <li>
                <a href="/guest/list" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->is('guest/list') ? 'bg-blue-700' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span class="font-medium">Guest List</span>
                </a>
            </li>
            <li>
                <a href="/guest" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors {{ request()->is('guest') && !request()->is('guest/list') ? 'bg-blue-700' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span class="font-medium">Guest Form</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer Section -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-blue-500">
        <div class="flex items-center space-x-3 px-4 py-2">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                <span class="text-sm font-semibold">YA</span>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium">Admin</p>
                <p class="text-xs text-blue-200">admin@yogaapp.com</p>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay for mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

<script>
    // Mobile sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const closeSidebar = document.getElementById('closeSidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    }
</script>
