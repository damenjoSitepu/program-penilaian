<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriNilaiSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kategori_nilai_id'     => 1,
                'nama_kategori_nilai'   => 'Tugas Harian'
            ],
            [
                'kategori_nilai_id'     => 2,
                'nama_kategori_nilai'   => 'Evaluasi'
            ]
        ];

        // Using Query Builder
        $this->db->table('kategori_nilai')->insertBatch($data);
    }
}
