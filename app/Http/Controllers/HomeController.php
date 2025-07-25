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
            return redirect('/')->with('error');
        }
        $lapangan = \App\Models\Lapangan::count();
        $booking = \App\Models\Booking::count();
        $user = \App\Models\User::count();
        $jadwal = \App\Models\Jadwal::count();
        $jenisStats = \App\Models\Lapangan::select('jenis')
            ->groupBy('jenis')
            ->selectRaw('jenis, COUNT(*) as jumlah')
            ->get();
        return view('admin.dashboard', compact('lapangan', 'booking', 'user', 'jadwal', 'jenisStats'));
    }
}
