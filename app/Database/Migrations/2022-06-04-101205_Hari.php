<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hari extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'hari_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_hari'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addKey('hari_id', true);
        $this->forge->createTable('hari');
    }

    public function down()
    {
        $this->forge->dropTable('hari', true);
    }
}
