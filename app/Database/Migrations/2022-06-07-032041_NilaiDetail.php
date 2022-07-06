<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nilai_id'          => [
                'type'           => 'INT',
                'constraint'     => 5
            ],
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'skor_id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ]
        ]);

        $this->forge->addForeignKey('nilai_id', 'nilai', 'nilai_id');
        $this->forge->addForeignKey('user_id', 'pengguna', 'user_id');
        $this->forge->addForeignKey('skor_id', 'skor', 'skor_id');
        $this->forge->createTable('nilai_detail');
    }

    public function down()
    {
        $this->forge->dropTable('nilai_detail', true);
    }
}
