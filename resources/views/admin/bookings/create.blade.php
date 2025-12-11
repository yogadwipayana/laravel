@extends('admin.layout')

@section('title', 'Tambah Booking')

@section('content')
<div class="mb-8">
    <div class="flex items-center space-x-2 text-sm text-stone-400 mb-2">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-green-400 transition-colors">Dashboard</a>
        <span>/</span>
        <a href="{{ route('bookings.index') }}" class="hover:text-green-400 transition-colors">Bookings</a>
        <span>/</span>
        <span class="text-white">Tambah Booking</span>
    </div>
    <h2 class="text-3xl font-bold text-white">Tambah Booking Baru</h2>
    <p class="text-stone-400">Masukkan data pemesanan meja atau aula</p>
</div>

<div class="bg-stone-800 border border-stone-700 p-8 rounded-2xl shadow-lg max-w-3xl">
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tipe Booking -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-tag text-green-500"></i> Tipe Booking <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-4">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="type" value="table" class="peer hidden" {{ old('type', 'table') === 'table' ? 'checked' : '' }}>
                        <div class="p-4 rounded-xl border border-stone-600 bg-stone-700/50 peer-checked:bg-green-600/20 peer-checked:border-green-500 transition text-center hover:bg-stone-700">
                            <i class="fas fa-chair text-2xl mb-2 text-stone-400 peer-checked:text-green-400"></i>
                            <div class="font-bold text-stone-300 peer-checked:text-green-400">Reservasi Meja</div>
                        </div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="type" value="aula" class="peer hidden" {{ old('type') === 'aula' ? 'checked' : '' }}>
                        <div class="p-4 rounded-xl border border-stone-600 bg-stone-700/50 peer-checked:bg-purple-600/20 peer-checked:border-purple-500 transition text-center hover:bg-stone-700">
                            <i class="fas fa-building text-2xl mb-2 text-stone-400 peer-checked:text-purple-400"></i>
                            <div class="font-bold text-stone-300 peer-checked:text-purple-400">Sewa Aula</div>
                        </div>
                    </label>
                </div>
                @error('type')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Pelanggan -->
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-user text-green-500"></i> Nama Pelanggan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 bg-stone-900 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all placeholder-stone-600"
                       placeholder="Masukkan nama lengkap pelanggan">
                @error('name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div class="md:col-span-2">
                <label for="phone" class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-phone text-green-500"></i> Nomor Telepon/WhatsApp <span class="text-red-500">*</span>
                </label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                       class="w-full px-4 py-3 bg-stone-900 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all placeholder-stone-600"
                       placeholder="Contoh: 081234567890">
                @error('phone')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Booking -->
            <div>
                <label for="date" class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-calendar text-green-500"></i> Tanggal Booking <span class="text-red-500">*</span>
                </label>
                <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d', strtotime('+1 day'))) }}" required
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                       class="w-full px-4 py-3 bg-stone-900 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all color-scheme-dark">
                @error('date')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jam Booking -->
            <div>
                <label for="time" class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-clock text-green-500"></i> Jam Booking <span class="text-red-500">*</span>
                </label>
                <input type="time" name="time" id="time" value="{{ old('time', '19:00') }}" required
                       class="w-full px-4 py-3 bg-stone-900 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all color-scheme-dark">
                @error('time')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jumlah Orang -->
            <div>
                <label for="people" class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-users text-green-500"></i> Jumlah Pax <span class="text-red-500">*</span>
                </label>
                <input type="number" name="people" id="people" value="{{ old('people', 2) }}" required
                       min="1" max="50"
                       class="w-full px-4 py-3 bg-stone-900 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all placeholder-stone-600">
                @error('people')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-info-circle text-green-500"></i> Status
                </label>
                <select name="status" id="status"
                        class="w-full px-4 py-3 bg-stone-900 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all text-sm">
                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div class="md:col-span-2">
                <label for="notes" class="block text-sm font-medium text-stone-300 mb-2">
                    <i class="fas fa-sticky-note text-green-500"></i> Catatan Khusus (Opsional)
                </label>
                <textarea name="notes" id="notes" rows="4"
                          class="w-full px-4 py-3 bg-stone-900 border border-stone-700 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all placeholder-stone-600"
                          placeholder="Contoh: Meja dekat jendela, alergi seafood, dll.">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-stone-700">
            <a href="{{ route('bookings.index') }}" 
               class="px-6 py-3 border border-stone-600 rounded-xl text-stone-400 hover:bg-stone-700 hover:text-white transition font-medium">
                Batal
            </a>
            <button type="submit" 
                    class="px-8 py-3 bg-green-600 text-white rounded-xl hover:bg-green-500 transition shadow-lg shadow-green-900/20 font-bold tracking-wide">
                <i class="fas fa-save mr-2"></i> SIMPAN BOOKING
            </button>
        </div>
    </form>
</div>
@endsection
