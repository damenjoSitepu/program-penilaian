<?php

namespace App\Controllers\Nilai;

use App\Controllers\BaseController;

class NilaiProcess extends BaseController
{
    public $NilaiModel;
    public $UserModel;
    public $AnakDidikModel;
    public $JadwalModel;

    public function __construct()
    {
        $this->NilaiModel = new \App\Models\NilaiModel();
        $this->UserModel = new \App\Models\UserModel();
        $this->AnakDidikModel = new \App\Models\AnakDidikModel();
        $this->JadwalModel = new \App\Models\JadwalModel();
    }

    // Proses Membuat Nilai
    public function buatNilai()
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

        // Validasi
        if (!$this->validate([
            'tanggal_penilaian' => [
                'label'  => 'Tanggal Penilaian',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
            'mata_pelajaran' => [
                'label'  => 'Mata Pelajaran',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Nilai/buat")->withInput();
        };

        // Simpan Data
        $data = [
            'kategori_nilai_id'     => $this->request->getVar('kategori_nilai_id'),
            'tanggal_penilaian'     => $this->request->getVar('tanggal_penilaian'),
            'jadwal_id'             => $this->request->getVar('jadwal_id'),
            'mata_pelajaran'        => $this->request->getVar('mata_pelajaran'),
            'user_id'               => session()->get('login')['kelas'] == 1 ? $this->request->getVar('user_id') : session()->get('login')['user_id'],
            'level_id'              => $this->request->getVar('level_id')
        ];

        // Jika belum ada anak didik dengan level yang setara dengan pembuatan ruang penilaian ini, maka tolak.
        if (empty($this->AnakDidikModel->getAnakDidikByLevel($data['level_id']))) {
            // Flashmessage
            session()->setFlashdata('message', "Ruang Penilaian Tidak Dapat Dibuat Karena Belum Ada Anak Didik Yang Memiliki Level Setara Dengannya!");

            // Redirect
            return redirect()->to("/Nilai/buat");
        }

        // Jika belum ada anak didik yang berada di dalam jadwal yang sedang dipilih dalam rangka pembuatan ruang penilaian ini, maka sistem berhak menolaknya
        if (empty($this->JadwalModel->getSpesificJadwalWithDetail($data['jadwal_id']))) {
            // Flashmessage
            session()->setFlashdata('message', "Kami Secara Otomatis Mengarahkan Anda Ke Halaman Jadwal Ini. Mohon Untuk Menambahkan Setidaknya 1 Anak Didik Ke Dalam Jadwal Ini Sebelum Membuat Ruang Penilaian Yang Anda Inginkan Sebelumnya.");

            // Redirect
            return redirect()->to("Jadwal/JadwalPages/sunting/{$data['jadwal_id']}");
        }

        // Masukkan ke dalam database
        $this->NilaiModel->insertNilai($data);

        // Simpan Tanggal Untuk Flashdata
        $tanggalBuat = date('l, j-F-Y', strtotime($data['tanggal_penilaian']));
        // Flashmessage
        session()->setFlashdata('message', "Ruang Nilai Untuk Mata Pelajaran <span class='text-danger'>{$data['mata_pelajaran']}</span> Pada <span class='text-danger'>{$tanggalBuat}</span> Berhasil Dibuat!");

        // Dapatkan Id Nilai terakhir yang baru dibuat admin atau pun motivator
        $getNilaiId = $this->NilaiModel->getStrictNilai($data['user_id'], $data['tanggal_penilaian'], $data['mata_pelajaran'], $data['jadwal_id']);

        // Redirect
        return redirect()->to("/Nilai/NilaiPages/kelolaPenilaian/" . $getNilaiId->nilai_id);
    }

    // Proses Simpan Nilai Anak Didik
    public function simpanNilai()
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

        // Nilai Id Data
        $nilai_id = $this->request->getVar('nilai_id');
        // Mendapatkan Data [ User Id : Skor ( 1 - 5 ) ]
        $infoAnak = $this->request->getVar('info');

        // Update Nilai Setiap Anak Didik
        foreach ($infoAnak as $anak) {
            // Explode Antara User Id dan Skor
            $explodeInfoAnak = explode('|', $anak);
            $this->NilaiModel->updateNilaiAnak($nilai_id, $explodeInfoAnak[0], $explodeInfoAnak[1]);
        }

        // Flashmessage
        session()->setFlashdata('message', 'Data Nilai Anak Didik Berhasil Diperbarui!');

        // Redirect
        return redirect()->to("/Nilai/NilaiPages/detail/" . $nilai_id);
    }

    // Proses Menghapus Nilai
    public function hapusNilai($nilai_id)
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

        // Update
        $affectedRows = $this->NilaiModel->deleteNilai($nilai_id);

        // Flashmessage
        session()->setFlashdata('message', "Ruang Nilai Ini Berhasil Dihapus, Bersama Dengan <span class='text-danger'>{$affectedRows} Data Dan Nilai Anak Didik</span> Yang Terkandung Di Dalamnya!");

        // Redirect
        return redirect()->to('/Nilai');
    }

    // Proses Sunting Ruang Nilai
    public function suntingRuangNilai()
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

        // Validasi
        if (!$this->validate([
            'mata_pelajaran' => [
                'label'  => 'Mata Pelajaran',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ],
        ])) {
            session()->setFlashdata('message', 'Ada Bagian Dari Form Yang Lupa Kamu Isi!');
            return redirect()->to("/Nilai/NilaiPages/kelolaPenilaian/{$this->request->getVar('jadwal_id')}")->withInput();
        };

        // Simpan Data
        $nilai_id = $this->request->getVar('nilai_id');

        // Pengecekan Jadwal yang akan dirubah kembali 
        $getOldJadwal = $this->NilaiModel->getSpesificNilai($nilai_id);
        // Cek apakah data jadwal yang dimasukkan adalah yang baru diinput atau tidak
        if ($this->request->getVar('jadwal_id') == $getOldJadwal->jadwal_id) {
            $jadwalId = $getOldJadwal->jadwal_id;
        } else {
            // Cek apakah nilai detail kosong atau tidak ( data anak didik di dalam sana harus kosong )
            if (!empty($this->NilaiModel->getSpesificNilaiDetail($nilai_id))) {
                // Flashmessage
                session()->setFlashdata('message', "Anak Didik Di Ruang Penilaian Ini Harus Dikosongkan!");
                // Redirect
                return redirect()->to('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai_id);
            } else {
                // Jika belum ada anak didik dengan level yang setara dengan pembuatan ruang penilaian ini, maka tolak.
                if (empty($this->AnakDidikModel->getAnakDidikByLevel($this->request->getVar('level_id')))) {
                    // Flashmessage
                    session()->setFlashdata('message', "Perubahan Jadwal Menuju Level <span class='text-danger'>{$this->request->getVar('level_id')}</span> Ditolak. Hal Ini Disebabkan Oleh Tidak Adanya Anak Didik Yang Memiliki Level Yang Setara Dengannya.");

                    // Redirect
                    return redirect()->to('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai_id);
                }

                // Jika belum ada anak didik yang berada di dalam jadwal yang sedang dipilih dalam rangka pembuatan ruang penilaian ini, maka sistem berhak menolaknya
                if (empty($this->JadwalModel->getSpesificJadwalWithDetail($this->request->getVar('jadwal_id')))) {
                    // Flashmessage
                    session()->setFlashdata('message', "Kami Rasa Anda Ingin Mengubah Jadwal Ruang Penilaian <span class='text-danger'>{$this->request->getVar('mata_pelajaran')}</span> Ini Menjadi Jadwal Ruang Penilaian Dengan Level Atau Hari Yang Berbeda, Bukan? Sayangnya, Untuk Mengubah Hal Demikian, Anda Wajib Menambahkan Setidaknya Satu Anak Didik Ke Calon Jadwal Perubahan Yang Anda Inginkan. <br><br> <span class='text-primary'>Namun, Tenang Saja!</span> Kami Secara Otomatis Sudah Mengarahkannya Ke Laman Jadwal Yang Ingin Anda Jadikan Perubahan. Harap Menambahkan Satu Anak Didik Di Bagian Ini Sekarang Juga!");

                    // Redirect
                    return redirect()->to("Jadwal/JadwalPages/sunting/{$this->request->getVar('jadwal_id')}");
                }

                $jadwalId = $this->request->getVar('jadwal_id');
            }
        }

        $data = [
            'kategori_nilai_id'     => $this->request->getVar('kategori_nilai_id'),
            'mata_pelajaran'        => $this->request->getVar('mata_pelajaran'),
            'user_id'               => session()->get('login')['kelas'] == 1 ? $this->request->getVar('user_id') : session()->get('login')['user_id'],
            'jadwal_id'             => $jadwalId
        ];

        // Update
        $this->NilaiModel->updateNilai($data, $nilai_id);

        // Flashmessage
        session()->setFlashdata('message', 'Data Nilai Berhasil Diubah!');
        // Redirect
        return redirect()->to('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai_id);
    }

    // Proses Sunting Ruang Murid
    public function suntingRuangMurid()
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
        $nilai_id = $this->request->getVar('nilai_id');

        $data = [
            'user_id'  => $this->request->getVar('user_id'),
        ];

        // Jika Sudah ada anak didik dengan id sama di dalamnya, sistem wajib menolaknya.
        if (!empty($this->NilaiModel->getSpesificNilaiDetailByUserId($data['user_id'], $nilai_id))) {
            // Flashmessage
            session()->setFlashdata('message', "Anak Didik Bernama: {$this->NilaiModel->getSpesificNilaiDetailByUserId($data['user_id'],$nilai_id)->nama_wali} Sudah Ada Di Dalam Penilaian ini.");
            // Redirect
            return redirect()->to('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai_id);
        }

        // Update
        $this->NilaiModel->insertMurid($data, $nilai_id);

        // Flashmessage
        session()->setFlashdata('message', "Data Murid Bernama {$this->AnakDidikModel->getSpesificAnakDidik($data['user_id'])->nama_wali}  Berhasil Ditambahkan Ke Ruang Nilai!");
        // Redirect
        return redirect()->to('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai_id);
    }

    // Proses Hapus Ruang Murid
    public function hapusRuangMurid($anakdidik_id, $nilai_id)
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

        // Update
        $this->NilaiModel->deleteMurid($anakdidik_id, $nilai_id);

        // Flashmessage
        session()->setFlashdata('message', "Anak Didik Bernama {$this->AnakDidikModel->getSpesificAnakDidik($anakdidik_id)->nama_wali} Berhasil Dihapus Dari Ruang Penilaian Ini!");

        // Redirect
        return redirect()->to('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai_id);
    }
}
