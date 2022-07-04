<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'status_id'     => 1,
                'nama_status'   =>  'Hadir'
            ],
            [
                'status_id'     => 2,
                'nama_status'   =>  'Izin'
            ],
            [
                'status_id'     => 3,
                'nama_status'   =>  'Sakit'
            ],
            [
                'status_id'     => 4,
                'nama_status'   =>  'Lain-Lain'
            ]
        ];

        // Using Query Builder
        $this->db->table('status')->insertBatch($data);
    }
}
