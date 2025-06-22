<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PegawaiDashboardController extends BaseController
{
    public function index()
    {
        // Mendapatkan total disposisi yang diterima oleh pegawai
        $disposisiModel = new \App\Models\DisposisiModel();
        $userId = session()->get('user_id');
        $totalDisposisi = $disposisiModel->where('id_user', $userId)->countAllResults();

        $data = [
            'totalDisposisi' => $totalDisposisi,
        ];
        return view('pegawai/dashboard/index', $data);
    }
}
