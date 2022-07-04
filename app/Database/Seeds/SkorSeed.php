<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SkorSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'skor_id'   => 1,
                'nama_skor' => 'Belum Kompeten'
            ],
            [
                'skor_id'   => 2,
                'nama_skor' => 'Awal Pengenalan'
            ],
            [
                'skor_id'   => 3,
                'nama_skor' => 'Proses Pembiasaan'
            ],
            [
                'skor_id'   => 4,
                'nama_skor' => 'Pemahaman Materi'
            ],
            [
                'skor_id'   => 5,
                'nama_skor' => 'Terampil'
            ]
        ];

        // Using Query Builder
        $this->db->table('skor')->insertBatch($data);
    }
}
