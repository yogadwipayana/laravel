<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Dashboard' }} - Yoga App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        @else
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        @endif
        
        <style>
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            ::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 4px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
            
            /* Sidebar transition on mobile */
            @media (max-width: 1023px) {
                #sidebar {
                    transform: translateX(-100%);
                }
            }
        </style>
    </head>
    <body class="bg-gray-50 min-h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="lg:pl-64">
            <!-- Navbar -->
            @include('components.navbar', ['title' => $title ?? 'Dashboard'])

            <!-- Page Content -->
            <main class="pt-20 p-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
