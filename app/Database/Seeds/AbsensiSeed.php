<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AbsensiSeed extends Seeder
{
    public function run()
    {
        $data = [];

        $count = 1;
        for ($i = 11; $i <= 20; $i++) {
            for ($j = 1; $j <= 15; $j++) {
                array_push($data, [
                    'absen_id'          => $count++,
                    'user_id'           => $i,
                    'status_id'         => rand(1, 4),
                    'tanggal_absen'     => '2020-01-' . $j
                ]);
            }
        }

        // Using Query Builder
        $this->db->table('absensi')->insertBatch($data);
    }
}
