<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- RUTE YANG WAJIB LOGIN (Dijaga oleh 'auth') ---
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Rute utama aplikasi
    $routes->get('/', 'Home::index');
    $routes->addRedirect('home', '/'); // Alihkan 'home' ke '/'

    // Rute untuk halaman Akun
    $routes->get('akun', 'Akun::index');
    $routes->post('akun/update_profil', 'Akun::updateProfil');
    $routes->post('akun/update_sandi', 'Akun::updateSandi');

    // --- RUTE UNTUK DATASET ---
    // Menggunakan 'resource' untuk rute CRUD standar (lebih ringkas)
    $routes->resource('dataset', [
        'only' => ['index', 'edit', 'update', 'delete']
    ]);
    // Rute custom untuk upload tetap dipisah
    $routes->post('dataset/upload', 'Dataset::upload');
    $routes->post('dataset/hapus-semua', 'Dataset::hapusSemua', ['as' => 'dataset.hapusSemua']);

    // --- RUTE UNTUK ANALISIS DATA ---
    $routes->get('analisis', 'Analisis::index', ['as' => 'analisis.index']);
    $routes->post('analisis/proses', 'Analisis::proses', ['as' => 'analisis.proses']);
    $routes->post('analisis/simpan', 'Analisis::simpan', ['as' => 'analisis.simpan']);

    $routes->get('history', 'History::index', ['as' => 'history.index']);
    $routes->post('history/delete/(:num)', 'History::delete/$1', ['as' => 'history.delete']);
});


// --- RUTE UNTUK TAMU (Dijaga oleh 'guest') ---
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::index', ['as' => 'login']);
    $routes->get('register', 'Auth::register', ['as' => 'register']);
});


// --- RUTE AKSI PUBLIK (Proses Login, Register, Logout) ---
$routes->post('login', 'Auth::login');
$routes->post('register', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');
