<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Warung Bali Sangeh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-stone-900 min-h-screen flex items-center justify-center p-4">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/sawah.jpg') }}" class="w-full h-full object-cover opacity-20">
    </div>
    
    <div class="w-full max-w-md relative z-10">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-md">Warung Bali Sangeh</h1>
            <p class="text-green-400 max-w-xs mx-auto text-sm uppercase tracking-widest">Admin Portal</p>
        </div>

        <!-- Login Card -->
        <div class="bg-stone-900/80 backdrop-blur-md border border-stone-700/50 rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">
                Selamat Datang
            </h2>

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="bg-green-900/50 border border-green-500/50 text-green-300 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-900/50 border border-red-500/50 text-red-300 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-900/50 border border-red-500/50 text-red-300 px-4 py-3 rounded mb-4" role="alert">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-stone-300 mb-2">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-stone-800 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all placeholder-stone-600"
                           placeholder="admin@wbs.com">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-stone-300 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-3 bg-stone-800 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all placeholder-stone-600"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-500 transition shadow-lg shadow-green-900/20 font-bold tracking-wide">
                    LOGIN
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-stone-400 text-sm">
                    Belum punya akses? 
                    <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300 font-semibold transition-colors">
                        Daftar disini
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-stone-500 text-xs">
            <p>&copy; {{ date('Y') }} Warung Bali Sangeh.</p>
        </div>
    </div>
</body>
</html>
