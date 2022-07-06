<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    // Menampilkan seluruh user jadwal detail
    public function getJadwalDetail($jadwal_id)
    {
        return $this->db->query("SELECT * FROM jadwal_detail INNER JOIN anak_didik ON jadwal_detail.user_id = anak_didik.user_id WHERE jadwal_id='{$jadwal_id}'")->getResultArray();
    }

    // Untuk menampilkan jadwal
    public function getJadwal()
    {
        return $this->db->query("SELECT * FROM level INNER JOIN jadwal ON level.level_id = jadwal.level_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id ORDER BY jadwal.hari_id ASC")->getResultArray();
    }

    // Untuk menampilkan jadwal berdasarkan pencarian
    public function searchJadwal($search)
    {
        return $this->db->query("SELECT * FROM level INNER JOIN jadwal ON level.level_id = jadwal.level_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id WHERE jadwal.level_id LIKE '%{$search}%' ORDER BY jadwal.hari_id ASC")->getResultArray();
    }

    // Menampilkan banyak jadwal berdasarkan 
    public function getSpesificJadwalBy($value = '', $column = 'jadwal_id')
    {
        return $this->db->query("SELECT * FROM jadwal INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN level ON jadwal.level_id = level.level_id WHERE jadwal.{$column}='{$value}'")->getResultArray();
    }

    // Menampilkan jadwal berdasarkan level id dan hari
    public function getSpesificJadwalByLevelAndDay($level_id, $hari_id)
    {
        return $this->db->query("SELECT * FROM jadwal INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN level ON jadwal.level_id = level.level_id WHERE jadwal.level_id='{$level_id}' AND jadwal.hari_id='{$hari_id}'")->getFirstRow();
    }

    // Mendapatkan Jadwal Detail Tertentu Berdasarkan User Id
    public function getSpesificJadwalDetailByUserId($user_id, $jadwal_id)
    {
        return $this->db->query("SELECT * FROM jadwal_detail INNER JOIN pengguna ON jadwal_detail.user_id = pengguna.user_id INNER JOIN anak_didik ON pengguna.user_id = anak_didik.user_id WHERE jadwal_detail.user_id='{$user_id}' AND jadwal_detail.jadwal_id='{$jadwal_id}'")->getFirstRow();
    }

    // Menampilkan jadwal berdasarkan 
    public function getSpesificJadwal($value = '', $column = 'jadwal_id')
    {
        return $this->db->query("SELECT * FROM jadwal INNER JOIN hari ON jadwal.hari_id = hari.hari_id INNER JOIN level ON jadwal.level_id = level.level_id WHERE jadwal.{$column}='{$value}'")->getFirstRow();
    }

    // Menampilkan jadwal dengan detail jadwalnya
    public function getSpesificJadwalWithDetail($jadwal_id = '')
    {
        return $this->db->query("SELECT * FROM jadwal INNER JOIN jadwal_detail ON jadwal.jadwal_id = jadwal_detail.jadwal_id WHERE jadwal.jadwal_id='{$jadwal_id}'")->getResultArray();
    }

    // Menampilkan jadwal dengan detail jadwalnya untuk wali
    public function getJadwalForWali($anakdidik_id = '', $level_id = '')
    {
        return $this->db->query("SELECT * FROM jadwal INNER JOIN jadwal_detail ON jadwal.jadwal_id = jadwal_detail.jadwal_id INNER JOIN anak_didik ON jadwal_detail.user_id = anak_didik.user_id INNER JOIN level ON jadwal.level_id = level.level_id INNER JOIN hari ON jadwal.hari_id = hari.hari_id WHERE jadwal_detail.user_id='{$anakdidik_id}' AND jadwal.level_id='{$level_id}' ORDER BY hari.hari_id ASC")->getResultArray();
    }

    // Menampilkan Hari
    public function getHari()
    {
        return $this->db->query("SELECT * FROM hari")->getResultArray();
    }

    // Menampilkan hari berdasarkan hari id
    public function getSpesificHari($hari_id)
    {
        return $this->db->query("SELECT * FROM hari WHERE hari.hari_id='{$hari_id}'")->getFirstRow();
    }

    // Menambahkan Data Jadwal
    public function insertJadwal($jadwal)
    {
        // Storing Data
        $hari_id = $jadwal['hari_id'];
        $jam_mulai = $jadwal['jam_mulai'];
        $jam_berakhir = $jadwal['jam_berakhir'];
        $level_id = $jadwal['level_id'];

        return $this->db->query("INSERT INTO jadwal(jadwal_id,hari_id,level_id,jam_mulai,jam_berakhir) VALUES('','{$hari_id}','{$level_id}','{$jam_mulai}','{$jam_berakhir}')");
    }

    // Menambahkan Data Murid ke jadwal detail
    public function insertJadwalMurid($murid_data, $jadwal_id)
    {
        $userId = $murid_data['user_id'];

        return $this->db->query("INSERT INTO jadwal_detail(jadwal_id,user_id) VALUES ('{$jadwal_id}','{$userId}')");
    }

    // Menghapus Data Jadwal
    public function deleteJadwal($jadwal_id)
    {
        return $this->db->query("DELETE FROM jadwal WHERE jadwal.jadwal_id='{$jadwal_id}'");
    }

    // Menghapus Data Murid Di Dalam Data Jadwal ( Jadwal Detail )
    public function deleteJadwalMurid($anakdidik_id, $jadwal_id)
    {
        return $this->db->query("DELETE FROM jadwal_detail WHERE jadwal_detail.user_id='{$anakdidik_id}' AND jadwal_detail.jadwal_id='{$jadwal_id}'");
    }

    // Mengubah Data Jadwal
    public function updateJadwal($jadwal_id, $data)
    {
        $hari_id = $data['hari_id'];
        $jam_mulai = $data['jam_mulai'];
        $jam_berakhir = $data['jam_berakhir'];
        $level_id = $data['level_id'];

        return $this->db->query("UPDATE jadwal SET hari_id='{$hari_id}', jam_mulai='{$jam_mulai}', jam_berakhir='{$jam_berakhir}', level_id='{$level_id}' WHERE jadwal_id='{$jadwal_id}'");
    }
}
