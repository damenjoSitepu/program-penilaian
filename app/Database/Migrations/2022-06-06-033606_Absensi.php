<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Absensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'absen_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'status_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'tanggal_absen'       => [
                'type'           => 'DATE'
            ]
        ]);

        $this->forge->addKey('absen_id', true);
        $this->forge->addForeignKey('user_id', 'user', 'user_id');
        $this->forge->addForeignKey('status_id', 'status', 'status_id');
        $this->forge->createTable('absensi');
    }

    public function down()
    {
        $this->forge->dropTable('absensi', true);
    }
}
