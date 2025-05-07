<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Group khusus masyarakat
$routes->group('masyarakat', function($routes) {
    // Dashboard Masyarakat
    $routes->get('dashboard', 'Masyarakat\MasyarakatDashboardController::index');
    $routes->get('surat', 'Masyarakat\SuratController::index');

    // Surat-surat spesifik
    $routes->get('surat/domisili-kelompok-tani', 'Masyarakat\SuratController::domisiliKelompokTani');
    $routes->post('surat/domisili-kelompok-tani/preview', 'Masyarakat\SuratController::previewDomisiliKelompokTani');

    $routes->get('surat/domisili-bangunan', 'Masyarakat\SuratController::domisiliBangunan');
    $routes->post('surat/domisili-bangunan/preview', 'Masyarakat\SuratController::previewDomisiliBangunan');
    
    $routes->get('surat/domisili-manusia', 'Masyarakat\SuratController::domisiliManusia');
    $routes->get('surat/pindah', 'Masyarakat\SuratController::pindah');
    $routes->get('surat/usaha', 'Masyarakat\SuratController::usaha');
    $routes->get('surat/pengantar-kk-ktp', 'Masyarakat\SuratController::pengantarKKKTP');
    $routes->get('surat/tidak-mampu', 'Masyarakat\SuratController::tidakMampu');
    $routes->get('surat/belum-bekerja', 'Masyarakat\SuratController::belumBekerja');
    $routes->get('surat/kehilangan', 'Masyarakat\SuratController::kehilangan');
    $routes->get('surat/catatan-polisi', 'Masyarakat\SuratController::catatanPolisi');
    $routes->get('surat/kelahiran', 'Masyarakat\SuratController::kelahiran');
    $routes->get('surat/kematian', 'Masyarakat\SuratController::kematian');
    $routes->get('surat/ahli-waris', 'Masyarakat\SuratController::ahliWaris');
    $routes->get('surat/suami-istri', 'Masyarakat\SuratController::suamiIstri');
    $routes->get('surat/status-perkawinan', 'Masyarakat\SuratController::statusPerkawinan');
});


