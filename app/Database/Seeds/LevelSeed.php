<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'level_id'       => '1',
                'nama_level'    => 'Level 1'
            ],
            [
                'level_id'       => '2',
                'nama_level'    => 'Level 2'
            ],
            [
                'level_id'       => '3',
                'nama_level'    => 'Level 3'
            ],
            [
                'level_id'       => '4',
                'nama_level'    => 'Level 4'
            ]
        ];

        // Using Query Builder
        $this->db->table('level')->insertBatch($data);
    }
}
