<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel; // Assuming you have a SuratModel

class MasyarakatDashboardController extends BaseController
{
    public function index()
    {
        $suratModel = new SuratModel(); // Instantiate your SuratModel

        // Get the current date in 'YYYY-MM-DD' format
        $today = date('Y-m-d');

        // Total surat diajukan hari ini
        $totalSuratDiajukanHariIni = $suratModel
            ->where('id_user', session()->get('user_id'))
            ->countAllResults();

        // Total surat sedang direvisi (assuming 'direvisi' is a status)
        $totalSuratDirevisi = $suratModel->where('status_surat', 'direvisi')
            ->where('id_user', session()->get('user_id'))
            ->countAllResults();

        // Total surat selesai (assuming 'selesai' is a status_surat)
        $totalSuratSelesai = $suratModel->where('status_surat', 'selesai')
            ->where('id_user', session()->get('user_id'))
            ->countAllResults();

        $data = [
            'totalSuratDiajukanHariIni' => $totalSuratDiajukanHariIni,
            'totalSuratDirevisi'        => $totalSuratDirevisi,
            'totalSuratSelesai'         => $totalSuratSelesai,
        ];

        return view('masyarakat/dashboard/index', $data);
    }
}
