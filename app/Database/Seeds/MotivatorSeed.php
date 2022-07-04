<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MotivatorSeed extends Seeder
{
    public function run()
    {
        $data = [];

        // Motivator
        for ($i = 2; $i <= 10; $i++) {
            array_push($data, [
                'user_id'           => $i,
                'id'                => rand(1000, 2000),
                'tanggal_lahir'     => '2000-08-21',
                'jenis_kelamin'     => rand(0, 1),
                'agama'             => 'Islam',
                'no_telepon'        => '0822983928' . $i,
                'email'             => 'ayahandahodaka' . $i . '@gmail.com',
                'alamat'            => 'Jl. Pangandaran' . $i
            ]);
        }

        // Using Query Builder
        $this->db->table('motivator')->insertBatch($data);
    }
}
