<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MasyarakatDashboardController extends BaseController
{
    public function index()
    {
        return view('masyarakat/dashboard/index');
    }
}
