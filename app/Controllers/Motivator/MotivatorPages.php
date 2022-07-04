<?php

namespace App\Controllers\Motivator;

use App\Controllers\BaseController;

class MotivatorPages extends BaseController
{
    public $MotivatorModel;

    public function __construct()
    {
        $this->MotivatorModel = new \App\Models\MotivatorModel();
    }

    // Halaman Utama Motivator
    public function index()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        if (session()->get('login')['kelas'] == 2 || session()->get('login')['kelas'] == 3) {
            session()->setFlashdata('message', 'Akses Anda Terbatas!');
            return redirect()->to('/');
        }

        // Search Check
        $search = $this->request->getVar('search');

        if ($search) {
            $getMotivator = $this->MotivatorModel->searchMotivator($search);
        } else {
            $getMotivator = $this->MotivatorModel->getMotivator();
        }

        // Data Requirement
        $data = [
            'title'                 => 'Data Motivator',
            'getMotivator'          => $getMotivator,
            'countMotivator'        => count($getMotivator),
        ];

        return view('Motivator/index', $data);
    }

    // Halaman Buat Motivator
    public function buat()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        if (session()->get('login')['kelas'] == 2 || session()->get('login')['kelas'] == 3) {
            session()->setFlashdata('message', 'Akses Anda Terbatas!');
            return redirect()->to('/');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Buat Motivator',
            'countMotivator'        => count($this->MotivatorModel->getMotivator()),
            'validation'            => \Config\Services::validation()
        ];

        return view('Motivator/buat', $data);
    }

    // Halaman Sunting Motivator
    public function sunting($motivator_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        if (session()->get('login')['kelas'] == 2 || session()->get('login')['kelas'] == 3) {
            session()->setFlashdata('message', 'Akses Anda Terbatas!');
            return redirect()->to('/');
        }

        // Data Requirement
        $data = [
            'title'                 => 'Edit Motivator',
            'getSpesificMotivator'  => $this->MotivatorModel->getSpesificMotivator($motivator_id),
            'countMotivator'        => count($this->MotivatorModel->getMotivator()),
            'validation'            => \Config\Services::validation()
        ];

        return view('Motivator/sunting', $data);
    }
}
