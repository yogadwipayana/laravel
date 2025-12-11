@extends('admin.layout')

@section('title', 'Daftar Booking')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-bold text-white">Daftar Booking</h2>
        <p class="text-stone-400">Kelola semua reservasi meja dan aula</p>
    </div>
    <a href="{{ route('bookings.create') }}" class="bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg hover:bg-green-500 transition font-bold flex items-center gap-2">
        <i class="fas fa-plus"></i> Booking Baru
    </a>
</div>

<!-- Filter Section -->
<div class="bg-stone-800 border border-stone-700 p-6 rounded-2xl shadow-lg mb-8">
    <form action="{{ route('bookings.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div>
            <label class="block text-sm font-medium text-stone-300 mb-2">
                <i class="fas fa-search"></i> Cari
            </label>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Nama atau telepon..."
                   class="w-full px-4 py-2 bg-stone-900 border border-stone-600 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none placeholder-stone-600">
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-sm font-medium text-stone-300 mb-2">
                <i class="fas fa-filter"></i> Status
            </label>
            <select name="status" class="w-full px-4 py-2 bg-stone-900 border border-stone-600 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Date From -->
        <div>
            <label class="block text-sm font-medium text-stone-300 mb-2">
                <i class="fas fa-calendar"></i> Dari Tanggal
            </label>
            <input type="date" name="date_from" value="{{ request('date_from') }}"
                   class="w-full px-4 py-2 bg-stone-900 border border-stone-600 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none color-scheme-dark">
        </div>

        <!-- Date To -->
        <div>
            <label class="block text-sm font-medium text-stone-300 mb-2">
                <i class="fas fa-calendar"></i> Sampai Tanggal
            </label>
            <input type="date" name="date_to" value="{{ request('date_to') }}"
                   class="w-full px-4 py-2 bg-stone-900 border border-stone-600 text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none color-scheme-dark">
        </div>

        <!-- Buttons -->
        <div class="md:col-span-4 flex space-x-2 justify-end mt-2">
            <a href="{{ route('bookings.index') }}" class="bg-stone-700 text-stone-300 px-6 py-2 rounded-lg hover:bg-stone-600 transition">
                Reset
            </a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-500 transition font-medium">
                Terapkan Filter
            </button>
        </div>
    </form>
</div>

<!-- Bookings Table -->
<div class="bg-stone-800 border border-stone-700 rounded-2xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-stone-700/50 text-stone-300 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Nama Pelanggan</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Nomor HP</th>
                    <th class="px-6 py-4">Waktu</th>
                    <th class="px-6 py-4">Pax</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-700 text-stone-300 text-sm">
                @forelse($bookings as $booking)
                <tr class="hover:bg-stone-700/30 transition-colors">
                    <td class="px-6 py-4 font-mono text-stone-500">#{{ $booking->id }}</td>
                    <td class="px-6 py-4 font-medium text-white">{{ $booking->name }}</td>
                    <td class="px-6 py-4">
                        @if(isset($booking->type) && $booking->type == 'aula')
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-900/50 text-purple-300 border border-purple-500/30">Aula</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-900/50 text-blue-300 border border-blue-500/30">Meja</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->phone) }}" target="_blank" class="text-green-500 hover:text-green-400">
                             {{ $booking->phone }} <i class="fab fa-whatsapp text-xs ml-1"></i>
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-white">{{ date('d M Y', strtotime($booking->date)) }}</span>
                            <span class="text-stone-500">{{ date('H:i', strtotime($booking->time)) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $booking->people }}</td>
                    <td class="px-6 py-4">
                        @if($booking->status === 'pending')
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-900/50 text-yellow-300 border border-yellow-500/30">Pending</span>
                        @elseif($booking->status === 'confirmed')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-900/50 text-green-300 border border-green-500/30">Confirmed</span>
                        @elseif($booking->status === 'completed')
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-900/50 text-blue-300 border border-blue-500/30">Completed</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-900/50 text-red-300 border border-red-500/30">Cancelled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('bookings.show', $booking->id) }}" class="p-2 rounded-lg bg-blue-600/10 text-blue-400 hover:bg-blue-600 hover:text-white transition" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="p-2 rounded-lg bg-yellow-600/10 text-yellow-400 hover:bg-yellow-600 hover:text-white transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Hapus booking ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-red-600/10 text-red-400 hover:bg-red-600 hover:text-white transition" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-stone-500">
                        <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                        <p>Belum ada data booking.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-stone-700 bg-stone-800">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
