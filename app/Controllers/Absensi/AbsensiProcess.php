<?php

namespace App\Controllers\Absensi;

use App\Controllers\BaseController;

class AbsensiProcess extends BaseController
{
    public $UserModel;
    public $AbsensiModel;

    public function __construct()
    {
        $this->UserModel = new \App\Models\UserModel();
        $this->AbsensiModel = new \App\Models\AbsensiModel();
    }

    // Proses Membuat Anak Didik
    public function buatAbsensi()
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

        // Validasi
        if (!$this->validate([
            'tanggal_absen' => [
                'label'  => 'Tanggal Absen',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Absensi/buat")->withInput();
        };

        // Simpan Data
        $data = [
            'tanggal_absen'     => $this->request->getVar('tanggal_absen'),
            'status_id'         => $this->request->getVar('status_id'),
            'user_id'           => $this->request->getVar('user_id'),
        ];

        // Jika sudah pernah ada user id yang masuk ke absen ini, maka tidak diperbolehkan
        if (!empty($this->AbsensiModel->getSpesificAbsensi($data['user_id'], $data['tanggal_absen']))) {
            // Flashmessage
            session()->setFlashdata('message', "Anak Didik Bernama {$this->UserModel->getSpesificUserExtra('user_id',$data['user_id'])->nama_wali} Sudah Berada Di Absensi Ini Sebelumnya");

            // Redirect
            return redirect()->to("/Absensi");
        }

        // Insert Data
        $this->AbsensiModel->insertAbsensi($data);

        // Flashmessage
        session()->setFlashdata('message', "Agenda Absensi Berhasil Dibuat, Anak Didik Yang Telah Diabsen Bernama {$this->UserModel->getSpesificUserExtra('user_id',$data['user_id'])->nama_wali}");

        // Redirect
        return redirect()->to("/Absensi");
    }

    // Proses Menghapus Anak Absensi
    public function hapus($tanggalabsen_id)
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

        // Insert Data
        $this->AbsensiModel->deleteAbsensi($tanggalabsen_id);

        // Flashmessage
        session()->setFlashdata('message', "Agenda Absensi Berhasil Dihapus!");

        // Redirect
        return redirect()->to("/Absensi");
    }
}
