<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'jadwal_id'          => [
                'type'           => 'INT',
                'constraint'     => 5
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ]
        ]);

        $this->forge->addForeignKey('user_id', 'pengguna', 'user_id');
        $this->forge->createTable('jadwal_detail');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_detail', true);
    }
}
