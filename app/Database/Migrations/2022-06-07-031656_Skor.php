<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Skor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'skor_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_skor'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 200
            ]
        ]);

        $this->forge->addKey('skor_id', true);
        $this->forge->createTable('skor');
    }

    public function down()
    {
        $this->forge->dropTable('skor', true);
    }
}
