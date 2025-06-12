<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'AuthController::login');
$routes->get('login', 'AuthController::login');
$routes->post('login/proses', 'AuthController::loginProses');
$routes->get('register', 'AuthController::register');

$routes->post('register/proses', 'AuthController::registerProses');
$routes->get('/unauthorized', 'AuthController::unauthorized');
$routes->get('logout', 'AuthController::logout');



$routes->get('aktivasi/(:segment)', 'AuthController::aktivasi/$1');


// Group khusus masyarakat
$routes->group('masyarakat', function ($routes) {
    // Dashboard Masyarakat
    $routes->get('dashboard', 'Masyarakat\MasyarakatDashboardController::index');
    $routes->get('surat', 'Masyarakat\SuratController::surat');

    // Surat-surat spesifik
    $routes->get('surat/domisili-kelompok-tani', 'Masyarakat\SuratKelompokTaniController::domisiliKelompokTani');
    $routes->post('surat/domisili-kelompok-tani/ajukan', 'Masyarakat\SuratKelompokTaniController::ajukanDomisiliKelompokTani');
    $routes->post('surat/domisili-kelompok-tani/preview', 'Masyarakat\SuratKelompokTaniController::previewDomisiliKelompokTani');
    $routes->get('data-surat/domisili_kelompok_tani/download/(:num)', 'Masyarakat\SuratKelompokTaniController::downloadSurat/$1');
    $routes->get('data-surat/domisili_kelompok_tani/edit/(:num)', 'Masyarakat\SuratKelompokTaniController::editSurat/$1');
    $routes->post('surat/domisili_kelompok_tani/update/(:num)', 'Masyarakat\SuratKelompokTaniController::updateSurat/$1');

    $routes->get('surat/domisili-bangunan', 'Masyarakat\SuratDomisiliBangunanController::domisiliBangunan');
    $routes->post('surat/domisili-bangunan/ajukan', 'Masyarakat\SuratDomisiliBangunanController::ajukanDomisiliBangunan');
    $routes->post('surat/domisili-bangunan/preview', 'Masyarakat\SuratDomisiliBangunanController::previewDomisiliBangunan');
    $routes->get('data-surat/domisili_bangunan/download/(:num)', 'Masyarakat\SuratDomisiliBangunanController::downloadSurat/$1');
    $routes->get('data-surat/domisili_bangunan/edit/(:num)', 'Masyarakat\SuratDomisiliBangunanController::editSurat/$1');
    $routes->post('data-surat/domisili_bangunan/update/(:num)', 'Masyarakat\SuratDomisiliBangunanController::updateSurat/$1');


    $routes->get('surat/domisili-warga', 'Masyarakat\SuratDomisiliWargaController::domisiliWarga');
    $routes->post('surat/domisili-warga/ajukan', 'Masyarakat\SuratDomisiliWargaController::ajukanDomisiliWarga');
    $routes->post('surat/domisili-warga/preview', 'Masyarakat\SuratDomisiliWargaController::previewDomisiliWarga');
    $routes->get('data-surat/domisili_warga/download/(:num)', 'Masyarakat\SuratDomisiliWargaController::downloadSurat/$1');
    $routes->get('data-surat/domisili_warga/edit/(:num)', 'Masyarakat\SuratDomisiliWargaController::editSurat/$1');
    $routes->post('surat/domisili-warga/update/(:num)', 'Masyarakat\SuratDomisiliWargaController::updateSurat/$1');

    $routes->get('surat/pindah', 'Masyarakat\SuratPindahController::pindah');
    $routes->post('surat/pindah/ajukan', 'Masyarakat\SuratPindahController::ajukanPindah');
    $routes->post('surat/pindah/preview', 'Masyarakat\SuratPindahController::previewPindah');
    $routes->get('data-surat/surat-pindah/download/(:num)', 'Masyarakat\SuratPindahController::downloadSurat/$1');
    $routes->get('data-surat/surat-pindah/edit/(:num)', 'Masyarakat\SuratPindahController::editSurat/$1');
    $routes->put('surat/pindah/update/(:num)', 'Masyarakat\SuratPindahController::updateSurat/$1');

    $routes->get('surat/usaha', 'Masyarakat\SuratUsahaController::usaha');
    $routes->post('surat/usaha/ajukan', 'Masyarakat\SuratUsahaController::ajukanUsaha');
    $routes->post('surat/usaha/preview', 'Masyarakat\SuratUsahaController::previewUsaha');
    $routes->get('data-surat/usaha/download/(:num)', 'Masyarakat\SuratUsahaController::downloadSurat/$1');
    $routes->get('data-surat/usaha/edit/(:num)', 'Masyarakat\SuratUsahaController::editSurat/$1');
    $routes->put('surat/usaha/update/(:num)', 'Masyarakat\SuratUsahaController::updateSurat/$1');

    $routes->get('surat/pengantar-kk-ktp', 'Masyarakat\SuratPengantarKKKTPController::pengantarKKKTP');
    $routes->post('surat/pengantar-kk-ktp/ajukan', 'Masyarakat\SuratPengantarKKKTPController::ajukanPengantarKKKTP');
    $routes->post('surat/pengantar-kk-ktp/preview', 'Masyarakat\SuratPengantarKKKTPController::previewPengantarKKKTP');
    $routes->get('data-surat/pengantar_kk_ktp/download/(:num)', 'Masyarakat\SuratPengantarKKKTPController::downloadSurat/$1');
    $routes->get('data-surat/pengantar_kk_ktp/edit/(:num)', 'Masyarakat\SuratPengantarKKKTPController::editSurat/$1');
    $routes->post('surat/pengantar-kk-ktp/update/(:num)', 'Masyarakat\SuratPengantarKKKTPController::updateSurat/$1');

    $routes->get('surat/tidak-mampu', 'Masyarakat\SuratTidakMampuController::tidakMampu');
    $routes->post('surat/tidak-mampu/ajukan', 'Masyarakat\SuratTidakMampuController::ajukanTidakMampu');
    $routes->post('surat/tidak-mampu/preview', 'Masyarakat\SuratTidakMampuController::previewTidakMampu');
    $routes->get('data-surat/tidak_mampu/download/(:num)', 'Masyarakat\SuratTidakMampuController::downloadSurat/$1');
    $routes->get('data-surat/tidak_mampu/edit/(:num)', 'Masyarakat\SuratTidakMampuController::editSurat/$1');
    $routes->put('surat/tidak-mampu/update/(:num)', 'Masyarakat\SuratTidakMampuController::updateSurat/$1');

    $routes->get('surat/belum-bekerja', 'Masyarakat\SuratBelumBekerjaController::belumBekerja');
    $routes->post('surat/belum-bekerja/ajukan', 'Masyarakat\SuratBelumBekerjaController::ajukanBelumBekerja');
    $routes->post('surat/belum-bekerja/preview', 'Masyarakat\SuratBelumBekerjaController::previewBelumBekerja');
    $routes->get('data-surat/belum_bekerja/download/(:num)', 'Masyarakat\SuratBelumBekerjaController::downloadSurat/$1');
    $routes->get('data-surat/belum_bekerja/edit/(:num)', 'Masyarakat\SuratBelumBekerjaController::editSurat/$1');
    $routes->put('surat/belum-bekerja/update/(:num)', 'Masyarakat\SuratBelumBekerjaController::updateSurat/$1');

    $routes->get('surat/kehilangan', 'Masyarakat\SuratKehilanganController::kehilangan');
    $routes->post('surat/kehilangan/ajukan', 'Masyarakat\SuratKehilanganController::ajukanKehilangan');
    $routes->post('surat/kehilangan/preview', 'Masyarakat\SuratKehilanganController::previewKehilangan');
    $routes->get('data-surat/kehilangan/download/(:num)', 'Masyarakat\SuratKehilanganController::downloadSurat/$1');
    $routes->get('data-surat/kehilangan/edit/(:num)', 'Masyarakat\SuratKehilanganController::editSurat/$1');
    $routes->post('surat/kehilangan/update/(:num)', 'Masyarakat\SuratKehilanganController::updateSurat/$1');

    $routes->get('surat/catatan-polisi', 'Masyarakat\SuratCatatanPolisiController::catatanPolisi');
    $routes->post('surat/catatan-polisi/ajukan', 'Masyarakat\SuratCatatanPolisiController::ajukanCatatanPolisi');
    $routes->post('surat/catatan-polisi/preview', 'Masyarakat\SuratCatatanPolisiController::previewCatatanPolisi');
    $routes->get('data-surat/catatan_polisi/download/(:num)', 'Masyarakat\SuratCatatanPolisiController::downloadSurat/$1');
    $routes->get('data-surat/catatan_polisi/edit/(:num)', 'Masyarakat\SuratCatatanPolisiController::editSurat/$1');
    $routes->post('surat/catatan-polisi/update/(:num)', 'Masyarakat\SuratCatatanPolisiController::updateSurat/$1');

    $routes->get('surat/kelahiran', 'Masyarakat\SuratKelahiranController::kelahiran');
    $routes->post('surat/kelahiran/ajukan', 'Masyarakat\SuratKelahiranController::ajukanKelahiran');
    $routes->post('surat/kelahiran/preview', 'Masyarakat\SuratKelahiranController::previewKelahiran');
    $routes->get('data-surat/kelahiran/download/(:num)', 'Masyarakat\SuratKelahiranController::downloadSurat/$1');
    $routes->get('data-surat/kelahiran/edit/(:num)', 'Masyarakat\SuratKelahiranController::editSurat/$1');
    $routes->post('surat/kelahiran/update/(:num)', 'Masyarakat\SuratKelahiranController::updateSurat/$1');

    $routes->get('surat/kematian', 'Masyarakat\SuratKematianController::kematian');
    $routes->post('surat/kematian/ajukan', 'Masyarakat\SuratKematianController::ajukanKematian');
    $routes->post('surat/kematian/preview', 'Masyarakat\SuratKematianController::previewKematian');
    $routes->get('data-surat/kematian/download/(:num)', 'Masyarakat\SuratKematianController::downloadSurat/$1');
    $routes->get('data-surat/kematian/edit/(:num)', 'Masyarakat\SuratKematianController::editSurat/$1');
    $routes->post('surat/kematian/update/(:num)', 'Masyarakat\SuratKematianController::updateSurat/$1');

    $routes->get('surat/ahli-waris', 'Masyarakat\SuratAhliWarisController::ahliWaris');
    $routes->post('surat/ahli-waris/ajukan', 'Masyarakat\SuratAhliWarisController::ajukanAhliWaris');
    $routes->post('surat/ahli-waris/preview', 'Masyarakat\SuratAhliWarisController::previewAhliWaris');
    $routes->get('data-surat/ahli_waris/download/(:num)', 'Masyarakat\SuratAhliWarisController::downloadSurat/$1');
    $routes->get('data-surat/ahli_waris/edit/(:num)', 'Masyarakat\SuratAhliWarisController::editSurat/$1');
    $routes->post('surat/ahli-waris/update/(:num)', 'Masyarakat\SuratAhliWarisController::updateSurat/$1');


    $routes->get('surat/suami-istri', 'Masyarakat\SuratSuamiIstriController::suamiIstri');
    $routes->post('surat/suami-istri/ajukan', 'Masyarakat\SuratSuamiIstriController::ajukanSuamiIstri');
    $routes->post('surat/suami-istri/preview', 'Masyarakat\SuratSuamiIstriController::previewSuamiIstri');
    $routes->get('data-surat/suami_istri/download/(:num)', 'Masyarakat\SuratSuamiIstriController::downloadSurat/$1');
    $routes->get('data-surat/suami_istri/edit/(:num)', 'Masyarakat\SuratSuamiIstriController::editSurat/$1');
    $routes->post('surat/suami-istri/update/(:num)', 'Masyarakat\SuratSuamiIstriController::updateSurat/$1');

    $routes->get('surat/status-perkawinan', 'Masyarakat\SuratStatusPerkawinanController::statusPerkawinan');
    $routes->post('surat/status-perkawinan/ajukan', 'Masyarakat\SuratStatusPerkawinanController::ajukanStatusPerkawinan');
    $routes->post('surat/status-perkawinan/preview', 'Masyarakat\SuratStatusPerkawinanController::previewStatusPerkawinan');
    $routes->get('data-surat/status_perkawinan/download/(:num)', 'Masyarakat\SuratStatusPerkawinanController::downloadSurat/$1');
    $routes->get('data-surat/status_perkawinan/edit/(:num)', 'Masyarakat\SuratStatusPerkawinanController::editSurat/$1');
    $routes->post('surat/status-perkawinan/update/(:num)', 'Masyarakat\SuratStatusPerkawinanController::updateSurat/$1');


    // Data Surat
    $routes->get('data-surat', 'Masyarakat\DataSuratController::dataSurat');
    $routes->get('data-surat/batal/(:num)', 'Masyarakat\DataSuratController::suratBatal/$1');

    //arsip surat
    $routes->get('arsip-surat', 'Masyarakat\ArsipSuratController::arsipSurat');
    $routes->get('arsip-surat/selesai/download/(:num)', 'Masyarakat\ArsipSuratController::downloadSurat/$1');
});


// Group khusus kepala desa
$routes->group('kepala-desa', function ($routes) {
    // Dashboard Kepala Desa
    $routes->get('dashboard', 'KepalaDesa\KepalaDesaDashboardController::index');
    $routes->get('pengajuan-surat', 'KepalaDesa\PengajuanSuratController::pengajuanSurat');
    $routes->get('pengajuan-surat/(:num)', 'KepalaDesa\PengajuanSuratController::detailSurat/$1');
    $routes->post('pengajuan-surat/konfirmasi/(:num)', 'KepalaDesa\PengajuanSuratController::konfirmasiSurat/$1');
    $routes->get('pengajuan-surat/revisi/(:num)', 'KepalaDesa\PengajuanSuratController::revisiSurat/$1');
    $routes->post('pengajuan-surat/kirim-revisi/(:num)', 'KepalaDesa\PengajuanSuratController::kirimRevisi/$1');
});

// // Group khusus kepala desa
// $routes->group('kepala-desa', function($routes) {
//     // Dashboard Kepala Desa
//     $routes->get('dashboard', 'KepalaDesa\KepalaDesaDashboardController::index');
//     $routes->get('pengajuan-surat', 'KepalaDesa\PengajuanSuratController::pengajuanSurat');
//     $routes->get('pengajuan-surat/(:num)', 'KepalaDesa\PengajuanSuratController::detailSurat/$1');
//     $routes->post('pengajuan-surat/konfirmasi/(:num)', 'KepalaDesa\PengajuanSuratController::konfirmasiSurat/$1');
//     $routes->get('pengajuan-surat/revisi/(:num)', 'KepalaDesa\PengajuanSuratController::revisiSurat/$1');
//     $routes->post('pengajuan-surat/kirim-revisi/(:num)', 'KepalaDesa\PengajuanSuratController::kirimRevisi/$1');
// });

// Group khusus admin
$routes->group('admin', function ($routes) {
    // Dashboard Kepala Desa
    $routes->get('dashboard', 'Admin\AdminDashboardController::index');
    $routes->get('pengajuan-surat', 'Admin\PengajuanSuratController::pengajuanSurat');
    $routes->post('kirim-surat/(:num)', 'Admin\PengajuanSuratController::kirimSurat/$1');

    $routes->get('surat-masuk', 'Admin\SuratMasukController::index');
    $routes->get('surat-masuk/tambah', 'Admin\SuratMasukController::tambah');
    $routes->post('surat-masuk/simpan', 'Admin\SuratMasukController::simpan');
    $routes->post('surat-masuk/hapus/(:num)', 'Admin\SuratMasukController::hapus/$1');
});
