<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllSeed extends Seeder
{
    public function run()
    {
        // $this->call('LevelSeed');
        // $this->call('PenggunaSeed');
        // $seeder->call('agungsugiarto\boilerplate\Database\Seeds\BoilerplateSeeder');
        $this->call('\Database\Seeds\PenggunaSeeder');
        // $this->call('MotivatorSeed');
        // $this->call('AnakDidikSeed');
        // $this->call('HariSeed');
        // $this->call('SkorSeed');
        // $this->call('StatusSeed');
        // $this->call('KategoriNilaiSeed');

        // $this->call('AbsensiSeed');
        // $this->call('JadwalSeed');
        // $this->call('JadwalDetailSeed');
        // $this->call('NilaiSeed');
        // $this->call('NilaiDetailSeed');
    }
}
