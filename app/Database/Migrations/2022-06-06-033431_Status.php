<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Status extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'status_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_status'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ]
        ]);

        $this->forge->addKey('status_id', true);
        $this->forge->createTable('status');
    }

    public function down()
    {
        $this->forge->dropTable('status', true);
    }
}
