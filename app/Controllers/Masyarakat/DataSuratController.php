<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratPindahModel;
use App\Models\PengikutPindahModel;
use App\Models\SuratModel;

class DataSuratController extends BaseController
{
    protected $suratPindahModel;
    protected $pengikutPindahModel;
    protected $suratModel;
    public function __construct()
    {
        $this->suratModel = new SuratModel();
        $this->suratPindahModel = new SuratPindahModel();
        $this->pengikutPindahModel = new PengikutPindahModel();
    }
    public function dataSurat()
    {
        // Ambil data surat dari model
        $dataSurat = $this->suratModel->findAll();
        $data = [
            'dataSurat' => $dataSurat,
        ];
        return view('masyarakat/data-surat/data-surat', $data);
    }

    public function suratBatal($id_surat)
    {
        // Ambil data surat dari model
        $dataSurat = $this->suratModel->find($id_surat);

        if ($dataSurat) {
            // Hapus surat dari database
            $this->suratModel->delete($id_surat);

            return redirect()->to('/masyarakat/data-surat')->with('success', 'Pengajuan surat berhasil dibatalkan.');
        } else {
            return redirect()->to('/masyarakat/data-surat')->with('error', 'Data surat tidak ditemukan.');
        }
    }
}
