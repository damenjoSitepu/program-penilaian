<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class AuthProcess extends BaseController
{
    public $UserModel;

    public function __construct()
    {
        $this->UserModel = new \App\Models\UserModel();
    }

    // Proses Untuk Login
    public function index()
    {
        // Validasi
        if (!$this->validate([
            'username' => [
                'label'  => 'Username',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('messageError', 'Periksa Lagi Form Login Kamu');
            return redirect()->to('/auth')->withInput();
        };

        // Simpan Data
        $data = [
            'username'     => $this->request->getVar('username'),
            'password'  => $this->request->getVar('password')
        ];

        // Periksa Username
        if (!$this->UserModel->getSpesificUser('username', $data['username'])) {
            session()->setFlashdata('message', 'Username Tidak Ditemukan');
            return redirect()->to('/auth');
        } else {
            // Periksa Password
            $getUserdata = $this->UserModel->getSpesificUser('username', $data['username']);

            if ($getUserdata->password != $data['password']) {
                session()->setFlashdata('message', 'Password Akun Kamu Salah');
                return redirect()->to('/auth');
            } else {
                // Simpan Data Session
                $sessionData = [
                    'user_id'       => $getUserdata->user_id,
                    'nama'          => $getUserdata->nama,
                    'kelas'         => $getUserdata->kelas
                ];
                session()->set('login', $sessionData);

                if ($getUserdata->kelas == 3) {
                    // Arahkan Ke Halaman Utama
                    session()->setFlashdata('message', "Selamat Datang Kembali Orang Tua: " . $sessionData['nama']);
                } else {
                    // Arahkan Ke Halaman Utama
                    session()->setFlashdata('message', "Selamat Datang Kembali " . $sessionData['nama']);
                }

                return redirect()->to('/');
            }
        }
    }

    // Proses Untuk Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
}
