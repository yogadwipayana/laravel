@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-white">Dashboard</h2>
    <p class="text-stone-400">Overview statistik pemesanan meja restoran</p>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
    <!-- Card 1: Booking Hari Ini -->
    <a href="{{ route('bookings.index', ['date_from' => date('Y-m-d'), 'date_to' => date('Y-m-d')]) }}" 
       class="bg-blue-600/20 border border-blue-500/30 text-blue-200 p-6 rounded-2xl shadow-lg hover:bg-blue-600/30 transition backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-300 text-sm">Booking Hari Ini</p>
                <p class="text-4xl font-bold mt-2 text-white">{{ $bookingsToday }}</p>
            </div>
            <i class="fas fa-calendar-day text-5xl text-blue-500/50"></i>
        </div>
    </a>

    <!-- Card 2: Booking Minggu Ini -->
    <a href="{{ route('bookings.index') }}" 
       class="bg-green-600/20 border border-green-500/30 text-green-200 p-6 rounded-2xl shadow-lg hover:bg-green-600/30 transition backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-300 text-sm">Booking Minggu Ini</p>
                <p class="text-4xl font-bold mt-2 text-white">{{ $bookingsWeek }}</p>
            </div>
            <i class="fas fa-calendar-week text-5xl text-green-500/50"></i>
        </div>
    </a>

    <!-- Card 3: Status Pending -->
    <a href="{{ route('bookings.index', ['status' => 'pending']) }}" 
       class="bg-yellow-600/20 border border-yellow-500/30 text-yellow-200 p-6 rounded-2xl shadow-lg hover:bg-yellow-600/30 transition backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-300 text-sm">Status Pending</p>
                <p class="text-4xl font-bold mt-2 text-white">{{ $bookingsPending }}</p>
            </div>
            <i class="fas fa-clock text-5xl text-yellow-500/50"></i>
        </div>
    </a>

    <!-- Card 4: Status Confirmed -->
    <a href="{{ route('bookings.index', ['status' => 'confirmed']) }}" 
       class="bg-purple-600/20 border border-purple-500/30 text-purple-200 p-6 rounded-2xl shadow-lg hover:bg-purple-600/30 transition backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-300 text-sm">Status Confirmed</p>
                <p class="text-4xl font-bold mt-2 text-white">{{ $bookingsConfirmed }}</p>
            </div>
            <i class="fas fa-check-circle text-5xl text-purple-500/50"></i>
        </div>
    </a>

    <!-- Card 5: Total Orang -->
    <div class="bg-red-600/20 border border-red-500/30 text-red-200 p-6 rounded-2xl shadow-lg backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-red-300 text-sm">Total Pax Hari Ini</p>
                <p class="text-4xl font-bold mt-2 text-white">{{ $totalPeopleToday }}</p>
            </div>
            <i class="fas fa-users text-5xl text-red-500/50"></i>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Weekly Chart -->
    <div class="bg-stone-800 border border-stone-700 p-6 rounded-2xl shadow-lg">
        <h3 class="text-xl font-bold text-white mb-4">
            <i class="fas fa-chart-line text-blue-500"></i> Booking 7 Hari Terakhir
        </h3>
        <canvas id="weeklyChart"></canvas>
    </div>

    <!-- Status Distribution -->
    <div class="bg-stone-800 border border-stone-700 p-6 rounded-2xl shadow-lg">
        <h3 class="text-xl font-bold text-white mb-4">
            <i class="fas fa-chart-pie text-green-500"></i> Distribusi Status
        </h3>
        <canvas id="statusChart"></canvas>
    </div>
</div>

<!-- Recent Bookings -->
<div class="bg-stone-800 border border-stone-700 p-6 rounded-2xl shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-white">
            <i class="fas fa-list text-green-500"></i> 5 Booking Terakhir
        </h3>
        <a href="{{ route('bookings.index') }}" class="text-green-500 hover:text-green-400 font-semibold transition-colors">
            Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-stone-700/50 text-stone-300 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 rounded-tl-lg">Nama</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Tanggal & Jam</th>
                    <th class="px-6 py-4">Pax</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 rounded-tr-lg">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-700 text-stone-300 text-sm">
                @forelse($recentBookings as $booking)
                <tr class="hover:bg-stone-700/30 transition-colors">
                    <td class="px-6 py-4 font-medium text-white">{{ $booking->name }}</td>
                    <td class="px-6 py-4">
                         @if(isset($booking->type) && $booking->type == 'aula')
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-900/50 text-purple-300 border border-purple-500/30">Aula</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-900/50 text-blue-300 border border-blue-500/30">Meja</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="font-bold text-white">{{ date('d M Y', strtotime($booking->date)) }}</span>
                            <span class="text-stone-500">{{ date('H:i', strtotime($booking->time)) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">{{ $booking->people }} Orang</td>
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
                    <td class="px-6 py-4">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-400 hover:text-blue-300 transition-colors">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-stone-500">Belum ada booking terbaru</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 flex justify-center space-x-4">
    <a href="{{ route('bookings.create') }}" class="bg-green-600 text-white px-8 py-4 rounded-xl shadow-lg hover:bg-green-500 transition font-bold flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Booking
    </a>
    <a href="{{ route('bookings.index') }}" class="bg-stone-700 text-white px-8 py-4 rounded-xl shadow-lg hover:bg-stone-600 transition font-bold flex items-center gap-2">
        <i class="fas fa-list"></i> Semua Booking
    </a>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    Chart.defaults.color = '#a8a29e';
    Chart.defaults.borderColor = '#44403c';

    // Weekly Chart
    const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyData = @json($weeklyStats);
    
    new Chart(weeklyCtx, {
        type: 'line',
        data: {
            labels: weeklyData.map(item => {
                const date = new Date(item.booking_date);
                return date.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' });
            }),
            datasets: [{
                label: 'Jumlah Booking',
                data: weeklyData.map(item => item.total),
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointBackgroundColor: '#22c55e'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#44403c' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusData = @json($statusStats);
    
    const statusColors = {
        'pending': '#eab308',
        'confirmed': '#22c55e',
        'completed': '#3b82f6',
        'cancelled': '#ef4444'
    };
    
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusData.map(item => item.status.charAt(0).toUpperCase() + item.status.slice(1)),
            datasets: [{
                data: statusData.map(item => item.total),
                backgroundColor: statusData.map(item => statusColors[item.status] || '#6B7280'),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#d6d3d1' }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection
