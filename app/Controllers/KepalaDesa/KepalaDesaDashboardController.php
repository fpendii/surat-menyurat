<?php

namespace App\Controllers\KepalaDesa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel; // Import the SuratModel
use CodeIgniter\I18n\Time; // Import the Time class for date handling

class KepalaDesaDashboardController extends BaseController
{
    public function index()
    {
        $suratModel = new SuratModel(); // Create an instance of your SuratModel

        // Get today's date for filtering
        $today = Time::today('Asia/Makassar')->toDateString(); // Specify timezone for accuracy (WITA is Asia/Makassar)

        // Total number of applications submitted today
        $totalSuratDiajukanHariIni = $suratModel
                                        ->where('created_at >=', $today . ' 00:00:00')
                                        ->where('created_at <=', $today . ' 23:59:59')
                                        ->countAllResults();

        // Total number of approved applications
        $totalSuratDiAcc = $suratModel
                                ->where('status_surat', 'selesai') // Ensure 'disetujui' matches your database status
                                ->countAllResults();

        // Prepare data to be sent to the view
        $data = [
            'totalSuratDiajukanHariIni' => $totalSuratDiajukanHariIni,
            'totalSuratDiAcc' => $totalSuratDiAcc,
        ];

        // Load the dashboard view and pass the data
        return view('kepala-desa/dashboard/dashboard', $data);
    }
}