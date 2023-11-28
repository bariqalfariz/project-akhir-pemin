<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MataKuliah::insert([
            'nama' => 'Pemograman Dasar'
        ]);
        MataKuliah::insert([
            'nama' => 'Pemograman Lanjut'
        ]);
        MataKuliah::insert([
            'nama' => 'Pemograman Algoritma dan Struktur Data'
        ]);
        MataKuliah::insert([
            'nama' => 'Sistem Basis Data'
        ]);
        MataKuliah::insert([
            'nama' => 'Jaringan Komputer Dasar'
        ]);
    }
}
