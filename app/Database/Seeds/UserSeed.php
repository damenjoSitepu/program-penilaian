<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'   => '1',
                'nama'      => 'Intan',
                'username'  => 'intan',
                'password'  => '123',
                'kelas'     => 1
            ]
        ];

        // Motivator
        // for ($i = 2; $i <= 10; $i++) {
        //     array_push($data, [
        //         'user_id'       => $i,
        //         'nama'          => 'Hodaka' . $i,
        //         'username'  => 'hodaka' . $i . $i,
        //         'password'  => '123',
        //         'kelas'     => 2
        //     ]);
        // }

        // Anak Didik
        // for ($i = 11; $i <= 20; $i++) {

        //     array_push($data, [
        //         'user_id'       => $i,
        //         'nama'          => 'Hina' . $i,
        //         'username'  => 'hina' . $i . $i,
        //         'password'  => '123',
        //         'kelas'     => 3
        //     ]);
        // }

        // Using Query Builder
        $this->db->table('user')->insertBatch($data);
    }
}
