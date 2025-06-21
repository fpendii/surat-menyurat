<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratMasukModel;
use App\Models\SuratModel;

class ArsipSuratAdmin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Arsip Surat',
            'surat_masuk' => (new SuratMasukModel())->findAll(),
            'surat_keluar' => (new SuratModel())->where('status_surat', 'selesai')->findAll(),
        ];

        return view('admin/arsip_surat/index', $data);
    }
}
