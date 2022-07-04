<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalDetailSeed extends Seeder
{

    public function run()
    {
        $data = [];

        $db = db_connect();

        // jadwal id user id 
        $getJadwal = $db->query("SELECT * FROM jadwal")->getResultArray();

        foreach ($getJadwal as $jadwal) {
            for ($lm = 1; $lm <= 4; $lm++) {
                $getAnakDidik = $db->query("SELECT * FROM jadwal INNER JOIN anak_didik ON jadwal.level_id = anak_didik.level_id WHERE jadwal.level_id={$lm} GROUP BY anak_didik.user_id")->getResultArray();

                foreach ($getAnakDidik as $anakdidik) {
                    array_push($data, [
                        'jadwal_id' => $jadwal['jadwal_id'],
                        'user_id'   => $anakdidik['user_id']
                    ]);
                }
            }
        }

        // Using Query Builder
        $this->db->table('jadwal_detail')->insertBatch($data);
    }
}
