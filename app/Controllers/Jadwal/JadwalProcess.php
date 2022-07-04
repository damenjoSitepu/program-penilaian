<?php

namespace App\Controllers\Jadwal;

use App\Controllers\BaseController;

class JadwalProcess extends BaseController
{
    public $JadwalModel;
    public $NilaiModel;
    public $UserModel;
    public $AnakDidikModel;

    public function __construct()
    {
        $this->JadwalModel = new \App\Models\JadwalModel();
        $this->NilaiModel = new \App\Models\NilaiModel();
        $this->UserModel = new \App\Models\UserModel();
        $this->AnakDidikModel = new \App\Models\AnakDidikModel();
    }

    // Proses Membuat Jadwal
    public function buatJadwal()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Validasi
        if (!$this->validate([
            'jam_mulai' => [
                'label'  => 'Jam Mulai',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'jam_berakhir' => [
                'label'  => 'Jam Berakhir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Jadwal/buat")->withInput();
        };

        // Simpan Data
        $data = [
            'hari_id'  => $this->request->getVar('hari_id'),
            'jam_mulai'  => $this->request->getVar('jam_mulai'),
            'jam_berakhir'  => $this->request->getVar('jam_berakhir'),
            'level_id'  => $this->request->getVar('level_id'),
        ];

        // Cek apakah sudah pernah ada data jadwal berdasarkan level dan hari yang sama
        $checkJadwal = $this->JadwalModel->getSpesificJadwalByLevelAndDay($data['level_id'], $data['hari_id']);
        if (!empty($checkJadwal)) {
            // Flashmessage
            session()->setFlashdata('message', "Data Jadwal Untuk Level {$checkJadwal->level_id}: {$checkJadwal->nama_level} Dan Pada Hari {$checkJadwal->nama_hari} Sudah Ada!");
            // Redirect
            return redirect()->to("/Jadwal/buat");
        }

        // Tambahkan Data Ke Jadwal
        $this->JadwalModel->insertJadwal($data);

        // Flashmessage
        session()->setFlashdata('message', 'Data Jadwal Berhasil Dibuat!');

        // Dapatkan Id Jadwal Terbaru
        $getJadwal = $this->JadwalModel->getSpesificJadwalByLevelAndDay($data['level_id'], $data['hari_id']);

        // Redirect
        return redirect()->to("/Jadwal/JadwalPages/sunting/" . $getJadwal->jadwal_id);
    }

    // Proses Menyunting Jadwal
    public function suntingJadwal()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Validasi
        if (!$this->validate([
            'jam_mulai' => [
                'label'  => 'Jam Mulai',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'jam_berakhir' => [
                'label'  => 'Jam Berakhir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Jadwal/JadwalPages/sunting/{$this->request->getVar('jadwal_id')}")->withInput();
        };

        // Simpan Data
        $jadwal_id = $this->request->getVar('jadwal_id');

        // Validasi Hari
        // Dapatkan Hari ID 
        $getHari = $this->JadwalModel->getSpesificJadwal($jadwal_id);

        if ($getHari->hari_id == $this->request->getVar('hari_id'))
            $hari_id = $getHari->hari_id;
        else {
            // Cek apakah sudah pernah ada data jadwal berdasarkan level dan hari yang sama
            $checkJadwal = $this->JadwalModel->getSpesificJadwalByLevelAndDay($this->request->getVar('level_id'), $this->request->getVar('hari_id'));
            if (!empty($checkJadwal)) {
                // Dapatkan nama hari
                $getNamaHari = $this->JadwalModel->getSpesificHari($this->request->getVar('hari_id'));

                // Flashmessage
                session()->setFlashdata('message', "Anda Sedang Mengajukan Perubahan Jadwal Ini Menjadi <span class='text-primary'>Level {$this->request->getVar('level_id')} ( Hari {$getNamaHari->nama_hari} )</span>. Namun, Penyuntingan Yang Baru Terjadi Kami <span class='text-danger'>Batalkan</span> Karena Hari Tersebut Sudah Ada Di Level Yang Anda Pilih.");

                // Redirect
                return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
            }
            $hari_id = $this->request->getVar('hari_id');
        }

        // Validasi Level
        if ($getHari->level_id == $this->request->getVar('level_id'))
            $level_id = $getHari->level_id;
        else {
            // Cek apakah ada jadwal detail ( anak didik ) yang terkandung dalam jadwal ini atau tidak
            $checkJadwalDetail = $this->JadwalModel->getSpesificJadwalWithDetail($jadwal_id);
            if (!empty($checkJadwalDetail)) {
                // Flashmessage
                session()->setFlashdata('message', "Mohon Untuk Mengosongkan <span class='text-danger'>Seluruh Anak Didik</span> Yang Ada Pada Jadwal Ini!");
                // Redirect
                return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
            }

            // Dapatkan Jadwal yang memuat nilai detail
            $checkNilaiDetail = $this->NilaiModel->getNilaiAndNilaiDetailByJadwalId($jadwal_id);
            if (!empty($checkNilaiDetail)) {
                // Flashmessage
                session()->setFlashdata('message', "Mohon Untuk Mengosongkan <span class='text-danger'>Seluruh Anak Didik</span> Yang Ada Pada Salah Satu Atau Beberapa Ruang Penilaian Yang Anda Buat Khusus Jadwal Ini!");
                // Redirect
                return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
            }

            // Cek apakah sudah pernah ada data jadwal berdasarkan level dan hari yang sama
            $checkJadwal = $this->JadwalModel->getSpesificJadwalByLevelAndDay($this->request->getVar('level_id'), $this->request->getVar('hari_id'));
            if (!empty($checkJadwal)) {
                // Flashmessage
                session()->setFlashdata('message', "Perubahan Data Jadwal Menjadi <span class='text-danger'>{$checkJadwal->nama_level} Dan Pada Hari {$checkJadwal->nama_hari} Ditolak</span>. Hal Ini Disebabkan Data Jadwal Pada Level Yang Ingin Anda Ubah Telah Memiliki Hari Yang Sudah Terdaftar Sebelumnya.");
                // Redirect
                return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
            }

            $level_id = $this->request->getVar('level_id');
        }

        // Validasi Perpindahan level dengan hari yang sama

        // Store Data
        $data = [
            'hari_id'  => $hari_id,
            'jam_mulai'  => $this->request->getVar('jam_mulai'),
            'jam_berakhir'  => $this->request->getVar('jam_berakhir'),
            'level_id'  => $level_id,
        ];

        // Update
        $this->JadwalModel->updateJadwal($jadwal_id, $data);

        // Flashmessage
        session()->setFlashdata('message', "Jadwal Ini Berhasil Dirubah!");

        // Redirect
        return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
    }

    // Proses Sunting Jadwal Murid
    public function suntingJadwalMurid()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Jika belum ada anak didik yang pernah dibuat, tolak masuk halaman ini
        if (empty($this->UserModel->getUser())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Anak Didik Sebelum Menggunakan Fitur Ruang Penilaian Ini!');
            return redirect()->to('/AnakDidik');
        }

        // Simpan Data
        $jadwal_id = $this->request->getVar('jadwal_id');

        $data = [
            'user_id'  => $this->request->getVar('user_id'),
        ];

        // Jika Sudah ada anak didik dengan id sama di dalamnya, sistem wajib menolaknya.
        if (!empty($this->JadwalModel->getSpesificJadwalDetailByUserId($data['user_id'], $jadwal_id))) {
            // Flashmessage
            session()->setFlashdata('message', "Anak Didik Bernama: <span class='text-danger'>{$this->JadwalModel->getSpesificJadwalDetailByUserId($data['user_id'],$jadwal_id)->nama_wali}</span> Sudah Ada Di Dalam Jadwal ini.");
            // Redirect
            return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
        }

        // Update
        $this->JadwalModel->insertJadwalMurid($data, $jadwal_id);

        // Flashmessage
        session()->setFlashdata('message', "Data Murid Bernama <span class='text-primary text-decoration-underline'>{$this->AnakDidikModel->getSpesificAnakDidik($data['user_id'])->nama_wali}</span> Berhasil Ditambahkan Ke Jadwal Ini!");
        // Redirect
        return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
    }

    // Proses Menghapus Jadwal
    public function hapus($jadwal_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Periksa apakah sudah ada data nilai yang pernah dimasukkan menggunakan jadwal ini atau belum
        $checkJadwal = $this->NilaiModel->getSpesificNilai($jadwal_id, 'jadwal_id');

        if (!empty($checkJadwal)) {
            // Flashmessage
            session()->setFlashdata('message', "Jadwal Ini Tidak Dapat Dihapus Karena Masih Ada Ruang Penilaian Yang Terdaftar Di Dalamnya.");

            // Redirect
            return redirect()->to("/Jadwal");
        }

        // Update
        $this->JadwalModel->deleteJadwal($jadwal_id);

        // Flashmessage
        session()->setFlashdata('message', "Jadwal Ini Berhasil Dihapus!");

        // Redirect
        return redirect()->to("/Jadwal");
    }

    // Proses Hapus Jadwal yang berisi anak didik tertentu
    public function hapusJadwalMurid($anakdidik_id, $jadwal_id)
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Dapatkan Nilai Id
        $getLoopNilaiId = $this->NilaiModel->getNilaiByJadwalId($jadwal_id);

        // Jika Nilai id ada, maka hapus seluruh data murid yang berafiliasi pada jadwal ini di struktur nilai.
        $count = 0;
        if (!empty($getLoopNilaiId)) {
            for ($i = 0; $i < count($getLoopNilaiId); $i++) {
                // Delete semua nilainya
                $this->NilaiModel->deleteMurid($anakdidik_id, $getLoopNilaiId[$i]['nilai_id']);
                $count++;
            }
        }

        // Delete Murid di jadwal ini
        $this->JadwalModel->deleteJadwalMurid($anakdidik_id, $jadwal_id);

        // Flashmessage
        if ($count > 0)
            session()->setFlashdata('message', "Anak Didik Bernama <span class='text-danger'>{$this->AnakDidikModel->getSpesificAnakDidik($anakdidik_id)->nama_wali}</span> Berhasil Dihapus Dari Jadwal Ini. Kemudian {$count} Penilaian Yang Telah Terjadi Di Jadwal Ini Juga Turut Dihapus.");
        else
            session()->setFlashdata('message', "Anak Didik Bernama <span class='text-danger'>{$this->AnakDidikModel->getSpesificAnakDidik($anakdidik_id)->nama_wali}</span> Berhasil Dihapus Dari Jadwal Ini!");

        // Redirect
        return redirect()->to("/Jadwal/JadwalPages/sunting/{$jadwal_id}");
    }
}
