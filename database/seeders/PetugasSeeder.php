<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_petugas' => 1,
                'nama_petugas' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin123'),
                'id_level' => 1,

            ]
        ];

        foreach ($data as $item) {
            Petugas::create($item);
        }
    }
}
