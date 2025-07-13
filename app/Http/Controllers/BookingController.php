<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Lapangan;

class BookingController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $bookings = Booking::with(['user', 'lapangan'])->get();
        } else {
            $bookings = auth()->user()->booking()->with('lapangan')->get();
        }
        
        return view('booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lapangan = Lapangan::all();
        return view('booking.create', compact('lapangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:adit_lapangan,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required|date_format:H:i'
        ]);

        // Check if booking already exists for this time slot
        $existingBooking = Booking::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'Lapangan sudah dibooking untuk waktu tersebut');
        }

        $booking = new Booking($request->all());
        $booking->user_id = auth()->id();
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'lapangan'])->findOrFail($id);
        
        // Check if user can view this booking
        if (!auth()->user()->isAdmin() && $booking->user_id !== auth()->id()) {
            return redirect()->route('booking.index')->with('error', 'Unauthorized access');
        }
        
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Only admin can edit bookings
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('booking.index')->with('error', 'Unauthorized access');
        }
        
        $lapangan = Lapangan::all();
        return view('booking.edit', compact('booking', 'lapangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Only admin can update bookings
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('booking.index')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $booking->update($request->only('status'));
        return redirect()->route('booking.index')->with('success', 'Status booking berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Check if user can delete this booking
        if (!auth()->user()->isAdmin() && $booking->user_id !== auth()->id()) {
            return redirect()->route('booking.index')->with('error', 'Unauthorized access');
        }
        
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus');
    }
}

