<?php

namespace Database\Seeders;

use App\Models\Tiket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tiket::truncate();
        for ($i = 1; $i <=5; $i++) {//make 5 tickets
            DB::table('tikets')->insert([
                'id_tiket' => 'TIK00'.$i,
                'id_penjual' => 'PJ001',
                'nama' => 'Tiket Seminar '.$i,
                'harga' => 10000,
                'quantity' => 1,
                'kota' => 'Surabaya',
                'alamat_lokasi' => 'Jl. Merdeka '.$i,
                'gambar' => json_encode(['seminar1.jpg']), //convert array to JSOn string
                'jumlah_view' => 0,
                'status' => 1,
                'deskripsi' => 'ini adalah deskripsi tiket ke '.$i,
                'kategori' => 'seminar',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
