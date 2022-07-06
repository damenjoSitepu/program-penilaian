<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Mendapatkan seluruh user
    public function getUser()
    {
        return $this->db->query("SELECT * FROM pengguna INNER JOIN anak_didik ON pengguna.user_id = anak_didik.user_id WHERE kelas=3 ORDER BY pengguna.user_id DESC")->getResultArray();
    }

    // Mendapatkan user terntentu berdasarkan kolom tertentu yang lebih friendly
    public function getSpesificUserFriendly($column = 'username', $value = '')
    {
        return $this->db->query("SELECT * FROM pengguna WHERE {$column} LIKE '%{$value}%'")->getResultArray();
    }

    // Mendapatkan user tertentu berdasarkan kolom tertentu
    public function getSpesificUser($column = 'username', $value = '')
    {
        return $this->db->query("SELECT * FROM pengguna WHERE {$column}='{$value}';")->getFirstRow();
    }

    // Mendapatkan user tertentu berdasarkan kolom tertentu ( user anak didik )
    public function getSpesificUserExtra($column = 'username', $value = '')
    {
        return $this->db->query("SELECT * FROM pengguna INNER JOIN anak_didik ON pengguna.user_id = anak_didik.user_id INNER JOIN level ON anak_didik.level_id = level.level_id WHERE pengguna.{$column}='{$value}'")->getFirstRow();
    }

    // Tambahkan default user
    public function insertUser($data, $dataDefault, $type)
    {

        $username = $dataDefault['username'];
        $password = $dataDefault['password'];

        if ($type === 'motivator') {
            $nama = $data['nama'];
            return $this->db->query("INSERT INTO pengguna(user_id,nama,username,password,kelas) VALUES('','{$nama}','{$username}','{$password}','2')");
        } else {
            $nama = $data['nama_wali'];
            return $this->db->query("INSERT INTO pengguna(user_id,nama,username,password,kelas) VALUES('','{$nama}','{$username}','{$password}','3')");
        }
    }

    // Ganti Password User
    public function changePassword($user_id, $new_password)
    {
        return $this->db->query("UPDATE pengguna SET password='{$new_password}' WHERE user_id='{$user_id}'");
    }
}
