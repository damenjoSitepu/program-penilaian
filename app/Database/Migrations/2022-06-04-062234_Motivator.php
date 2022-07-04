<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Motivator extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 5
            ],
            'id'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_lahir'       => [
                'type'       => 'DATE'
            ],
            'jenis_kelamin'       => [
                'type'       => 'INT'
            ],
            'agama'       => [
                'type'       => 'VARCHAR',
                'constraint'    => 100
            ],
            'no_telepon'       => [
                'type'       => 'VARCHAR',
                'constraint'    => 100
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint'    => 100
            ],
            'alamat'       => [
                'type'       => 'TEXT'
            ]
        ]);
        $this->forge->addForeignKey('user_id', 'user', 'user_id');
        $this->forge->createTable('motivator');
    }

    public function down()
    {
        $this->forge->dropTable('motivator', true);
    }
}
