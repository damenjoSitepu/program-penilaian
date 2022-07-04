<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HariSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'hari_id'       => '1',
                'nama_hari'    => 'Senin'
            ],
            [
                'hari_id'       => '2',
                'nama_hari'    => 'Selasa'
            ],
            [
                'hari_id'       => '3',
                'nama_hari'    => 'Rabu'
            ],
            [
                'hari_id'       => '4',
                'nama_hari'    => 'Kamis'
            ],
            [
                'hari_id'       => '5',
                'nama_hari'    => 'Jumat'
            ],
            [
                'hari_id'       => '6',
                'nama_hari'    => 'Sabtu'
            ],
            [
                'hari_id'       => '7',
                'nama_hari'    => 'Minggu'
            ],
        ];

        // Using Query Builder
        $this->db->table('hari')->insertBatch($data);
    }
}
