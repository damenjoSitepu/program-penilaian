<?php

namespace App\Controllers\Nilai;

use App\Controllers\BaseController;

class NilaiPages extends BaseController
{
    public $NilaiModel;
    public $LevelModel;
    public $MotivatorModel;
    public $JadwalModel;
    public $AnakDidikModel;
    public $SkorModel;
    public $UserModel;

    public function __construct()
    {
        $this->NilaiModel = new \App\Models\NilaiModel();
        $this->LevelModel = new \App\Models\LevelModel();
        $this->MotivatorModel = new \App\Models\MotivatorModel();
        $this->JadwalModel = new \App\Models\JadwalModel();
        $this->AnakDidikModel = new \App\Models\AnakDidikModel();
        $this->SkorModel = new \App\Models\SkorModel();
        $this->UserModel = new \App\Models\UserModel();
    }

    // Halaman Utama Nilai
    public function index()
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

        // Jika belum ada jadwal yang pernah dibuat, tolak masuk halaman nilai ini
        if (empty($this->JadwalModel->getJadwal())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Jadwal Yang Telah Dibuat Sebelum Menggunakan Fitur Nilai Ini!');
            return redirect()->to('/Jadwal');
        }

        // Jika admin dan belum ada motivator yang dibuat, maka tolak masuk halaman nilai ini
        if (session()->get('login')['kelas'] == 1) {
            if (empty($this->MotivatorModel->getMotivator())) {
                session()->setFlashdata('message', 'Kami Tidak Mendeteksi Adanya Data Motivator Yang Tersedia. Anda Sebagai Admin Harus Membuatnya Terlebih Dahulu!');
                return redirect()->to('/Motivator');
            }
        }

        // Search Check
        $search = $this->request->getVar('search');

        // Cek sajian data untuk admin atau motivator
        if (session()->get('login')['kelas'] == 1) {
            if ($search) {
                $getNilai = $this->NilaiModel->searchNilai($search);
            } else {
                $getNilai = $this->NilaiModel->getNilai();
            }
        } else {
            if ($search) {
                $getNilai = $this->NilaiModel->searchNilai($search, 'motivator', session()->get('login')['user_id']);
            } else {
                $getNilai = $this->NilaiModel->getNilai('motivator', session()->get('login')['user_id']);
            }
        }

        // Data Requirement
        $data = [
            'title'                 => 'Data Nilai',
            'getNilai'              => arrangeDatabase($getNilai, 'nilai_id', ['nilai_id', 'tanggal_penilaian', 'mata_pelajaran', 'level_id', 'nama_level', 'nama_hari', 'nama_kategori_nilai', 'nama_motivator', 'nilai_id_real'], ['user_id', 'nama']),
            'countNilai'            => count(arrangeDatabase($getNilai, 'nilai_id', ['nilai_id', 'tanggal_penilaian', 'mata_pelajaran', 'level_id', 'nama_kategori_nilai', 'nama_motivator'], ['user_id', 'nama']))
        ];

        return view('Nilai/index', $data);
    }

    // Halaman Detail Nilai
    public function detail($nilai_id)
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

        // Jika belum ada jadwal yang pernah dibuat, tolak masuk halaman nilai ini
        if (empty($this->JadwalModel->getJadwal())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Jadwal Yang Telah Dibuat Sebelum Menggunakan Fitur Nilai Ini!');
            return redirect()->to('/Jadwal');
        }

        // Raw Data
        $rawRank = $this->NilaiModel->getNilaiRank($nilai_id);

        // Data Requirement
        $data = [
            'title'                 => 'Data Detail Nilai',
            'getNilaiId'            => $nilai_id,
            'getRank'             => arrangeDatabase($rawRank, 'nilai_id', ['nilai_id', 'tanggal_penilaian', 'nama_kategori_nilai'], ['skor_id', 'nama_wali'])
        ];

        return view('Nilai/detail', $data);
    }

    // Halaman Buat Nilai
    public function buat()
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

        // Jika belum ada jadwal yang pernah dibuat, tolak masuk halaman nilai ini
        if (empty($this->JadwalModel->getJadwal())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Jadwal Yang Telah Dibuat Sebelum Menggunakan Fitur Nilai Ini!');
            return redirect()->to('/Jadwal');
        }

        // Raw Nilai
        $getNilai = $this->NilaiModel->getNilai();

        // Data Requirement
        $data = [
            'title'                 => 'Buat Nilai',
            'countNilai'            => count(arrangeDatabase($getNilai, 'nilai_id', ['nilai_id', 'tanggal_penilaian', 'mata_pelajaran', 'level_id', 'nama_kategori_nilai', 'nama_motivator'], ['user_id', 'nama'])),
            'getKategori'           => $this->NilaiModel->getKategori(),
            'getLevel'              => $this->LevelModel->getLevelWithSchedule(),
            'getMotivator'          => $this->MotivatorModel->getMotivator(),
            'validation'            => \Config\Services::validation()
        ];

        return view('Nilai/buat', $data);
    }

    // Halaman Kelola Penilaian Nilai
    public function kelolaPenilaian($nilai_id)
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

        // Jika belum ada jadwal yang pernah dibuat, tolak masuk halaman nilai ini
        if (empty($this->JadwalModel->getJadwal())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Jadwal Yang Telah Dibuat Sebelum Menggunakan Fitur Nilai Ini!');
            return redirect()->to('/Jadwal');
        }

        // Get Raw Nilai
        $getNilai = $this->NilaiModel->getSpesificNilai($nilai_id);

        // Data Requirement
        $data = [
            'title'                 => 'Kelola Penilaian',
            'getKategori'           => $this->NilaiModel->getKategori(),
            'getNilai'              => $getNilai,
            'getNilaiDetail'        => $this->NilaiModel->getSpesificNilaiDetail($nilai_id),
            'getMotivator'          => $this->MotivatorModel->getMotivator(),
            'getAnakDidik'          => $this->AnakDidikModel->getAnakDidikByJadwal($getNilai->jadwal_id),
            'getLevel'              => $this->LevelModel->getLevelWithSchedule(),
            'getJadwal'             => $this->JadwalModel->getSpesificJadwalBy($getNilai->level_id, 'level_id'),
            'validation'            => \Config\Services::validation()
        ];

        return view('Nilai/kelola-penilaian', $data);
    }

    // Halaman Sunting Nilai Anak Didik
    public function suntingNilai($nilai_id)
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

        // Jika belum ada jadwal yang pernah dibuat, tolak masuk halaman nilai ini
        if (empty($this->JadwalModel->getJadwal())) {
            session()->setFlashdata('message', 'Setidaknya Harus Ada Satu Jadwal Yang Telah Dibuat Sebelum Menggunakan Fitur Nilai Ini!');
            return redirect()->to('/Jadwal');
        }

        // Jika Belum Ada Anak Didik, perintahkan sistem untuk kembali menuju halaman 'kelola penilaian'
        if (empty($this->NilaiModel->getSpesificNilaiDetail($nilai_id))) {
            // Flashmessage
            session()->setFlashdata('message', "Ruang Penilaian Ini Belum Memiliki Anak Didik Yang Terkandung Di Dalamnya.");
            // Redirect
            return redirect()->to('/Nilai/NilaiPages/kelolaPenilaian/' . $nilai_id);
        }

        // Data Requirement
        $data = [
            'title'                 => 'Sunting Nilai',
            'getNilaiId'            => $nilai_id,
            'getNilaiDetail'        => $this->NilaiModel->getSpesificNilaiDetail($nilai_id),
            'getSkor'               => $this->SkorModel->getSkor()
        ];

        return view('Nilai/sunting-nilai', $data);
    }
}
