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
    $routes->get('surat/domisili-kelompok-tani', 'Masyarakat\SuratKelompokTaniController::domisiliKelompokTani');
    $routes->post('surat/domisili-kelompok-tani/ajukan', 'Masyarakat\SuratKelompokTaniController::ajukanDomisiliKelompokTani');
    $routes->post('surat/domisili-kelompok-tani/preview', 'Masyarakat\SuratKelompokTaniController::previewDomisiliKelompokTani');
    $routes->get('data-surat/domisili_kelompok_tani/download/(:num)', 'Masyarakat\SuratKelompokTaniController::downloadSurat/$1');

    $routes->get('surat/domisili-bangunan', 'Masyarakat\SuratDomisiliBangunanController::domisiliBangunan');
    $routes->post('surat/domisili-bangunan/ajukan', 'Masyarakat\SuratDomisiliBangunanController::ajukanDomisiliBangunan');
    $routes->post('surat/domisili-bangunan/preview', 'Masyarakat\SuratDomisiliBangunanController::previewDomisiliBangunan');
    $routes->get('data-surat/domisili_bangunan/download/(:num)', 'Masyarakat\SuratDomisiliBangunanController::downloadSurat/$1');
    
    $routes->get('surat/domisili-manusia', 'Masyarakat\SuratDomisiliManusiaController::domisiliManusia');
    $routes->post('surat/domisili-warga/ajukan', 'Masyarakat\SuratDomisiliManusiaController::ajukanDomisiliWarga');
    $routes->post('surat/domisili-warga/preview', 'Masyarakat\SuratDomisiliManusiaController::previewDomisiliWarga');
    $routes->get('data-surat/domisili_warga/download/(:num)', 'Masyarakat\SuratDomisiliManusiaController::downloadSurat/$1');

    $routes->get('surat/pindah', 'Masyarakat\SuratPindahController::pindah');
    $routes->post('surat/pindah/ajukan', 'Masyarakat\SuratPindahController::ajukanPindah');
    $routes->post('surat/pindah/preview', 'Masyarakat\SuratPindahController::previewPindah');
    $routes->get('data-surat/surat-pindah/download/(:num)', 'Masyarakat\SuratPindahController::downloadSurat/$1');

    $routes->get('surat/usaha', 'Masyarakat\SuratUsahaController::usaha');
    $routes->post('surat/usaha/ajukan', 'Masyarakat\SuratUsahaController::ajukanUsaha');
    $routes->post('surat/usaha/preview', 'Masyarakat\SuratUsahaController::previewUsaha');
    $routes->get('data-surat/usaha/download/(:num)', 'Masyarakat\SuratUsahaController::downloadSurat/$1');
     
    $routes->get('surat/pengantar-kk-ktp', 'Masyarakat\SuratPengantarKKKTPController::pengantarKKKTP');
    $routes->post('surat/pengantar-kk-ktp/ajukan', 'Masyarakat\SuratPengantarKKKTPController::ajukanPengantarKKKTP');
    $routes->post('surat/pengantar-kk-ktp/preview', 'Masyarakat\SuratPengantarKKKTPController::previewPengantarKKKTP');
    $routes->get('data-surat/pengantar_kk_ktp/download/(:num)', 'Masyarakat\SuratPengantarKKKTPController::downloadSurat/$1');
    
    $routes->get('surat/tidak-mampu', 'Masyarakat\SuratTidakMampuController::tidakMampu');
    $routes->post('surat/tidak-mampu/ajukan', 'Masyarakat\SuratTidakMampuController::ajukanTidakMampu');
    $routes->post('surat/tidak-mampu/preview', 'Masyarakat\SuratTidakMampuController::previewTidakMampu');
    $routes->get('data-surat/tidak_mampu/download/(:num)', 'Masyarakat\SuratTidakMampuController::downloadSurat/$1');

    $routes->get('surat/belum-bekerja', 'Masyarakat\SuratBelumBekerjaController::belumBekerja');
    $routes->post('surat/belum-bekerja/ajukan', 'Masyarakat\SuratBelumBekerjaController::ajukanBelumBekerja');
    $routes->post('surat/belum-bekerja/preview', 'Masyarakat\SuratBelumBekerjaController::previewBelumBekerja');
    $routes->get('data-surat/belum_bekerja/download/(:num)', 'Masyarakat\SuratBelumBekerjaController::downloadSurat/$1');

    $routes->get('surat/kehilangan', 'Masyarakat\SuratKehilanganController::kehilangan');
    $routes->post('surat/kehilangan/ajukan', 'Masyarakat\SuratKehilanganController::ajukanKehilangan');
    $routes->post('surat/kehilangan/preview', 'Masyarakat\SuratKehilanganController::previewKehilangan');
     $routes->get('data-surat/kehilangan/download/(:num)', 'Masyarakat\SuratKehilanganController::downloadSurat/$1');

    $routes->get('surat/catatan-polisi', 'Masyarakat\SuratCatatanPolisiController::catatanPolisi');
    $routes->post('surat/catatan-polisi/ajukan', 'Masyarakat\SuratCatatanPolisiController::ajukanCatatanPolisi');
    $routes->post('surat/catatan-polisi/preview', 'Masyarakat\SuratCatatanPolisiController::previewCatatanPolisi');
    $routes->get('data-surat/catatan_polisi/download/(:num)', 'Masyarakat\SuratCatatanPolisiController::downloadSurat/$1');

    $routes->get('surat/kelahiran', 'Masyarakat\SuratKelahiranController::kelahiran');
    $routes->post('surat/kelahiran/ajukan', 'Masyarakat\SuratKelahiranController::ajukanKelahiran');
    $routes->post('surat/kelahiran/preview', 'Masyarakat\SuratKelahiranController::previewKelahiran');
    $routes->get('data-surat/kelahiran/download/(:num)', 'Masyarakat\SuratKelahiranController::downloadSurat/$1');

    $routes->get('surat/kematian', 'Masyarakat\SuratKematianController::kematian');
    $routes->post('surat/kematian/ajukan', 'Masyarakat\SuratKematianController::ajukanKematian');
    $routes->post('surat/kematian/preview', 'Masyarakat\SuratKematianController::previewKematian');
    $routes->get('data-surat/kematian/download/(:num)', 'Masyarakat\SuratKematianController::downloadSurat/$1');

    $routes->get('surat/ahli-waris', 'Masyarakat\SuratAhliWarisController::ahliWaris');
    $routes->post('surat/ahli-waris/ajukan', 'Masyarakat\SuratAhliWarisController::ajukanAhliWaris');
    $routes->post('surat/ahli-waris/preview', 'Masyarakat\SuratAhliWarisController::previewAhliWaris');
    $routes->get('data-surat/ahli_waris/download/(:num)', 'Masyarakat\SuratAhliWarisController::downloadSurat/$1');


    $routes->get('surat/suami-istri', 'Masyarakat\SuratSuamiIstriController::suamiIstri');
    $routes->post('surat/suami-istri/ajukan', 'Masyarakat\SuratSuamiIstriController::ajukanSuamiIstri');
    $routes->post('surat/suami-istri/preview', 'Masyarakat\SuratSuamiIstriController::previewSuamiIstri');
    $routes->get('data-surat/suami_istri/download/(:num)', 'Masyarakat\SuratSuamiIstriController::downloadSurat/$1');

    $routes->get('surat/status-perkawinan', 'Masyarakat\SuratStatusPerkawinanController::statusPerkawinan');
    $routes->post('surat/status-perkawinan/ajukan', 'Masyarakat\SuratStatusPerkawinanController::ajukanStatusPerkawinan');
    $routes->post('surat/status-perkawinan/preview', 'Masyarakat\SuratStatusPerkawinanController::previewStatusPerkawinan');
    $routes->get('data-surat/status_perkawinan/download/(:num)', 'Masyarakat\SuratStatusPerkawinanController::downloadSurat/$1');


    // Data Surat
    $routes->get('data-surat', 'Masyarakat\DataSuratController::dataSurat');
    $routes->get('data-surat/batal/(:num)', 'Masyarakat\DataSuratController::suratBatal/$1');
});


