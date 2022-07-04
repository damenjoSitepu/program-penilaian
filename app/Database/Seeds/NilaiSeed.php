<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NilaiSeed extends Seeder
{
    public function run()
    {
        $data = [];

        $db = db_connect();
        // Dapatkan data jadwal
        $getJadwal = $db->query("SELECT * FROM jadwal")->getResultArray();

        $count = 1;
        $m = 1;
        foreach ($getJadwal as $jadwal) {
            for ($j = 1; $j <= 2; $j++) {
                if ($j == 1)
                    $perang = 'Baca - Tugas Harian';
                else
                    $perang = 'Menulis - Evaluasi';

                array_push($data, [
                    'nilai_id'          => $count++,
                    'kategori_nilai_id' => $j,
                    'jadwal_id'         => $jadwal['jadwal_id'],
                    'user_id'           => rand(2, 10),
                    'tanggal_penilaian' => '2020-01-' . $m,
                    'mata_pelajaran'    => $perang . ' ' . $m
                ]);
            }
            $m++;
        }

        // Using Query Builder
        $this->db->table('nilai')->insertBatch($data);
    }
}
