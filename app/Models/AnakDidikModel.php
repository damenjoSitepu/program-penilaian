<?php

namespace App\Models;

use CodeIgniter\Model;

class AnakDidikModel extends Model
{
    // Mendapatkan seluruh data Anak didik
    public function getAnakDidik()
    {
        return $this->db->query("SELECT * FROM anak_didik INNER JOIN user ON anak_didik.user_id = user.user_id WHERE user.kelas=3 ORDER BY anak_didik.user_id DESC")->getResultArray();
    }

    // Mendapatkan seluruh data anak didik berdasarkan level
    public function getAnakDidikByLevel($level_id)
    {
        return $this->db->query("SELECT * FROM anak_didik INNER JOIN user ON anak_didik.user_id = user.user_id WHERE user.kelas=3 AND anak_didik.level_id='{$level_id}' ORDER BY anak_didik.user_id DESC")->getResultArray();
    }

    public function getAnakDidikByJadwal($jadwal_id)
    {
        return $this->db->query("SELECT * FROM jadwal_detail INNER JOIN user ON jadwal_detail.user_id = user.user_id INNER JOIN anak_didik ON user.user_id = anak_didik.user_id WHERE jadwal_detail.jadwal_id='{$jadwal_id}'")->getResultArray();
    }

    // Mendapatkan seluruh data Anak didik berdasarkan pencarian
    public function searchAnakDidik($nama_anakdidik)
    {
        return $this->db->query("SELECT * FROM anak_didik INNER JOIN user ON anak_didik.user_id = user.user_id WHERE anak_didik.nama_wali LIKE '%{$nama_anakdidik}%' ORDER BY anak_didik.user_id DESC")->getResultArray();
    }

    // Mendapatkan data Anak didik berdasarkan kolom
    public function getSpesificAnakDidik($anakdidik_id = 1)
    {
        return $this->db->query("SELECT * FROM anak_didik INNER JOIN user ON anak_didik.user_id = user.user_id WHERE anak_didik.user_id={$anakdidik_id}")->getFirstRow();
    }

    // Mendapatkan data Anak didik dengan metode LIke
    public function getSpesificUserFriendly($column = 'username', $value = '')
    {
        return $this->db->query("SELECT * FROM user INNER JOIN anak_didik ON user.user_id = anak_didik.user_id WHERE anak_didik.{$column} LIKE '%{$value}%'")->getResultArray();
    }

    // Tambahkan Data Tambahan Anak Didik 
    public function insertUser($user_id, $data)
    {
        $tanggal_lahir              = $data['tanggal_lahir'];
        $jenis_kelamin              = $data['jenis_kelamin'];
        $agama                      = $data['agama'];
        $no_telepon                 = $data['no_telepon'];
        $nama                       = $data['nama'];
        $alamat                     = $data['alamat'];

        return $this->db->query("INSERT INTO anak_didik(user_id,level_id,tanggal_lahir,jenis_kelamin,agama,no_telepon,nama_wali,alamat) VALUES ('{$user_id}','1','{$tanggal_lahir}','{$jenis_kelamin}','{$agama}','{$no_telepon}','{$nama}','{$alamat}')");
    }

    // Ubah Data Tambahan Anak Didik
    public function updateAnakDidik($user_id, $data)
    {
        $tanggal_lahir          = $data['tanggal_lahir'];
        $jenis_kelamin          = $data['jenis_kelamin'];
        $agama                  = $data['agama'];
        $no_telepon             = $data['no_telepon'];
        $alamat             = $data['alamat'];
        $nama               = $data['nama'];
        $level_id             = $data['level_id'];
        $catatan             = $data['catatan'];

        return $this->db->query("UPDATE anak_didik SET level_id='{$level_id}', catatan='{$catatan}', tanggal_lahir='{$tanggal_lahir}', jenis_kelamin='{$jenis_kelamin}', agama='{$agama}', no_telepon='{$no_telepon}', nama_wali='{$nama}', alamat='{$alamat}' WHERE user_id='{$user_id}'");
    }

    // Ubah Data Sertifikat
    public function updateSertifikat($anakdidik_id, $data, $no_sertifikat = 1)
    {
        $photo = $data['photo'];

        return $this->db->query("UPDATE anak_didik SET photo{$no_sertifikat}='{$photo}' WHERE user_id='{$anakdidik_id}'");
    }

    // Hapus Data Anak Didik
    public function deleteAnakDidik($anakdidik_id)
    {
        $this->db->query("DELETE FROM nilai_detail WHERE nilai_detail.user_id='{$anakdidik_id}'");
        $this->db->query("DELETE FROM jadwal_detail WHERE jadwal_detail.user_id='{$anakdidik_id}'");
        $this->db->query("DELETE FROM absensi WHERE absensi.user_id='{$anakdidik_id}'");
        $this->db->query("DELETE FROM anak_didik WHERE anak_didik.user_id='{$anakdidik_id}'");
        $this->db->query("DELETE FROM user WHERE user.user_id='{$anakdidik_id}'");
    }
}
