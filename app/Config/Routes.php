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
    $routes->post('surat/domisili-warga/preview', 'Masyarakat\SuratController::previewDomisiliWarga');

    $routes->get('surat/pindah', 'Masyarakat\SuratController::pindah');
    $routes->post('surat/pindah/preview', 'Masyarakat\SuratController::previewPindah');

    $routes->get('surat/usaha', 'Masyarakat\SuratController::usaha');
    $routes->post('surat/usaha/preview', 'Masyarakat\SuratController::previewUsaha');
    
    $routes->get('surat/pengantar-kk-ktp', 'Masyarakat\SuratController::pengantarKKKTP');
    $routes->post('surat/pengantar-kk-ktp/preview', 'Masyarakat\SuratController::previewPengantarKKKTP');
    
    $routes->get('surat/tidak-mampu', 'Masyarakat\SuratController::tidakMampu');
    $routes->post('surat/tidak-mampu/preview', 'Masyarakat\SuratController::previewTidakMampu');

    $routes->get('surat/belum-bekerja', 'Masyarakat\SuratController::belumBekerja');
    $routes->post('surat/belum-bekerja/preview', 'Masyarakat\SuratController::previewBelumBekerja');

    $routes->get('surat/kehilangan', 'Masyarakat\SuratController::kehilangan');
    $routes->post('surat/kehilangan/preview', 'Masyarakat\SuratController::previewKehilangan');

    $routes->get('surat/catatan-polisi', 'Masyarakat\SuratController::catatanPolisi');
    $routes->post('surat/catatan-polisi/preview', 'Masyarakat\SuratController::previewCatatanPolisi');

    $routes->get('surat/kelahiran', 'Masyarakat\SuratController::kelahiran');
    $routes->post('surat/kelahiran/preview', 'Masyarakat\SuratController::previewKelahiran');

    $routes->get('surat/kematian', 'Masyarakat\SuratController::kematian');
    $routes->post('surat/kematian/preview', 'Masyarakat\SuratController::previewKematian');

    $routes->get('surat/ahli-waris', 'Masyarakat\SuratController::ahliWaris');
    $routes->post('surat/ahli-waris/preview', 'Masyarakat\SuratController::previewAhliWaris');

    $routes->get('surat/suami-istri', 'Masyarakat\SuratController::suamiIstri');
    $routes->get('surat/status-perkawinan', 'Masyarakat\SuratController::statusPerkawinan');
});


