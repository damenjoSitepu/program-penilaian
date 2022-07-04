<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnakDidikSeed extends Seeder
{
    public function run()
    {
        $data = [];

        // Anak Didik
        for ($i = 11; $i <= 20; $i++) {
            array_push($data, [
                'user_id'           => $i,
                'level_id'          => rand(1, 4),
                'tanggal_lahir'     => '2000-08-21',
                'jenis_kelamin'     => rand(0, 1),
                'agama'             => 'Islam',
                'no_telepon'        => '0822983928' . $i,
                'nama_wali'         => 'Hina San ' . $i,
                'alamat'            => 'Jl. Pangandaran Anak Didik' . $i,
                'photo1'             => 'default.png',
                'photo2'             => 'default.png',
                'photo3'             => 'default.png',
                'photo4'             => 'default.png'
            ]);
        }

        // Using Query Builder
        $this->db->table('anak_didik')->insertBatch($data);
    }
}
