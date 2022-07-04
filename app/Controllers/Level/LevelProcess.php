<?php

namespace App\Controllers\Level;

use App\Controllers\BaseController;

class LevelProcess extends BaseController
{
    // Proses Membuat Level
    public function buatLevel()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Validasi
        if (!$this->validate([
            'nama_level' => [
                'label'  => 'Nama Level',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Level/buat")->withInput();
        };

        // Simpan Data
        $data = [
            'nama_level'  => $this->request->getVar('nama_level'),
        ];
    }

    // Proses Menyunting Level
    public function suntingLevel()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Validasi
        if (!$this->validate([
            'level' => [
                'label'  => 'Level',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Level/LevelPages/sunting/{$this->request->getVar('level_id')}")->withInput();
        };

        // Simpan Data
        $level_id = $this->request->getVar('level_id');

        $data = [
            'nama_level'  => $this->request->getVar('nama_level'),
        ];
    }

    // Proses Menghapus Level
    public function hapus($level_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        dd($level_id);
    }
}
