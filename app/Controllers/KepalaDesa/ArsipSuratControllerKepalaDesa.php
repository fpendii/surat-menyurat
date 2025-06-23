<?php namespace App\Controllers\KepalaDesa;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel; // Import model Surat Masuk
use App\Models\SuratModel;     // Import model Surat Keluar (asumsi nama model Anda)
use CodeIgniter\HTTP\ResponseInterface; // Tetap sertakan jika diperlukan

class ArsipSuratControllerKepalaDesa extends BaseController
{
    protected $suratMasukModel;
    protected $suratKeluarModel;

    public function __construct()
    {
        // Inisialisasi model di konstruktor
        $this->suratMasukModel = new SuratMasukModel();
        $this->suratKeluarModel = new SuratModel(); // Ganti jika nama model surat keluar berbeda
    }

    public function index()
    {
        // Ambil semua data surat masuk
        $dataSuratMasuk = $this->suratMasukModel->findAll();

        // Ambil semua data surat keluar
        $dataSuratKeluar = $this->suratKeluarModel->findAll();

        $data = [
            'title'        => 'Arsip Surat Kepala Desa',
            'surat_masuk'  => $dataSuratMasuk,
            'surat_keluar' => $dataSuratKeluar,
        ];

        // Muat view arsip surat untuk kepala desa
        return view('kepala-desa/arsip-surat/index', $data);
    }
}