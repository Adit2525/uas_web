<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LapanganSeeder extends Seeder
{
    public function run()
    {
        DB::table('adit_lapangan')->insert([
            [
                'nama' => 'Lapangan Futsal Adit',
                'jenis' => 'Futsal',
                'harga' => 150000,
                'lokasi' => 'Jl. Sport Center No.1',
                'gambar' => 'https://via.placeholder.com/300x200?text=Futsal+Adit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Lapangan Basket Adit',
                'jenis' => 'Basket',
                'harga' => 200000,
                'lokasi' => 'Jl. Olahraga No.2',
                'gambar' => 'https://via.placeholder.com/300x200?text=Basket+Adit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambah data lain sesuai kebutuhan
        ]);
    }
}
