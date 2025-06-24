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
        $totalSuratKeluar = $this->suratKeluarModel->where('status_surat', 'selesai')->countAllResults();

        // Mendapatkan jumlah surat masuk yang menunggu disposisi
        $idsDisposed = $this->disposisiModel->select('id_surat_masuk')->findAll();
        $disposedIdsArray = array_column($idsDisposed, 'id_surat_masuk');


        $data = [
            'title'                 => 'Dashboard Kepala Desa',
            'total_surat_masuk'     => $totalSuratMasuk,
            'total_surat_keluar'    => $totalSuratKeluar,
        ];

        return view('kepala-desa/dashboard/dashboard', $data);
    }
}
