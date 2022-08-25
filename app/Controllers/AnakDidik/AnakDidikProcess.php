<?php

namespace App\Controllers\AnakDidik;

use App\Controllers\BaseController;
// use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;

class AnakDidikProcess extends BaseController
{
    public $AnakDidikModel;
    public $UserModel;

    public function __construct()
    {
        $this->AnakDidikModel = new \App\Models\AnakDidikModel();
        $this->UserModel = new \App\Models\UserModel();
    }

    // Proses Membuat Anak Didik
    public function buatAnakDidik()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
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
            'nama_wali' => [
                'label'  => 'Nama Wali',
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
            return redirect()->to("/AnakDidik/buat")->withInput();
        };

        // Simpan Data
        $data = [
            'nama'  => $this->request->getVar('nama'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'agama'  => $this->request->getVar('agama'),
            'no_telepon'  => $this->request->getVar('no_telepon'),
            'nama_wali'  => $this->request->getVar('nama_wali'),
            'alamat'  => $this->request->getVar('alamat')
        ];

        // Mengolah Nama untuk dijadikan username
        $setUsername = explode(" ", $data['nama_wali']);

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

        // Buat Default Akun Untuk Anak Didik ( Username Wali )
        $dataDefault = [
            'username'  => $getRealUsername,
            'password'  => '123'
        ];

        // Tambahkan Data User
        $this->UserModel->insertUser($data, $dataDefault, 'anak_didik');

        // Tambahkan Data Ke Anak Didik
        $getUserId = $this->UserModel->getSpesificUser('username', $dataDefault['username']);

        $this->AnakDidikModel->insertUser($getUserId->user_id, $data);

        // Flashmessage
        session()->setFlashdata('message', "Data Anak Didik Berhasil Dibuat!");

        // Redirect
        return redirect()->to("/AnakDidik");
    }

    // Proses Menyunting Sertifikat 1
    public function suntingSertifikat1()
    {

        // id
        $anakdidik_id = $this->request->getVar('anakdidik_id');
        // PHOTO SESSION
        $old_photo = $this->request->getVar('old_photo');
        // Catch image file
        $imageFile = $this->request->getFile('photo');
        // dd($imageFile->getName());
        // Cek apakah ada gambar yang diupload

        if ($imageFile->isValid()) {
            // Change default file name to random hash file name. 
            $newFileHash = $imageFile->getRandomName();
            $separateExt = explode('.', $newFileHash);


            // Delete old image
            // if ($old_photo !== 'default.png')
            //     unlink('assets/sertifikat_img/' . $old_photo);
            // Move image to default folder immediately
            // $imageFile->move('assets/sertifikat_img', $newFileHash);

            $cloudinary = new Cloudinary();

            $cloudinary->uploadApi()->upload($imageFile->getTempName(), array("public_id" => $separateExt[0]));
        } else {
            $newFileHash = $old_photo;
        }



        // Simpan data sertifikat
        $dataSertifikat = [
            'photo'  => $newFileHash
        ];

        // Update data knalpot 
        $this->AnakDidikModel->updateSertifikat($anakdidik_id, $dataSertifikat, 1);

        // Flashmessage
        session()->setFlashdata('message', 'Sertifikat Anak Level 1 Berhasil Diperbarui!');
        // Redirect
        return redirect()->to('/AnakDidik/AnakDidikPages/sunting/' . $anakdidik_id);
    }

    // Proses Menyunting Sertifikat 2
    public function suntingSertifikat2()
    {
        // id
        $anakdidik_id = $this->request->getVar('anakdidik_id');
        // PHOTO SESSION
        $old_photo = $this->request->getVar('old_photo');
        // Catch image file
        $imageFile = $this->request->getFile('photo');
        // Cek apakah ada gambar yang diupload
        if ($imageFile->isValid()) {
            // Change default file name to random hash file name. 
            $newFileHash = $imageFile->getRandomName();

            // Delete old image
            if ($old_photo !== 'default.png')
                unlink('assets/sertifikat_img/' . $old_photo);
            // Move image to default folder immediately
            $imageFile->move('assets/sertifikat_img', $newFileHash);
        } else {
            $newFileHash = $old_photo;
        }

        // Simpan data sertifikat
        $dataSertifikat = [
            'photo'  => $newFileHash
        ];

        // Update data knalpot 
        $this->AnakDidikModel->updateSertifikat($anakdidik_id, $dataSertifikat, 2);

        // Flashmessage
        session()->setFlashdata('message', 'Sertifikat Anak Level 2 Berhasil Diperbarui!');
        // Redirect
        return redirect()->to('/AnakDidik/AnakDidikPages/sunting/' . $anakdidik_id);
    }

    // Proses Menyunting Sertifikat 3
    public function suntingSertifikat3()
    {
        // id
        $anakdidik_id = $this->request->getVar('anakdidik_id');
        // PHOTO SESSION
        $old_photo = $this->request->getVar('old_photo');
        // Catch image file
        $imageFile = $this->request->getFile('photo');
        // Cek apakah ada gambar yang diupload
        if ($imageFile->isValid()) {
            // Change default file name to random hash file name. 
            $newFileHash = $imageFile->getRandomName();

            // Delete old image
            if ($old_photo !== 'default.png')
                unlink('assets/sertifikat_img/' . $old_photo);
            // Move image to default folder immediately
            $imageFile->move('assets/sertifikat_img', $newFileHash);
        } else {
            $newFileHash = $old_photo;
        }

        // Simpan data sertifikat
        $dataSertifikat = [
            'photo'  => $newFileHash
        ];

        // Update data knalpot 
        $this->AnakDidikModel->updateSertifikat($anakdidik_id, $dataSertifikat, 3);

        // Flashmessage
        session()->setFlashdata('message', 'Sertifikat Anak Level 3 Berhasil Diperbarui!');
        // Redirect
        return redirect()->to('/AnakDidik/AnakDidikPages/sunting/' . $anakdidik_id);
    }

    // Proses Menyunting Sertifikat 4
    public function suntingSertifikat4()
    {
        // id
        $anakdidik_id = $this->request->getVar('anakdidik_id');
        // PHOTO SESSION
        $old_photo = $this->request->getVar('old_photo');
        // Catch image file
        $imageFile = $this->request->getFile('photo');
        // Cek apakah ada gambar yang diupload
        if ($imageFile->isValid()) {
            // Change default file name to random hash file name. 
            $newFileHash = $imageFile->getRandomName();

            // Delete old image
            if ($old_photo !== 'default.png')
                unlink('assets/sertifikat_img/' . $old_photo);
            // Move image to default folder immediately
            $imageFile->move('assets/sertifikat_img', $newFileHash);
        } else {
            $newFileHash = $old_photo;
        }

        // Simpan data sertifikat
        $dataSertifikat = [
            'photo'  => $newFileHash
        ];

        // Update data knalpot 
        $this->AnakDidikModel->updateSertifikat($anakdidik_id, $dataSertifikat, 4);

        // Flashmessage
        session()->setFlashdata('message', 'Sertifikat Anak Level 4 Berhasil Diperbarui!');
        // Redirect
        return redirect()->to('/AnakDidik/AnakDidikPages/sunting/' . $anakdidik_id);
    }

    // Proses Menyunting Anak Didik
    public function suntingAnakDidik()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
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
            'alamat' => [
                'label'  => 'Alamat',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ],
            'catatan' => [
                'label'  => 'Catatan',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/AnakDidik/AnakDidikPages/sunting/{$this->request->getVar('user_id')}")->withInput();
        };

        // Simpan Data
        $user_id = $this->request->getVar('user_id');

        $data = [
            'nama'  => $this->request->getVar('nama'),
            'tanggal_lahir'  => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin'  => $this->request->getVar('jenis_kelamin'),
            'agama'  => $this->request->getVar('agama'),
            'no_telepon'  => $this->request->getVar('no_telepon'),
            'alamat'  => $this->request->getVar('alamat'),
            'password'  => $this->request->getVar('password'),
            'level_id'  => $this->request->getVar('level_id'),
            'catatan'  => $this->request->getVar('catatan')
        ];

        // Ubah Data Motivator
        $this->AnakDidikModel->updateAnakDidik($user_id, $data);

        // Setting Password
        $finalPassword = $this->request->getVar('password') ? $this->request->getVar('password') : $this->request->getVar('old_password');
        // Ubah Password
        $this->UserModel->changePassword($user_id, $finalPassword);

        // Flashmessage
        session()->setFlashdata('message', 'Perubahan Anak Didik Berhasil Disimpan!');

        // Redirect
        return redirect()->to("/AnakDidik/AnakDidikPages/sunting/" . $user_id);
    }


    // Proses Menghapus Anak Didik
    public function hapus($anakdidik_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Delete
        $this->AnakDidikModel->deleteAnakDidik($anakdidik_id);

        // Flashmessage
        session()->setFlashdata('message', "Anak Didik Ini Berhasil Dihapus!");

        // Redirect
        return redirect()->to("/AnakDidik")->withInput();
    }

    // Sertifikat Downloadble
    public function sertifikat($img)
    {
        return $this->response->download('assets/sertifikat_img/' . $img, null)->setFileName($img);
    }
}
