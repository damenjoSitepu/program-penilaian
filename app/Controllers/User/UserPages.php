<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;

class UserPages extends BaseController
{
    public $UserModel;
    public $AbsensiModel;
    public $NilaiModel;
    public $JadwalModel;

    public function __construct()
    {
        $this->UserModel = new \App\Models\UserModel();
        $this->AbsensiModel = new \App\Models\AbsensiModel();
        $this->NilaiModel = new \App\Models\NilaiModel();
        $this->JadwalModel = new \App\Models\JadwalModel();
    }

    // Halaman Utama Admin | Guru | Wali
    public function index()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Data Requirement
        $data = [
            'title'         => session()->get('login')['kelas'] == 1 || session()->get('login')['kelas'] == 2 ? 'Beranda Admin' : 'Beranda Orang Tua',
            'getUser'       => $this->UserModel->getSpesificUserExtra('user_id', session()->get('login')['user_id'])
        ];

        return view('Home/index', $data);
    }

    // Halaman Wali data anak anda
    public function wali()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Data Requirement
        $data = [
            'title'         => 'Data Anak Didik',
            'getUser'       => $this->UserModel->getSpesificUserExtra('user_id', session()->get('login')['user_id'])
        ];

        return view('Wali/index', $data);
    }

    // Halaman Wali absensi anak anda
    public function absensi()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Search Check
        $search = $this->request->getVar('search');

        if ($search) {
            $getAbsensi = $this->AbsensiModel->searchAbsensiSpesificByUser(session()->get('login')['user_id'], $search);
        } else {
            $getAbsensi = $this->AbsensiModel->getSpesificAbsensiByUser(session()->get('login')['user_id']);
        }

        // Data Requirement
        $data = [
            'title'         => 'Absensi Anak Didik',
            'getUser'       => $this->UserModel->getSpesificUserExtra('user_id', session()->get('login')['user_id']),
            'getAbsensi'    => $getAbsensi
        ];

        return view('Wali/absensi', $data);
    }

    // Halaman Wali nilai anak anda
    public function nilai()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Search Check
        $search = $this->request->getVar('search');

        // Data Requirement
        $data = [
            'title'             => 'Nilai Anak Didik',
            'getTugasHarian'    => $this->NilaiModel->getSpesificNilaiByKategori('tugas', session()->get('login')['user_id']),
            'getEvaluasi'       => $this->NilaiModel->getSpesificNilaiByKategori('evaluasi', session()->get('login')['user_id']),
            'getUser'           => $this->UserModel->getSpesificUserExtra('user_id', session()->get('login')['user_id']),
            'search'            => $search ? $search : ''
        ];


        return view('Wali/nilai', $data);
    }

    // Halaman Wali jadwal anak anda
    public function jadwal()
    {
        // Blok jika belum memiliki session
        if (session()->get('login') === null) {
            session()->setFlashdata('message', 'Harus Login Terlebih Dahulu!');
            return redirect()->to('/auth');
        }

        // Dapatkan Level id
        $getLevelId = $this->UserModel->getSpesificUserExtra('user_id', session()->get('login')['user_id']);


        // Raw Jadwal
        $rawJadwal = $this->JadwalModel->getJadwalForWali(session()->get('login')['user_id'], $getLevelId->level_id);

        // Data Requirement
        $data = [
            'title'             => 'Jadwal Anak Didik',
            'getJadwal'         => arrangeDatabase($rawJadwal, 'user_id', ['user_id', 'nama_level'], ['nama_hari', 'jam_mulai', 'jam_berakhir'])
        ];

        return view('Wali/jadwal', $data);
    }

    // Halaman Wali Rapot
    public function rapot()
    {
        $nilaiRaw = $this->NilaiModel->getNilaiRapot(session()->get('login')['user_id']);
        // Data Requirement
        $data = [
            'title'             => 'Rapot Anak Didik',
            'getUser'           => $this->UserModel->getSpesificUserExtra('user_id', session()->get('login')['user_id']),
            'getNilai'          => arrangeDatabase($nilaiRaw, 'level_id', ['level_id'], ['mata_pelajaran', 'skor_id']),
            'getKategori'       => $this->NilaiModel->getKategori()
        ];

        // DOMPDF

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', TRUE);
        $options->set('debugKeepTemp', TRUE);
        $options->set('isHtml5ParserEnabled', true);
        // $options->set('chroot', base_url('assets/img/'));
        $pdf = new Dompdf($options);

        $pdf = new Dompdf();

        $pdf->loadHtml(view('Wali/rapot', $data));
        $pdf->setPaper('A4', 'portrait');

        $pdf->render();
        $pdf->stream(hash('ripemd160', $data['getUser']->user_id) . '-' . $data['getUser']->nama_wali, array("Attachment" => false));
    }
}
