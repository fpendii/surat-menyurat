<?php

namespace App\Controllers\KepalaDesa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel; 
use CodeIgniter\I18n\Time; 
use App\Models\SuratMasukModel;
use App\Models\DisposisiModel; 

class KepalaDesaDashboardController extends BaseController
{
     protected $suratMasukModel;
    protected $suratKeluarModel; // Variabel untuk model Surat Keluar
    protected $disposisiModel;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
        $this->suratKeluarModel = new SuratModel(); // Asumsi nama model Surat Keluar adalah SuratModel
        $this->disposisiModel = new DisposisiModel();
    }

    public function index()
    {
        // Mendapatkan total surat masuk
        $totalSuratMasuk = $this->suratMasukModel->countAllResults();

        // Mendapatkan total surat keluar
        $totalSuratKeluar = $this->suratKeluarModel->countAllResults();

        // Mendapatkan jumlah surat masuk yang menunggu disposisi
        // Logika: Cari ID surat masuk yang SUDAH ada di tabel disposisi
        $idsDisposed = $this->disposisiModel->select('id_surat_masuk')->findAll();
        $disposedIdsArray = array_column($idsDisposed, 'id_surat_masuk');

        // Kemudian hitung semua surat masuk dan kurangi dengan yang sudah didisposisi
        // Atau, lebih efisien, hitung surat masuk yang ID-nya TIDAK ada di daftar disposedIdsArray
        if (empty($disposedIdsArray)) {
            // Jika belum ada disposisi sama sekali, semua surat masuk dianggap belum didisposisi
            $suratMenungguDisposisi = $totalSuratMasuk;
        } else {
            // Hitung surat masuk yang id_surat_masuk-nya tidak ada di array id yang sudah didisposisi
            $suratMenungguDisposisi = $this->suratMasukModel
                                            ->whereNotIn('id_surat_masuk', $disposedIdsArray)
                                            ->countAllResults();
        }


        $data = [
            'title'                 => 'Dashboard Kepala Desa',
            'total_surat_masuk'     => $totalSuratMasuk,
            'total_surat_keluar'    => $totalSuratKeluar,
            'surat_menunggu_disposisi' => $suratMenungguDisposisi,
        ];

        return view('kepala-desa/dashboard/dashboard', $data);
    }
}