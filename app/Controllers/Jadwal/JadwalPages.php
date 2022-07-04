<?php

namespace App\Controllers\Jadwal;

use App\Controllers\BaseController;

class JadwalPages extends BaseController
{
    public $JadwalModel;
    public $LevelModel;
    public $AnakDidikModel;
    public $UserModel;

    public function __construct()
    {
        $this->JadwalModel = new \App\Models\JadwalModel();
        $this->LevelModel = new \App\Models\LevelModel();
        $this->AnakDidikModel = new \App\Models\AnakDidikModel();
        $this->UserModel = new \App\Models\UserModel();
    }

    // Halaman Utama Jadwal
    public function index()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Jika belum ada anak didik yang pernah dibuat, tolak masuk halaman ini
        if (empty($this->UserModel->getUser())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Anak Didik Sebelum Menggunakan Fitur Jadwal Ini!');
            return redirect()->to('/AnakDidik');
        }

        // Search Check
        $search = $this->request->getVar('search');

        if ($search) {
            $getJadwal = $this->JadwalModel->searchJadwal($search);
        } else {
            $getJadwal = $this->JadwalModel->getJadwal();
        }

        // Data Requirement
        $data = [
            'title'                 => 'Data Jadwal',
            'getJadwal'             => arrangeDatabase($getJadwal, 'level_id', ['level_id', 'nama_level'], ['level_id', 'nama_hari', 'jam_mulai', 'jam_berakhir', 'jadwal_id']),
            'getLevel'              => $this->LevelModel->getLevel(),
            'search'                 => $search ? $search : '',
            'countJadwal'           => count($getJadwal),
        ];

        return view('Jadwal/index', $data);
    }

    // Halaman Buat Jadwal
    public function buat()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Jika belum ada anak didik yang pernah dibuat, tolak masuk halaman ini
        if (empty($this->UserModel->getUser())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Anak Didik Sebelum Menggunakan Fitur Jadwal Ini!');
            return redirect()->to('/AnakDidik');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Buat Jadwal',
            'countJadwal'           => count($this->JadwalModel->getJadwal()),
            'getHari'               => $this->JadwalModel->getHari(),
            'getLevel'              => $this->LevelModel->getLevel(),
            'validation'            => \Config\Services::validation()
        ];

        return view('Jadwal/buat', $data);
    }

    // Halaman Sunting Jadwal
    public function sunting($jadwal_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Jika belum ada anak didik yang pernah dibuat, tolak masuk halaman ini
        if (empty($this->UserModel->getUser())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Anak Didik Sebelum Menggunakan Fitur Jadwal Ini!');
            return redirect()->to('/AnakDidik');
        }

        // Get Level id
        $getLevelId = $this->JadwalModel->getSpesificJadwal($jadwal_id);

        // Data Requirement
        $data = [
            'title'                 => 'Edit Jadwal',
            'getSpesificJadwal'     => $this->JadwalModel->getSpesificJadwal($jadwal_id, 'jadwal_id'),
            'getHari'               => $this->JadwalModel->getHari(),
            'getLevel'              => $this->LevelModel->getLevel(),
            'getAnakDidik'          => $this->AnakDidikModel->getAnakDidikByLevel($getLevelId->level_id),
            'getJadwalDetail'       => $this->JadwalModel->getJadwalDetail($jadwal_id),
            'countJadwal'           => count($this->JadwalModel->getJadwal()),
            'validation'            => \Config\Services::validation()
        ];

        return view('Jadwal/sunting', $data);
    }
}
