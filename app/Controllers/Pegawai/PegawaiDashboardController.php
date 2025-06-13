<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PegawaiDashboardController extends BaseController
{
    public function index()
    {
        return view('pegawai/dashboard/index');
    }
}
