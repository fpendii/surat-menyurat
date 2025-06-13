<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DisposisiController extends BaseController
{
    public function index()
{
    $disposisiModel = new \App\Models\DisposisiModel();
    $userId = session()->get('user_id');

    // misal kolom diteruskan_kepada berisi id_user pegawai
    $data['disposisiList'] = $disposisiModel
        ->where('diteruskan_kepada', $userId)
        ->orderBy('tanggal_diterima', 'DESC')
        ->findAll();

    return view('pegawai/disposisi/index', $data);
}

}
