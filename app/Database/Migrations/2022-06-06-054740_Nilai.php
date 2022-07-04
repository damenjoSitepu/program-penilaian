<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nilai_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'kategori_nilai_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'jadwal_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'tanggal_penilaian'       => [
                'type'           => 'DATE'
            ],
            'mata_pelajaran'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
        ]);

        $this->forge->addKey('nilai_id', true);
        $this->forge->addForeignKey('jadwal_id', 'jadwal', 'jadwal_id');
        $this->forge->addForeignKey('kategori_nilai_id', 'kategori_nilai', 'kategori_nilai_id');
        $this->forge->addForeignKey('user_id', 'user', 'user_id');
        $this->forge->createTable('nilai');
    }

    public function down()
    {
        $this->forge->dropTable('nilai', true);
    }
}
