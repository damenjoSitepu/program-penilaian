<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    // Mendapatkan Data Nilai
    public function getNilai($user = 'admin', $motivator_id = '')
    {
        if ($user === 'admin')
            return $this->db->query("SELECT *, usermotivator.nama as nama_motivator, nilai.nilai_id as nilai_id_real FROM nilai LEFT JOIN nilai_detail ON nilai.nilai_id = nilai_detail.nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN pengguna AS usermotivator ON nilai.user_id = usermotivator.user_id LEFT JOIN pengguna AS userdetail ON nilai_detail.user_id = userdetail.user_id ORDER BY level.level_id ASC")->getResultArray();
        else
            return $this->db->query("SELECT *, usermotivator.nama as nama_motivator, nilai.nilai_id as nilai_id_real FROM nilai LEFT JOIN nilai_detail ON nilai.nilai_id = nilai_detail.nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN pengguna AS usermotivator ON nilai.user_id = usermotivator.user_id LEFT JOIN pengguna AS userdetail ON nilai_detail.user_id = userdetail.user_id WHERE usermotivator.user_id='{$motivator_id}' ORDER BY level.level_id ASC")->getResultArray();
    }

    // Mendapatkan Data Nilai Berdasarkan Pencarian Tanggal
    public function searchNilai($range_tangal, $user = 'admin', $motivator_id = '')
    {
        if ($user === 'admin')
            return $this->db->query("SELECT *, usermotivator.nama as nama_motivator, nilai.nilai_id as nilai_id_real FROM nilai LEFT JOIN nilai_detail ON nilai.nilai_id = nilai_detail.nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN pengguna AS usermotivator ON nilai.user_id = usermotivator.user_id LEFT JOIN pengguna AS userdetail ON nilai_detail.user_id = userdetail.user_id WHERE ( nilai.tanggal_penilaian BETWEEN '{$range_tangal}' AND CURRENT_DATE) ORDER BY level.level_id ASC")->getResultArray();
        else
            return $this->db->query("SELECT *, usermotivator.nama as nama_motivator, nilai.nilai_id as nilai_id_real FROM nilai LEFT JOIN nilai_detail ON nilai.nilai_id = nilai_detail.nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN pengguna AS usermotivator ON nilai.user_id = usermotivator.user_id LEFT JOIN pengguna AS userdetail ON nilai_detail.user_id = userdetail.user_id WHERE usermotivator.user_id='{$motivator_id}' AND ( nilai.tanggal_penilaian BETWEEN '{$range_tangal}' AND CURRENT_DATE) ORDER BY level.level_id ASC")->getResultArray();
    }

    // Mendapatkan Data Nilai dan data nilai detail berdasarkan jadwal id
    public function getNilaiAndNilaiDetailByJadwalId($jadwal_id)
    {
        return $this->db->query("SELECT * FROM nilai INNER JOIN nilai_detail ON nilai.nilai_id = nilai_detail.nilai_id WHERE nilai.jadwal_id='{$jadwal_id}'")->getResultArray();
    }

    // Mendapatkan Data Nilai berdasarkan jadwal id
    public function getNilaiByJadwalId($jadwal_id)
    {
        return $this->db->query("SELECT * FROM nilai WHERE nilai.jadwal_id='{$jadwal_id}'")->getResultArray();
    }

    // Mendapatkan Data Nilai berdasarkan kategori dan user id
    public function getSpesificNilaiByKategori($kategoriName = 'tugas', $user_id = false)
    {
        if (!$user_id) {
            return $this->db->query("SELECT * FROM nilai_detail INNER JOIN nilai ON nilai_detail.nilai_id = nilai.nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN pengguna ON nilai.user_id = pengguna.user_id WHERE nilai_detail.user_id={$user_id} ORDER BY nilai.tanggal_penilaian ASC")->getResultArray();
        } else {
            if ($kategoriName === 'tugas') {
                return $this->db->query("SELECT * FROM nilai_detail INNER JOIN nilai ON nilai_detail.nilai_id = nilai.nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN pengguna ON nilai.user_id = pengguna.user_id WHERE nilai_detail.user_id={$user_id} AND kategori_nilai.kategori_nilai_id=1 ORDER BY nilai.tanggal_penilaian ASC")->getResultArray();
            } else {
                return $this->db->query("SELECT * FROM nilai_detail INNER JOIN nilai ON nilai_detail.nilai_id = nilai.nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN pengguna ON nilai.user_id = pengguna.user_id WHERE nilai_detail.user_id={$user_id} AND kategori_nilai.kategori_nilai_id=2 ORDER BY nilai.tanggal_penilaian ASC")->getResultArray();
            }
        }
    }

    // Mendapatkan Data Nilai Visualisasi Rank
    public function getNilaiRank($nilai_id)
    {
        return $this->db->query("SELECT * FROM nilai INNER JOIN nilai_detail ON nilai.nilai_id = nilai_detail.nilai_id INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN pengguna ON nilai_detail.user_id = pengguna.user_id INNER JOIN anak_didik ON pengguna.user_id = anak_didik.user_id INNER JOIN skor ON nilai_detail.skor_id = skor.skor_id WHERE nilai.nilai_id={$nilai_id} ORDER BY nilai_detail.skor_id DESC")->getResultArray();
    }

    // Mendapatkan data nilai rapot
    public function getNilaiRapot($anakdidik_id = '')
    {
        return $this->db->query("SELECT * FROM level INNER JOIN jadwal ON level.level_id = jadwal.level_id INNER JOIN nilai ON jadwal.jadwal_id = nilai.jadwal_id INNER JOIN nilai_detail ON nilai.nilai_id = nilai_detail.nilai_id WHERE nilai_detail.user_id={$anakdidik_id} ORDER BY level.level_id ASC, nilai.tanggal_penilaian ASC")->getResultArray();
    }

    // Mendapatkan Data Nilai Tertentu Dengan Sangat Aman ( Strict )
    public function getStrictNilai($user_id, $tanggal_penilaian, $mata_pelajaran, $jadwal_id)
    {
        return $this->db->query("SELECT * FROM nilai WHERE tanggal_penilaian='{$tanggal_penilaian}' AND mata_pelajaran='{$mata_pelajaran}' AND jadwal_id='{$jadwal_id}' AND user_id='{$user_id}' ORDER BY nilai_id DESC ")->getFirstRow();
    }

    // Mendapatkan Nilai Tertentu
    public function getSpesificNilai($nilai_id, $column = 'nilai_id')
    {
        return $this->db->query("SELECT *, user.nama as nama_motivator FROM nilai INNER JOIN kategori_nilai ON nilai.kategori_nilai_id = kategori_nilai.kategori_nilai_id INNER JOIN jadwal ON nilai.jadwal_id = jadwal.jadwal_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN pengguna ON nilai.user_id = pengguna.user_id WHERE nilai.{$column}={$nilai_id}")->getFirstRow();
    }

    // Mendapatkan Nilai Detail Tertentu
    public function getSpesificNilaiDetail($nilai_id)
    {
        return $this->db->query("SELECT * FROM nilai_detail INNER JOIN pengguna ON nilai_detail.user_id = pengguna.user_id INNER JOIN anak_didik ON pengguna.user_id = anak_didik.user_id WHERE nilai_id={$nilai_id}")->getResultArray();
    }

    // Mendapatkan Nilai Detail Tertentu Berdasarkan User Id
    public function getSpesificNilaiDetailByUserId($user_id, $nilai_id)
    {
        return $this->db->query("SELECT * FROM nilai_detail INNER JOIN pengguna ON nilai_detail.user_id = pengguna.user_id INNER JOIN anak_didik ON pengguna.user_id = anak_didik.user_id WHERE nilai_detail.user_id='{$user_id}' AND nilai_detail.nilai_id='{$nilai_id}'")->getFirstRow();
    }

    // Mendapatkan data kategori penilaian 
    public function getKategori()
    {
        return $this->db->query("SELECT * FROM kategori_nilai ORDER BY kategori_nilai_id DESC")->getResultArray();
    }

    // Tambahkan Data Nilai
    public function insertNilai($nilai_data)
    {
        // Storing Data
        $kategoriNilaiId    = $nilai_data['kategori_nilai_id'];
        $tanggalPenilaian   = $nilai_data['tanggal_penilaian'];
        $jadwalId           = $nilai_data['jadwal_id'];
        $mataPelajaran      = $nilai_data['mata_pelajaran'];
        $userId             = $nilai_data['user_id'];

        $this->db->query("INSERT INTO nilai (nilai_id,kategori_nilai_id,jadwal_id,user_id,tanggal_penilaian,mata_pelajaran) VALUES('','$kategoriNilaiId','$jadwalId','$userId','$tanggalPenilaian','$mataPelajaran')");
    }

    // Tambahkan Data Murid Di Dalam Data Nilai ( Nilai Detail )
    public function insertMurid($murid_data, $nilai_id)
    {
        $userId = $murid_data['user_id'];

        return $this->db->query("INSERT INTO nilai_detail(nilai_id,user_id,skor_id) VALUES ('{$nilai_id}','{$userId}','1')");
    }

    // Menghapus Data Nilai
    public function deleteNilai($nilai_id)
    {
        // Hapus Nilai Detail
        $db = db_connect();
        $db->query("DELETE FROM nilai_detail WHERE nilai_detail.nilai_id='{$nilai_id}'");
        // Hapus Nilai
        $this->db->query("DELETE FROM nilai WHERE nilai.nilai_id='{$nilai_id}'");

        return $db->affectedRows();
    }

    // Menghapus Data Murid Di Dalam Data Nilai ( Nilai Detail )
    public function deleteMurid($anakdidik_id, $value_id = '')
    {
        return $this->db->query("DELETE FROM nilai_detail WHERE nilai_detail.user_id='{$anakdidik_id}' AND nilai_detail.nilai_id='{$value_id}'");
    }

    // Update Data Nilai
    public function updateNilai($nilai_data, $nilai_id)
    {
        // Storing Data
        $kategoriNilaiId = $nilai_data['kategori_nilai_id'];
        $mataPelajaran      = $nilai_data['mata_pelajaran'];
        $userId             = $nilai_data['user_id'];
        $jadwalId           = $nilai_data['jadwal_id'];

        return $this->db->query("UPDATE nilai SET kategori_nilai_id='{$kategoriNilaiId}', mata_pelajaran='{$mataPelajaran}', user_id='{$userId}', jadwal_id='{$jadwalId}' WHERE nilai_id='{$nilai_id}'");
    }

    // Update Data Nilai Anak ( Nilai Detail )
    public function updateNilaiAnak($nilai_id, $user_id, $skor_id)
    {
        return $this->db->query("UPDATE nilai_detail SET skor_id='{$skor_id}' WHERE nilai_id='{$nilai_id}' AND user_id='{$user_id}'");
    }
}
