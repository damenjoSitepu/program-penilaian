<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NilaiDetailSeed extends Seeder
{
    public function run()
    {
        $data = [];

        $db = db_connect();

        // Dapatkan Data Nilai 
        $getNilai = $db->query("SELECT * FROM nilai")->getResultArray();

        foreach ($getNilai as $nilai) {
            // Dapatkan jadwal detail
            $getJadwalDetail = $db->query("SELECT * FROM jadwal_detail WHERE jadwal_detail.jadwal_id='{$nilai['jadwal_id']}'")->getResultArray();

            // foreach ($getJadwalDetail as $jadwalDetail) {
            for ($l = 0; $l <= rand(0, count($getJadwalDetail) - 1); $l++) {
                array_push($data, [
                    'nilai_id'      => $nilai['nilai_id'],
                    'user_id'       => $getJadwalDetail[$l]['user_id'],
                    'skor_id'         => rand(1, 5)
                ]);
            }
            // }
        }

        // Using Query Builder
        $this->db->table('nilai_detail')->insertBatch($data);
    }
}
