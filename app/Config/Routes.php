<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Halaman Autentifikasi
$routes->get('/', 'User/UserPages::index');
$routes->get('/OrangTua', 'User/UserPages::wali');
$routes->get('/OrangTua/Absensi', 'User/UserPages::absensi');
$routes->get('/OrangTua/Nilai', 'User/UserPages::nilai');
$routes->get('/OrangTua/Jadwal', 'User/UserPages::jadwal');
$routes->get('/OrangTua/Jadwal', 'User/UserPages::jadwal');
$routes->get('/OrangTua/Rapot', 'User/UserPages::rapot');
$routes->get('/auth', 'Auth/AuthPages::index');

// Halaman Motivator
$routes->get('/Motivator', 'Motivator/MotivatorPages::index');
$routes->get('/Motivator/buat', 'Motivator/MotivatorPages::buat');
$routes->get('/Motivator/MotivatorPages/sunting/motivator_id', 'motivator/MotivatorPages::sunting/motivator_id');
$routes->get('/Motivator/MotivatorProcess/hapus/motivator_id', 'motivator/MotivatorProcess::hapus/motivator_id');

// Halaman Anak Didik
$routes->get('/AnakDidik', 'AnakDidik/AnakDidikPages::index');
$routes->get('/AnakDidik/buat', 'AnakDidik/AnakDidikPages::buat');
$routes->get('/AnakDidik/AnakDidikPages/sunting/anakdidik_id', 'AnakDidik/AnakDidikPages::sunting/anakdidik_id');
$routes->get('/AnakDidik/AnakDidikProcess/hapus/anakdidik_id', 'AnakDidik/AnakDidikProcess::hapus/anakdidik_id');
$routes->get('/AnakDidik/AnakDidikProcess/sertifikat/image_id', '/AnakDidik/AnakDidikProcess::sertifikat/image_id');

// Halaman Level
$routes->get('/Level', 'Level/LevelPages::index');
$routes->get('/Level/buat', 'Level/LevelPages::buat');
$routes->get('/Level/LevelPages/sunting/Level_id', 'Level/LevelPages::sunting/Level_id');
$routes->get('/Level/LevelProcess/hapus/Level_id', 'Level/LevelProcess::hapus/Level_id');

// Halaman Jadwal
$routes->get('/Jadwal', 'Jadwal/JadwalPages::index');
$routes->get('/Jadwal/buat', 'Jadwal/JadwalPages::buat');
$routes->get('/Jadwal/JadwalPages/sunting/jadwal_id', 'Jadwal/JadwalPages::sunting/jadwal_id');
$routes->get('/Jadwal/JadwalProcess/hapus/jadwal_id', 'Jadwal/JadwalProcess::hapus/jadwal_id');

// Halaman Absensi
$routes->get('/Absensi', 'Absensi/AbsensiPages::index');
$routes->get('/Absensi/buat', 'Absensi/AbsensiPages::buat');
$routes->get('/Absensi/AbsensiPages/sunting/Absensi_id', 'Absensi/AbsensiPages::sunting/Absensi_id');
$routes->get('/Absensi/AbsensiProcess/hapus/Absensi_id', 'Absensi/AbsensiProcess::hapus/Absensi_id');

// Halaman Nilai
$routes->get('/Nilai', 'Nilai/NilaiPages::index');
$routes->get('/Nilai/buat', 'Nilai/NilaiPages::buat');
$routes->get('/Nilai/NilaiPages/kelolaPenilaian/Nilai_id', 'Nilai/NilaiPages::kelolaPenilaian/Nilai_id');
$routes->get('/Nilai/NilaiPages/suntingNilai/Nilai_id', 'Nilai/NilaiPages::suntingNilai/Nilai_id');
$routes->get('/Nilai/NilaiPages/detail/Nilai_id', 'Nilai/NilaiPages::detail/Nilai_id');
$routes->get('Nilai/NilaiProcess/hapusRuangMurid/AnakDidik_id/Nilai_id', 'Nilai/NilaiPages::hapusRuangMurid/AnakDidik_id/Nilai_id');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
