<?php

namespace App\Controllers\Absensi;

use App\Controllers\BaseController;

class AbsensiPages extends BaseController
{
    public $AbsensiModel;
    public $UserModel;

    public function __construct()
    {
        $this->AbsensiModel = new \App\Models\AbsensiModel();
        $this->UserModel = new \App\Models\UserModel();
    }

    // Halaman Utama Absensi
    public function index()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Jika belum ada anak didik yang pernah dibuat, tolak masuk halaman ini
        if (empty($this->UserModel->getUser())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Anak Didik Sebelum Menggunakan Fitur Absensi Ini!');
            return redirect()->to('/AnakDidik');
        }

        // Search Check
        $search = $this->request->getVar('search');

        if ($search) {
            $getAbsensi = $this->AbsensiModel->searchAbsensi($search);
        } else {
            $getAbsensi = $this->AbsensiModel->getAbsensi();
        }

        // Data Requirement
        $data = [
            'title'                     => 'Data Absensi',
            'getAbsensi'                => arrangeDatabase($getAbsensi, 'tanggal_absen', ['tanggal_absen'], ['nama_wali', 'status_id']),
            'countAbsensi'              => count(arrangeDatabase($getAbsensi, 'tanggal_absen', ['tanggal_absen'], ['nama_wali'])),
            'tanggal'                   => $search ? $search : ''
        ];

        return view('Absensi/index', $data);
    }

    // Halaman Buat Absen
    public function buat()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Jika belum ada anak didik yang pernah dibuat, tolak masuk halaman ini
        if (empty($this->UserModel->getUser())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Anak Didik Sebelum Menggunakan Fitur Absensi Ini!');
            return redirect()->to('/AnakDidik');
        }

        // Get Absensi Raw Data
        $getAbsensi = $this->AbsensiModel->getAbsensi();

        // Data Requirement
        $data = [
            'title'                     => 'Buat Absensi',
            'countAbsensi'              => count(arrangeDatabase($getAbsensi, 'tanggal_absen', ['tanggal_absen'], ['nama'])),
            'getUser'                   => $this->UserModel->getUser(),
            'getStatus'                 => $this->AbsensiModel->getStatus(),
            'validation'                => \Config\Services::validation()
        ];

        return view('Absensi/buat', $data);
    }
}
