<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;


class LapanganController extends Controller
{    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangan = Lapangan::all();
        return view('admin.lapangan.index', compact('lapangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lapangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['nama', 'jenis', 'harga', 'lokasi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid('lapangan_') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public');
            $data['gambar'] = $path;
        }

        \App\Models\Lapangan::create($data);
        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lapangan = \App\Models\Lapangan::findOrFail($id);
        return view('lapangan.show', compact('lapangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('admin.lapangan.edit', compact('lapangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'lokasi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $lapangan = \App\Models\Lapangan::findOrFail($id);
        $data = $request->only(['nama', 'jenis', 'harga', 'lokasi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = uniqid('lapangan_') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public');
            $data['gambar'] = $path;
        }

        $lapangan->update($data);
        return redirect()->route('admin.lapangan.index')->with('success', 'Data lapangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $lapangan->delete();
        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil dihapus');
    }
}
