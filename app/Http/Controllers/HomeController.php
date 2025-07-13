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
        if (!auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Hanya admin yang dapat mengakses dashboard.');
        }
        $lapangan = \App\Models\Lapangan::count();
        $booking = \App\Models\Booking::count();
        $user = \App\Models\User::count();
        $jadwal = \App\Models\Jadwal::count();
        return view('admin.dashboard', compact('lapangan', 'booking', 'user', 'jadwal'));
    }
}
