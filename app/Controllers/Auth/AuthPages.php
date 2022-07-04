<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class AuthPages extends BaseController
{
    // Halaman Utama Auth ( Login )
    public function index()
    {
        // Data Requirement
        $data = [
            'title'         => 'Login Bimba AIUEO',
            'validation'    => \Config\Services::validation()
        ];

        return view('Auth/index', $data);
    }
}
