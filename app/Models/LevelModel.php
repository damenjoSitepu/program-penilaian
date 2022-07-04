<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelModel extends Model
{
    // Mendapatkan seluruh data Level
    public function getLevel()
    {
        return $this->db->query("SELECT * FROM level ORDER BY level_id DESC")->getResultArray();
    }

    // Mendapatkan seluruh data level yang hanya memiliki data jadwal saja
    public function getLevelWithSchedule()
    {
        return $this->db->query("SELECT * FROM level INNER JOIN jadwal ON level.level_id = jadwal.level_id GROUP BY level.level_id ORDER BY jadwal.level_id ASC")->getResultArray();
    }

    // Mendapatkan data level berdasarkan kolom dan nilai
    public function getSpesificLevel($value = '', $column = 'level_id')
    {
        return $this->db->query("SELECT * FROM level WHERE {$column}='{$value}'")->getFirstRow();
    }
}
