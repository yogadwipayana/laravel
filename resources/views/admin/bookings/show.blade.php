@extends('admin.layout')

@section('title', 'Detail Booking')

@section('content')
<div class="mb-6">
    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-2">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500">Dashboard</a>
        <span>/</span>
        <a href="{{ route('bookings.index') }}" class="hover:text-orange-500">Bookings</a>
        <span>/</span>
        <span class="text-gray-800">Detail #{{ $booking->id }}</span>
    </div>
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Detail Booking #{{ $booking->id }}</h2>
            <p class="text-gray-600">Informasi lengkap pemesanan meja</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('bookings.edit', $booking->id) }}" 
               class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('bookings.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Info Card -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">
                <i class="fas fa-info-circle text-orange-500"></i> Informasi Booking
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Pelanggan -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        <i class="fas fa-user"></i> Nama Pelanggan
                    </label>
                    <p class="text-lg font-semibold text-gray-800">{{ $booking->name }}</p>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        <i class="fas fa-phone"></i> Nomor Telepon
                    </label>
                    <p class="text-lg font-semibold text-gray-800">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->phone) }}" 
                           target="_blank" 
                           class="text-green-600 hover:text-green-800">
                            <i class="fab fa-whatsapp"></i> {{ $booking->phone }}
                        </a>
                    </p>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        <i class="fas fa-calendar"></i> Tanggal Booking
                    </label>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ date('l, d F Y', strtotime($booking->date)) }}
                    </p>
                </div>

                <!-- Jam -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        <i class="fas fa-clock"></i> Jam Booking
                    </label>
                    <p class="text-lg font-semibold text-gray-800">{{ date('H:i', strtotime($booking->time)) }} WIB</p>
                </div>

                <!-- Jumlah Orang -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        <i class="fas fa-users"></i> Jumlah Orang
                    </label>
                    <p class="text-lg font-semibold text-gray-800">{{ $booking->people }} orang</p>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">
                        <i class="fas fa-info-circle"></i> Status
                    </label>
                    <p class="text-lg font-semibold">
                        @if($booking->status === 'pending')
                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                        @elseif($booking->status === 'confirmed')
                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle"></i> Confirmed
                            </span>
                        @elseif($booking->status === 'completed')
                            <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-check-double"></i> Completed
                            </span>
                        @else
                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-times-circle"></i> Cancelled
                            </span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Catatan -->
            @if($booking->notes)
            <div class="mt-6 pt-6 border-t">
                <label class="block text-sm font-medium text-gray-500 mb-2">
                    <i class="fas fa-sticky-note"></i> Catatan Khusus
                </label>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-800">{{ $booking->notes }}</p>
                </div>
            </div>
            @endif

            <!-- Audit Info -->
            <div class="mt-6 pt-6 border-t">
                <label class="block text-sm font-medium text-gray-500 mb-2">
                    <i class="fas fa-history"></i> Informasi Tambahan
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-plus mr-2 text-green-500"></i>
                        <div>
                            <span class="block text-xs text-gray-500">Dibuat pada</span>
                            <strong>{{ date('d/m/Y H:i', strtotime($booking->created_at)) }}</strong>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-check mr-2 text-blue-500"></i>
                        <div>
                            <span class="block text-xs text-gray-500">Diubah terakhir</span>
                            <strong>{{ date('d/m/Y H:i', strtotime($booking->updated_at)) }}</strong>
                        </div>
                    </div>
                    @if($creator)
                    <div class="flex items-center md:col-span-2">
                        <i class="fas fa-user-shield mr-2 text-purple-500"></i>
                        <div>
                            <span class="block text-xs text-gray-500">Dibuat oleh</span>
                            <strong>{{ $creator->name }}</strong>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="space-y-6">
        <!-- Quick Status Update -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-edit text-orange-500"></i> Ubah Status
            </h3>
            
            <form action="{{ route('bookings.update-status', $booking->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="space-y-3">
                    <label>
                        <input type="radio" name="status" value="pending" 
                               {{ $booking->status === 'pending' ? 'checked' : '' }} 
                               class="mr-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    </label>
                    
                    <label>
                        <input type="radio" name="status" value="confirmed" 
                               {{ $booking->status === 'confirmed' ? 'checked' : '' }} 
                               class="mr-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800">Confirmed</span>
                    </label>
                    
                    <label>
                        <input type="radio" name="status" value="completed" 
                               {{ $booking->status === 'completed' ? 'checked' : '' }} 
                               class="mr-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Completed</span>
                    </label>
                    
                    <label>
                        <input type="radio" name="status" value="cancelled" 
                               {{ $booking->status === 'cancelled' ? 'checked' : '' }} 
                               class="mr-2">
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800">Cancelled</span>
                    </label>
                </div>

                <button type="submit" class="w-full mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-save"></i> Update Status
                </button>
            </form>
        </div>

        <!-- WhatsApp Integration -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fab fa-whatsapp text-green-500"></i> WhatsApp
            </h3>
            
            @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $booking->phone);
                $message = urlencode("Om Swastiastu {$booking->name},\n\nKonfirmasi Pemesanan Meja:\n📅 Tanggal: " . date('d/m/Y', strtotime($booking->date)) . "\n🕐 Jam: " . date('H:i', strtotime($booking->time)) . "\n👥 Jumlah Orang: {$booking->people}\n\nMohon tiba 5-10 menit lebih awal.\nSilakan hubungi kami jika ada perubahan.\n\nTerima kasih! 🙏\nWarung Bali Sangeh");
                $waUrl = "https://wa.me/{$cleanPhone}?text={$message}";
            @endphp

            <a href="{{ $waUrl }}" target="_blank" 
               class="block w-full px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-center">
                <i class="fab fa-whatsapp"></i> Kirim Konfirmasi
            </a>

            <p class="mt-3 text-xs text-gray-500 text-center">
                Akan membuka WhatsApp dengan template pesan konfirmasi
            </p>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-cogs text-orange-500"></i> Aksi Lainnya
            </h3>
            
            <div class="space-y-3">
                <a href="{{ route('bookings.edit', $booking->id) }}" 
                   class="block w-full px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition text-center">
                    <i class="fas fa-edit"></i> Edit Booking
                </a>

                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus booking ini?\n\nNama: {{ $booking->name }}\nTanggal: {{ date('d/m/Y', strtotime($booking->date)) }}\n\nTindakan ini tidak dapat dibatalkan!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-trash"></i> Hapus Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
