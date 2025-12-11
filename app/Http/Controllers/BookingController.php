<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings with filters
     */
    public function index(Request $request)
    {
        $query = DB::table('bookings');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        // Search by name or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Order by date (newest first)
        $query->orderBy('date', 'desc')
              ->orderBy('time', 'desc');

        // Pagination
        $perPage = $request->get('per_page', 10);
        $bookings = $query->paginate($perPage)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking
     */
    public function create()
    {
        return view('admin.bookings.create');
    }

    /**
     * Store a newly created booking in database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'phone' => ['required', 'regex:/^(\+62|0)[0-9]{9,12}$/'],
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
            'people' => 'required|integer|between:1,50',
            'type' => ['required', Rule::in(['table', 'aula'])],
            'notes' => 'nullable|string|max:500',
            'status' => ['nullable', Rule::in(['pending', 'confirmed', 'completed', 'cancelled'])],
        ]);

        // Set default status if not provided
        $validated['status'] = $validated['status'] ?? 'pending';
        $validated['created_by'] = auth()->id() ?? null;

        // Insert using DB query builder
        $id = DB::table('bookings')->insertGetId([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'people' => $validated['people'],
            'type' => $validated['type'],
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
            'created_by' => $validated['created_by'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('bookings.show', $id)
            ->with('success', 'Booking berhasil ditambahkan!');
    }

    /**
     * Display the specified booking
     */
    public function show($id)
    {
        $booking = DB::table('bookings')
            ->where('id', $id)
            ->first();

        if (!$booking) {
            abort(404, 'Booking tidak ditemukan');
        }

        // Get creator info if exists
        $creator = null;
        if ($booking->created_by) {
            $creator = DB::table('users')
                ->where('id', $booking->created_by)
                ->first();
        }

        return view('admin.bookings.show', compact('booking', 'creator'));
    }

    /**
     * Show the form for editing the specified booking
     */
    public function edit($id)
    {
        $booking = DB::table('bookings')
            ->where('id', $id)
            ->first();

        if (!$booking) {
            abort(404, 'Booking tidak ditemukan');
        }

        // Prevent editing completed or cancelled bookings
        if (in_array($booking->status, ['completed', 'cancelled'])) {
            return redirect()
                ->route('bookings.show', $id)
                ->with('error', 'Booking dengan status ' . $booking->status . ' tidak dapat diubah.');
        }

        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified booking in database
     */
    public function update(Request $request, $id)
    {
        $booking = DB::table('bookings')->where('id', $id)->first();

        if (!$booking) {
            abort(404, 'Booking tidak ditemukan');
        }

        // Prevent editing completed or cancelled bookings
        if (in_array($booking->status, ['completed', 'cancelled'])) {
            return redirect()
                ->route('bookings.show', $id)
                ->with('error', 'Booking dengan status ' . $booking->status . ' tidak dapat diubah.');
        }

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'phone' => ['required', 'regex:/^(\+62|0)[0-9]{9,12}$/'],
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'people' => 'required|integer|between:1,50',
            'type' => ['required', Rule::in(['table', 'aula'])],
            'notes' => 'nullable|string|max:500',
            'status' => ['required', Rule::in(['pending', 'confirmed', 'completed', 'cancelled'])],
        ]);

        // Update using DB query builder
        DB::table('bookings')
            ->where('id', $id)
            ->update([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'date' => $validated['date'],
                'time' => $validated['time'],
                'people' => $validated['people'],
                'type' => $validated['type'],
                'notes' => $validated['notes'] ?? null,
                'status' => $validated['status'],
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('bookings.show', $id)
            ->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Remove the specified booking from database
     */
    public function destroy($id)
    {
        $deleted = DB::table('bookings')
            ->where('id', $id)
            ->delete();

        if (!$deleted) {
            abort(404, 'Booking tidak ditemukan');
        }

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    /**
     * Update booking status only
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'completed', 'cancelled'])],
        ]);

        $updated = DB::table('bookings')
            ->where('id', $id)
            ->update([
                'status' => $validated['status'],
                'updated_at' => now(),
            ]);

        if (!$updated) {
            abort(404, 'Booking tidak ditemukan');
        }

        return redirect()
            ->route('bookings.show', $id)
            ->with('success', 'Status booking berhasil diubah!');
    }
}
