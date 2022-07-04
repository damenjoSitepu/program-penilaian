<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Level extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'level_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_level'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addKey('level_id', true);
        $this->forge->createTable('level');
    }

    public function down()
    {
        $this->forge->dropTable('level', true);
    }
}
