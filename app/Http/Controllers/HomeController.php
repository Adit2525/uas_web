<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Booking;

class HomeController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();
        return view('home', compact('lapangan'));
    }

    public function dashboard()
    {
        if (auth()->user()->isAdmin()) {
            $lapangan = Lapangan::count();
            $booking = Booking::count();
            $pendingBooking = Booking::where('status', 'pending')->count();
            $confirmedBooking = Booking::where('status', 'confirmed')->count();
            
            return view('admin.dashboard', compact('lapangan', 'booking', 'pendingBooking', 'confirmedBooking'));
        } else {
            $myBookings = auth()->user()->booking()->with('lapangan')->get();
            return view('user.dashboard', compact('myBookings'));
        }
    }
}
