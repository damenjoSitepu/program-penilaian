<?php

namespace App\Controllers\Level;

use App\Controllers\BaseController;

class LevelPages extends BaseController
{
    public $LevelModel;

    public function __construct()
    {
        $this->LevelModel = new \App\Models\LevelModel();
    }

    // Halaman Utama Level
    public function index()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Data Level',
            'getLevel'          => $this->LevelModel->getLevel(),
            'countLevel'        => count($this->LevelModel->getLevel()),
        ];

        return view('Level/index', $data);
    }

    // Halaman Buat Level
    public function buat()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Buat Level',
            'countLevel'        => count($this->LevelModel->getLevel()),
            'validation'            => \Config\Services::validation()
        ];

        return view('Level/buat', $data);
    }

    // Halaman Sunting Level
    public function sunting($level_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Edit Level',
            'getSpesificLevel'  => $this->LevelModel->getSpesificLevel($level_id, 'level_id'),
            'countLevel'        => count($this->LevelModel->getLevel()),
            'validation'            => \Config\Services::validation()
        ];

        return view('Level/sunting', $data);
    }
}
