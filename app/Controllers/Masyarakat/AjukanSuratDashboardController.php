<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AjukanSuratDashboardController extends BaseController
{
    public function index()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili');
    }
}
