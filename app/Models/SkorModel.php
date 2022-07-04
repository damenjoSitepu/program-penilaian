<?php

namespace App\Models;

use CodeIgniter\Model;

class SkorModel extends Model
{
    // Mendapatkan Seluruh Data Skor
    public function getSkor()
    {
        return $this->db->query("SELECT * FROM skor")->getResultArray();
    }
}
