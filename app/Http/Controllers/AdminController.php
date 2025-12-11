<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with statistics
     */
    public function index()
    {
        // Get today's date
        $today = date('Y-m-d');
        $weekStart = date('Y-m-d', strtotime('monday this week'));
        $weekEnd = date('Y-m-d', strtotime('sunday this week'));

        // Get statistics using DB query builder
        $bookingsToday = DB::table('bookings')
            ->whereDate('date', $today)
            ->count();

        $bookingsWeek = DB::table('bookings')
            ->whereBetween('date', [$weekStart, $weekEnd])
            ->count();

        $bookingsPending = DB::table('bookings')
            ->where('status', 'pending')
            ->count();

        $bookingsConfirmed = DB::table('bookings')
            ->where('status', 'confirmed')
            ->count();

        $totalPeopleToday = DB::table('bookings')
            ->whereDate('date', $today)
            ->sum('people');

        // Get recent 5 bookings
        $recentBookings = DB::table('bookings')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get weekly statistics for chart (last 7 days)
        $weeklyStats = DB::table('bookings')
            ->select(
                DB::raw('DATE(date) as booking_date'),
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('date', [
                date('Y-m-d', strtotime('-7 days')),
                date('Y-m-d')
            ])
            ->groupBy('booking_date')
            ->orderBy('booking_date', 'asc')
            ->get();

        // Get status distribution
        $statusStats = DB::table('bookings')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        return view('admin.dashboard', compact(
            'bookingsToday',
            'bookingsWeek',
            'bookingsPending',
            'bookingsConfirmed',
            'totalPeopleToday',
            'recentBookings',
            'weeklyStats',
            'statusStats'
        ));
    }
}
