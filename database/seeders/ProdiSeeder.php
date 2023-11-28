<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::insert([
            'nama' => 'Teknologi Informasi'
        ]);
        Prodi::insert([
            'nama' => 'Sistem Informasi'
        ]);
        Prodi::insert([
            'nama' => 'Pendidikan Teknologi Informasi'
        ]);
        Prodi::insert([
            'nama' => 'Teknik Informatika'
        ]);
        Prodi::insert([
            'nama' => 'Teknik Komputer'
        ]);
    }
}
