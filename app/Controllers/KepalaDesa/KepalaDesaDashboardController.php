<?php

namespace App\Controllers\KepalaDesa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KepalaDesaDashboardController extends BaseController
{
    public function index()
    {
        return view('kepala-desa/dashboard/dashboard');
    }
    
}
