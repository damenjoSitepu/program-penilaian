<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password'       => [
                'type'       => 'TEXT'
            ],
            'kelas'       => [
                'type'       => 'INT'
            ],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('pengguna');
    }

    public function down()
    {
        $this->forge->dropTable('pengguna', true);
    }
}
