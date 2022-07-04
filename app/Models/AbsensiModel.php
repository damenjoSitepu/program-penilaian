<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    // Mendapatkan data absensi
    public function getAbsensi()
    {
        return $this->db->query("SELECT * FROM absensi INNER JOIN user ON absensi.user_id = user.user_id INNER JOIN anak_didik ON user.user_id = anak_didik.user_id ORDER BY tanggal_absen DESC")->getResultArray();
    }

    // Mendapatkan Data Absensi Berdasarkan Pencarian Tanggal
    public function searchAbsensi($range_tangal)
    {
        return $this->db->query("SELECT * FROM absensi INNER JOIN user ON absensi.user_id = user.user_id INNER JOIN anak_didik ON user.user_id = anak_didik.user_id WHERE (absensi.tanggal_absen BETWEEN '{$range_tangal}' AND CURRENT_DATE()) ORDER BY tanggal_absen DESC")->getResultArray();
    }

    // Mendapatkan data absensi spesifik
    public function getSpesificAbsensi($user_id, $tanggal_absen)
    {
        return $this->db->query("SELECT * FROM absensi WHERE absensi.user_id='{$user_id}' AND absensi.tanggal_absen='{$tanggal_absen}'")->getFirstRow();
    }

    // Mendapatkan data absensi spesifik berdasarkan user
    public function getSpesificAbsensiByUser($user_id)
    {
        return $this->db->query("SELECT * FROM absensi INNER JOIN status ON absensi.status_id = status.status_id WHERE absensi.user_id='{$user_id}' ORDER BY absensi.tanggal_absen ASC")->getResultArray();
    }

    // Mendapatkan data absensi spesifik berdasarkan user dan pencarian tanggal
    public function searchAbsensiSpesificByUser($user_id, $search)
    {
        return $this->db->query("SELECT * FROM absensi INNER JOIN status ON absensi.status_id = status.status_id WHERE absensi.user_id='{$user_id}' AND absensi.tanggal_absen BETWEEN '{$search}' AND CURRENT_DATE() ORDER BY absensi.tanggal_absen ASC")->getResultArray();
    }

    // Mendapatkan data status
    public function getStatus()
    {
        return $this->db->query("SELECT * FROM status ORDER BY status_id ASC")->getResultArray();
    }

    // Tambahkan data absensi
    public function insertAbsensi($absen_data)
    {
        // Storing data
        $tanggal_absen     = $absen_data['tanggal_absen'];
        $status_id         = $absen_data['status_id'];
        $user_id           = $absen_data['user_id'];

        return $this->db->query("INSERT INTO absensi(absen_id,user_id,status_id,tanggal_absen) VALUES('','{$user_id}','{$status_id}','{$tanggal_absen}')");
    }

    // Hapus data absensi
    public function deleteAbsensi($tanggal_absen)
    {
        return $this->db->query("DELETE FROM absensi WHERE absensi.tanggal_absen='{$tanggal_absen}'");
    }
}
