<nav class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 shadow-sm z-30 lg:pl-64">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Mobile Menu Button & Logo -->
        <div class="flex items-center space-x-4">
            <button id="toggleSidebar" class="lg:hidden text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center lg:hidden">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-4 py-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none ml-2 text-sm text-gray-700 w-48">
            </div>

            <!-- Notifications -->
            <button class="relative text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
            </button>

            <!-- User Menu -->
            <div class="flex items-center space-x-2">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-sm font-semibold text-white">YA</span>
                </div>
            </div>
        </div>
    </div>
</nav>
