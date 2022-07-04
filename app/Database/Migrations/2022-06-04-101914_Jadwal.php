<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'jadwal_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'hari_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'level_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'jam_mulai'       => [
                'type'           => 'TIME'
            ],
            'jam_berakhir'       => [
                'type'           => 'TIME'
            ]
        ]);

        $this->forge->addKey('jadwal_id', true);
        $this->forge->addForeignKey('level_id', 'level', 'level_id');
        $this->forge->addForeignKey('hari_id', 'hari', 'hari_id');
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal', true);
    }
}
