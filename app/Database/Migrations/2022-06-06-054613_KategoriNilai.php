<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriNilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kategori_nilai_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nama_kategori_nilai'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
            ]
        ]);

        $this->forge->addKey('kategori_nilai_id', true);
        $this->forge->createTable('kategori_nilai');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_nilai', true);
    }
}
