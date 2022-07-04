<?php

namespace App\Controllers\AnakDidik;

use App\Controllers\BaseController;

class AnakDidikPages extends BaseController
{
    public $AnakDidikModel;
    public $LevelModel;

    public function __construct()
    {
        $this->AnakDidikModel = new \App\Models\AnakDidikModel();
        $this->LevelModel = new \App\Models\LevelModel();
    }

    // Halaman Utama Anak Didik
    public function index()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Search Check
        $search = $this->request->getVar('search');

        if ($search) {
            $getAnakDidik = $this->AnakDidikModel->searchAnakDidik($search);
        } else {
            $getAnakDidik = $this->AnakDidikModel->getAnakDidik();
        }

        // Data Requirement
        $data = [
            'title'                 => 'Data Anak Didik',
            'getAnakDidik'          => $getAnakDidik,
            'countAnakDidik'        => count($getAnakDidik),
        ];



        return view('AnakDidik/index', $data);
    }

    // Halaman Buat Anak Didik
    public function buat()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Buat Anak Didik',
            'countAnakDidik'        => count($this->AnakDidikModel->getAnakDidik()),
            'validation'            => \Config\Services::validation()
        ];

        return view('AnakDidik/buat', $data);
    }

    // Halaman Sunting Anak Didik
    public function sunting($anakdidik_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Edit Anak Didik',
            'getSpesificAnakDidik'  => $this->AnakDidikModel->getSpesificAnakDidik($anakdidik_id),
            'getLevel'              => $this->LevelModel->getLevel(),
            'countAnakDidik'        => count($this->AnakDidikModel->getAnakDidik()),
            'validation'            => \Config\Services::validation()
        ];

        return view('AnakDidik/sunting', $data);
    }
}
