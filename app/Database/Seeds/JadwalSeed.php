<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalSeed extends Seeder
{
    public function run()
    {
        $data = [];
        $timeStartRandom = ['09:00:00', '10:00:00', '11:00:00', '12:00:00'];
        $timeEndRandom = ['10:00:00', '11:00:00', '12:00:00', '13:00:00'];

        $count = 1;
        for ($i = 1; $i <= 4; $i++) {
            for ($j = 1; $j <= 7; $j++) {
                $timeRandom = rand(0, 3);
                array_push($data, [
                    'jadwal_id'     => $count++,
                    'hari_id'       => $j,
                    'level_id'      => $i,
                    'jam_mulai'     => $timeStartRandom[$timeRandom],
                    'jam_berakhir'  => $timeEndRandom[$timeRandom]
                ]);
            }
        }


        // Using Query Builder
        $this->db->table('jadwal')->insertBatch($data);
    }
}
