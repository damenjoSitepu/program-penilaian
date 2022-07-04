<?php

namespace App\Controllers\Motivator;

use App\Controllers\BaseController;

class MotivatorProcess extends BaseController
{
    public $MotivatorModel;
    public $UserModel;
    public $AnakDidikModel;

    public function __construct()
    {
        $this->MotivatorModel = new \App\Models\MotivatorModel();
        $this->UserModel = new \App\Models\UserModel();
        $this->AnakDidikModel = new \App\Models\AnakDidikModel();
    }

    // Proses Membuat Motivator
    public function buatMotivator()
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

        // Validasi
        if (!$this->validate([
            'nama' => [
                'label'  => 'Nama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'id' => [
                'label'  => 'Id',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'tanggal_lahir' => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'agama' => [
                'label'  => 'Agama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'no_telepon' => [
                'label'  => 'No. Telepon',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'alamat' => [
                'label'  => 'Alamat',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Motivator/buat")->withInput();
        };

        // Simpan Data
        $data = [
            'nama'  => $this->request->getVar('nama'),
            'id'  => $this->request->getVar('id'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'agama'  => $this->request->getVar('agama'),
            'no_telepon'  => $this->request->getVar('no_telepon'),
            'email'  => $this->request->getVar('email'),
            'alamat'  => $this->request->getVar('alamat')
        ];

        // Mengolah Nama untuk dijadikan username
        $setUsername = explode(" ", $data['nama']);

        // Ambil Data nama berdasarkan nama di database
        $getUsername = $this->UserModel->getSpesificUserFriendly('nama', $setUsername[0]);
        // Ambil semua nama depannya ( ini adalah username ) dan jadikan array.
        $rawUsername = [];
        foreach ($getUsername as $username) {
            $explodeUsername = explode(" ", $username['nama']);
            array_push($rawUsername, strtolower($explodeUsername[0]));
        }
        // Periksa ada berapa banyak username yang namanya sama dengan calon username motivator baru ini
        $count = 0;
        for ($check = 0; $check < count($rawUsername); $check++) {
            if (strtolower($setUsername[0]) == $rawUsername[$check])
                $count += 1;
        }

        // Gabung String
        $getRealUsername = $count != 0 ? strtolower($setUsername[0]) . ++$count : strtolower($setUsername[0]) . '1';

        // Buat Default Akun Untuk Motivator
        $dataDefault = [
            'username'  => $getRealUsername,
            'password'  => '123'
        ];

        // Tambahkan Data User
        $this->UserModel->insertUser($data, $dataDefault, 'motivator');

        // Tambahkan Data Ke Motivator
        $getUserId = $this->UserModel->getSpesificUser('username', $dataDefault['username']);
        $this->MotivatorModel->insertUser($getUserId->user_id, $data);

        // Flashmessage
        session()->setFlashdata('message', "Data Motivator Bernama {$getUserId->nama} Berhasil Dibuat!");

        // Redirect
        return redirect()->to("/Motivator");
    }

    // Proses Menyunting Motivator
    public function suntingMotivator()
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

        // Validasi
        if (!$this->validate([
            'id' => [
                'label'  => 'Id',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'tanggal_lahir' => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'jenis_kelamin' => [
                'label'  => 'Jenis Kelamin',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'agama' => [
                'label'  => 'Agama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'no_telepon' => [
                'label'  => 'No. Telepon',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'alamat' => [
                'label'  => 'Alamat',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Motivator/MotivatorPages/sunting/{$this->request->getVar('user_id')}")->withInput();
        };

        // Simpan Data
        $user_id = $this->request->getVar('user_id');

        $data = [
            'id'                => $this->request->getVar('id'),
            'tanggal_lahir'     => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin'     => $this->request->getVar('jenis_kelamin'),
            'agama'             => $this->request->getVar('agama'),
            'no_telepon'        => $this->request->getVar('no_telepon'),
            'email'             => $this->request->getVar('email'),
            'alamat'            => $this->request->getVar('alamat')
        ];

        // Ubah Data Motivator
        $this->MotivatorModel->updateMotivator($user_id, $data);

        // Setting Password
        $finalPassword = $this->request->getVar('password') ? $this->request->getVar('password') : $this->request->getVar('old_password');
        // Ubah Password
        $this->UserModel->changePassword($user_id, $finalPassword);

        // Flashmessage
        session()->setFlashdata('message', 'Perubahan Motivator Berhasil Disimpan!');

        // Redirect
        return redirect()->to("/Motivator/MotivatorPages/sunting/" . $user_id);
    }


    // Proses Menghapus Motivator
    public function hapus($motivator_id)
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

        // Delete
        $this->MotivatorModel->deleteMotivator($motivator_id);

        // Flashmessage
        session()->setFlashdata('message', "Motivator Ini Berhasil Dihapus. Jika Ada Ruang Penilaian Yang Pernah Dibuat Oleh Motivator Ini, Maka Datanya Akan Ikut Dihapus!");

        // Redirect
        return redirect()->to("/Motivator")->withInput();
    }
}
