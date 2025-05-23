<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel;

class ArsipSuratController extends BaseController
{
    protected $suratModel;
    public function __construct()
    {
        $this->suratModel = new SuratModel();
    }
    public function arsipSurat()
    {
        $id_user = 1;
        // Ambil data surat dari model
        $dataSurat = $this->suratModel->where('status_surat', 'selesai')->where('id_user', $id_user)->findAll(); 
        $data = [
            'dataSurat' => $dataSurat,
        ];
        return view('masyarakat/arsip-surat/arsip-surat', $data);   
    }

    public function downloadSurat($id_surat)
    {
        // Ambil data surat dari model
        $dataSurat = $this->suratModel->find($id_surat);

        if ($dataSurat) {
            // Set header untuk download file
            return $this->response->download('uploads/surat_dikirim/' . $dataSurat['file_surat'], null)->setFileName($dataSurat['file_surat']);
        } else {
            return redirect()->to('/masyarakat/arsip-surat')->with('error', 'Data surat tidak ditemukan.');
        }
    }
}
