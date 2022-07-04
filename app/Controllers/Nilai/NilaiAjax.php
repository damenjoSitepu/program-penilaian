<?php

namespace App\Controllers\Nilai;

use App\Controllers\BaseController;

class NilaiAjax extends BaseController
{
    public $JadwalModel;

    public function __construct()
    {
        $this->JadwalModel = new \App\Models\JadwalModel();
    }

    // Mendapatkan Data Jadwal
    public function getJadwal()
    {
        // Store Value Ajax
        $getKategori = $this->JadwalModel->getSpesificJadwalBy($this->request->getVar('level_id'), 'level_id');
        return json_encode($getKategori);
    }
}
