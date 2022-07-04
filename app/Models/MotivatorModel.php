<?php

namespace App\Models;

use CodeIgniter\Model;

class MotivatorModel extends Model
{
    // Mendapatkan seluruh data motivator
    public function getMotivator()
    {
        return $this->db->query("SELECT * FROM motivator INNER JOIN user ON motivator.user_id = user.user_id ORDER BY motivator.user_id DESC")->getResultArray();
    }

    // Mendapatkan seluruh data motivator berdasarkan pencarian
    public function searchMotivator($nama_motivator)
    {
        return $this->db->query("SELECT * FROM motivator INNER JOIN user ON motivator.user_id = user.user_id WHERE user.nama LIKE '%{$nama_motivator}%' ORDER BY motivator.user_id DESC")->getResultArray();
    }

    // Mendapatkan data motivator berdasarkan kolom
    public function getSpesificMotivator($motivator_id = 1)
    {
        return $this->db->query("SELECT * FROM motivator INNER JOIN user ON motivator.user_id = user.user_id WHERE motivator.user_id={$motivator_id}")->getFirstRow();
    }

    // Tambahkan Data Tambahan Motivator 
    public function insertUser($user_id, $data)
    {
        $id                 = $data['id'];
        $tanggal_lahir      = $data['tanggal_lahir'];
        $jenis_kelamin      = $data['jenis_kelamin'];
        $agama              = $data['agama'];
        $no_telepon         = $data['no_telepon'];
        $email              = $data['email'];
        $alamat             = $data['alamat'];

        return $this->db->query("INSERT INTO motivator(user_id,id,tanggal_lahir,jenis_kelamin,agama,no_telepon,email,alamat) VALUES ('{$user_id}','{$id}','{$tanggal_lahir}','{$jenis_kelamin}','{$agama}','{$no_telepon}','{$email}','{$alamat}')");
    }

    // Ubah Data Tambahan Motivator
    public function updateMotivator($user_id, $data)
    {
        $id                 = $data['id'];
        $tanggal_lahir      = $data['tanggal_lahir'];
        $jenis_kelamin      = $data['jenis_kelamin'];
        $agama              = $data['agama'];
        $no_telepon         = $data['no_telepon'];
        $email              = $data['email'];
        $alamat             = $data['alamat'];

        return $this->db->query("UPDATE motivator SET id='{$id}', tanggal_lahir='{$tanggal_lahir}', jenis_kelamin='{$jenis_kelamin}', agama='{$agama}', no_telepon='{$no_telepon}', email='{$email}', alamat='{$alamat}' WHERE user_id='{$user_id}'");
    }

    // Menghapus Motivator
    public function deleteMotivator($motivator_id)
    {
        // Hapus Nilai
        $this->db->query("DELETE FROM nilai WHERE nilai.user_id='{$motivator_id}'");
        // Hapus Motivator
        $this->db->query("DELETE FROM motivator WHERE motivator.user_id='{$motivator_id}'");
        // Hapus User
        $this->db->query("DELETE FROM user WHERE user.user_id='{$motivator_id}'");
    }
}
