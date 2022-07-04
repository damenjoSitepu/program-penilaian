<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AnakDidik extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 5
            ],
            'level_id'          => [
                'type'           => 'INT',
                'constraint'     => 5
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
            'nama_wali'       => [
                'type'       => 'VARCHAR',
                'constraint'    => 100
            ],
            'alamat'       => [
                'type'       => 'TEXT'
            ],
            'photo1'       => [
                'type'       => 'TEXT',
                'default'    => 'default.png'
            ],
            'photo2'       => [
                'type'       => 'TEXT',
                'default'    => 'default.png'
            ],
            'photo3'       => [
                'type'       => 'TEXT',
                'default'    => 'default.png'
            ],
            'photo4'       => [
                'type'       => 'TEXT',
                'default'    => 'default.png'
            ],
            'catatan'       => [
                'type'       => 'TEXT',
                'default'    => 'default'
            ],
        ]);
        $this->forge->addForeignKey('user_id', 'user', 'user_id');
        $this->forge->addForeignKey('level_id', 'level', 'level_id');
        $this->forge->createTable('anak_didik');
    }

    public function down()
    {
        $this->forge->dropTable('anak_didik', true);
    }
}
