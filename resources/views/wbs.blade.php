<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Bali Sangeh - Reservasi & Kuliner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <span class="text-2xl font-bold text-white drop-shadow-md">Warung Bali Sangeh</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#home" class="text-white hover:text-green-400 font-medium transition-colors">Beranda</a>
                        <a href="#packages" class="text-white hover:text-green-400 font-medium transition-colors">Paket Reservasi</a>
                        <a href="#menu" class="text-white hover:text-green-400 font-medium transition-colors">Menu</a>
                        <a href="#reviews" class="text-white hover:text-green-400 font-medium transition-colors">Testimoni</a>
                    </div>
                </div>
                <div>
                     <a href="https://wa.me/628999999999?text=Halo%20Admin,%20saya%20mau%20reservasi" target="_blank" 
                       class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-full font-semibold transition-all shadow-lg hover:shadow-green-500/30 flex items-center gap-2">
                        <span>Pesan Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="home" class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/sawah.jpg') }}" alt="Pemandangan Sawah Sangeh" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-stone-50"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-16">
            <span class="inline-block py-1 px-3 rounded-full bg-green-500/20 border border-green-400/30 text-green-300 text-sm font-semibold mb-6 backdrop-blur-sm">
                🌿 Tempat Terbaik Untuk Acara Spesial Anda
            </span>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-xl">
                Sensasi Kuliner Bali <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">Dengan View Sawah</span>
            </h1>
            <p class="text-lg md:text-xl text-stone-200 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
                Nikmati hidangan lezat dan suasana tenang untuk makan keluarga, meeting, atau acara pernikahan.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#packages" class="px-8 py-4 bg-green-600 text-white rounded-full font-bold shadow-xl hover:bg-green-700 transition-transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    Lihat Paket
                </a>
                <a href="https://wa.me/628999999999" class="px-8 py-4 bg-white/10 text-white rounded-full font-bold backdrop-blur-md border border-white/30 hover:bg-white/20 transition-transform hover:-translate-y-1">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </header>

    <!-- Packages Section (Pricing) -->
    <section id="packages" class="py-24 bg-white relative">
         <div class="absolute top-0 inset-x-0 h-40 bg-gradient-to-b from-stone-50 to-white"></div>
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <span class="text-green-600 font-bold tracking-wider uppercase text-sm">Pilihan Paket</span>
                <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mt-2">Sesuaikan Dengan Kebutuhan</h2>
                <div class="w-24 h-1 bg-green-500 mx-auto rounded-full mt-6"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Table Package -->
                <div class="bg-stone-50 rounded-3xl p-8 border border-stone-200 shadow-lg hover:shadow-2xl transition-all duration-300 flex flex-col">
                    <div class="h-48 rounded-2xl overflow-hidden mb-6 relative">
                         <img src="{{ asset('images/suasana makan.jpg') }}" alt="Meja Makan" class="w-full h-full object-cover">
                         <div class="absolute top-4 right-4 bg-green-600 text-white px-3 py-1 rounded-full text-sm font-bold">Populer</div>
                    </div>
                    <h3 class="text-2xl font-bold text-stone-800 mb-2">Reservasi Meja Keluarga</h3>
                    <p class="text-stone-600 mb-6">Cocok untuk makan siang santai, reuni kecil, atau makan malam romantis dengan keluarga.</p>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Pilihan Lesehan / Meja Kursi</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Tanpa Minimum Order</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Free WiFi & Parkir Luas</span>
                        </li>
                         <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Best View Sawah</span>
                        </li>
                    </ul>
                    
                    <a href="https://wa.me/628999999999?text=Halo%20Admin,%20saya%20mau%20reservasi%20meja%20keluarga" class="w-full py-4 bg-white border-2 border-green-600 text-green-700 rounded-xl font-bold hover:bg-green-600 hover:text-white transition-colors text-center">
                        Pesan Meja
                    </a>
                </div>

                <!-- Aula Package -->
                <div class="bg-stone-900 text-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 flex flex-col transform md:-translate-y-4">
                    <div class="h-48 rounded-2xl overflow-hidden mb-6 relative">
                         <img src="{{ asset('images/aula.jpg') }}" alt="Aula Pertemuan" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity">
                         <div class="absolute top-4 right-4 bg-yellow-500 text-black px-3 py-1 rounded-full text-sm font-bold">Best Deal</div>
                    </div>
                    <div class="flex justify-between items-baseline mb-2">
                        <h3 class="text-2xl font-bold">Sewa Aula / Hall</h3>
                        <span class="text-sm text-stone-400">Mulai Rp 500rb</span>
                    </div>
                    <p class="text-stone-300 mb-6">Solusi sempurna untuk Meeting, Gathering Kantor, Wedding, atau Ulang Tahun.</p>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Kapasitas Besar (50-100 Pax)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Termasuk Sound System Standard</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Opsi Prasmanan / Buffet</span>
                        </li>
                         <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Private Area</span>
                        </li>
                    </ul>
                    
                    <a href="https://wa.me/628999999999?text=Halo%20Admin,%20saya%20tertarik%20sewa%20Aula" class="w-full py-4 bg-green-600 text-white rounded-xl font-bold hover:bg-green-500 transition-colors text-center shadow-lg shadow-green-900/50">
                        Tanya Ketersediaan Aula
                    </a>
                </div>
            </div>
         </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-24 bg-stone-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-green-600 font-bold tracking-wider uppercase text-sm">Menu Favorit</span>
                <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mt-2">Pelengkap Acara Anda</h2>
            </div>
            <!-- (Existing Menu Grid Code - Preserved) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Menu Item 1 -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ asset('images/Gurame Nyat-nyat.jpg') }}" alt="Gurame Nyat-Nyat" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-stone-900 mb-2">Gurame Nyat-Nyat</h3>
                         <p class="text-stone-500 text-sm mb-4">Ikan gurame segar dimasak bumbu genep.</p>
                    </div>
                </div>
                 <!-- Menu Item 2 -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ asset('images/Gurami bakar.jpg') }}" alt="Gurami Bakar" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-stone-900 mb-2">Gurame Bakar Madu</h3>
                         <p class="text-stone-500 text-sm mb-4">Dibakar dengan olesan madu spesial.</p>
                    </div>
                </div>
                 <!-- Menu Item 3 -->
                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ asset('images/Kuah Gurami.jpg') }}" alt="Sup Kepala Ikan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-stone-900 mb-2">Sup Gurame</h3>
                         <p class="text-stone-500 text-sm mb-4">Kuah segar rempah ringan.</p>
                    </div>
                </div>
            </div>
             <div class="text-center mt-10">
                <a href="#" class="inline-block border-b-2 border-green-600 text-green-700 font-bold hover:text-green-800 pb-1">Lihat Menu Lengkap & Harga Prasmanan</a>
            </div>
        </div>
    </section>

    <!-- Testimonials / Reviews Section -->
    <section id="reviews" class="py-24 bg-white">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-green-600 font-bold tracking-wider uppercase text-sm">Apa Kata Mereka?</span>
                <h2 class="text-3xl md:text-4xl font-bold text-stone-800 mt-2">Ulasan Pelanggan</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-stone-50 p-8 rounded-3xl shadow-sm border border-stone-100 flex flex-col justify-between">
                    <div>
                        <div class="flex text-yellow-400 mb-4">★★★★★</div>
                        <p class="text-stone-700 italic mb-6">"Wow kereeen... Warung Bali Sangeh...viewnya bagus Ratu Dayu, bu jero Melati , lama tidak ke sana...kangen gurami bakar."</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center text-green-800 font-bold text-xl">R</div>
                        <div>
                            <div class="font-bold text-stone-900">Ratu Dayu</div>
                            <div class="text-xs text-stone-500">Lokal Guide</div>
                        </div>
                    </div>
                </div>

                 <!-- Review 2 -->
                <div class="bg-stone-50 p-8 rounded-3xl shadow-sm border border-stone-100 flex flex-col justify-between">
                    <div>
                        <div class="flex text-yellow-400 mb-4">★★★★★</div>
                        <p class="text-stone-700 italic mb-6">"Tempatnya sangat nyaman untuk keluarga. Anak-anak senang memberi makan ikan di kolam sambil menunggu makanan datang."</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center text-blue-800 font-bold text-xl">B</div>
                        <div>
                            <div class="font-bold text-stone-900">Budi Santoso</div>
                            <div class="text-xs text-stone-500">Family Trip</div>
                        </div>
                    </div>
                </div>

                 <!-- Review 3 -->
                <div class="bg-stone-50 p-8 rounded-3xl shadow-sm border border-stone-100 flex flex-col justify-between">
                    <div>
                        <div class="flex text-yellow-400 mb-4">★★★★★</div>
                        <p class="text-stone-700 italic mb-6">"Pernah sewa aula untuk gathering kantor, pelayanannya ramah dan makanannya enak-enak. Recommended!"</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center text-orange-800 font-bold text-xl">S</div>
                        <div>
                            <div class="font-bold text-stone-900">Siti Aminah</div>
                            <div class="text-xs text-stone-500">Corporate Event</div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    </section>

    <!-- Footer -->
    <footer id="location" class="bg-stone-900 py-16 text-stone-400">
        <!-- (Existing Footer Content) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <h3 class="text-2xl font-bold text-white mb-6">Warung Bali Sangeh</h3>
                <p class="leading-relaxed mb-6">
                    Rasakan sensasi kuliner Bali dengan pemandangan sawah yang menenangkan.
                </p>
            </div>
            <div>
                 <h4 class="text-lg font-bold text-white mb-6">Kontak</h4>
                 <ul class="space-y-4">
                    <li>Jl. Ciung Wanara, Sangeh</li>
                    <li>0899-9999-999</li>
                 </ul>
            </div>
            <div>
                 <h4 class="text-lg font-bold text-white mb-6">Jam Buka</h4>
                 <p>Setiap Hari: 08:00 - 22:00</p>
            </div>
        </div>
        <div class="border-t border-stone-800 mt-16 pt-8 text-center text-sm">
            &copy; 2025 Warung Bali Sangeh.
        </div>
    </footer>

    <!-- Fixed CTA -->
    <a href="https://wa.me/628999999999?text=Halo%20Warung%20Bali%20Sangeh,%20saya%20tertarik%20dengan%20paket%20reservasi" target="_blank" class="fixed bottom-8 right-8 z-50 bg-green-500 text-white px-6 py-3 rounded-full shadow-2xl hover:bg-green-600 hover:scale-105 transition-all duration-300 font-bold flex items-center gap-2 group">
        <span>Chat WhatsApp</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
    </a>

</body>
</html>