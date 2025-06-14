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

    public function detail($id)
{
    $disposisiModel = new \App\Models\DisposisiModel();

    $disposisi = $disposisiModel
       
        ->join('surat_masuk', 'surat_masuk.id_surat_masuk = disposisi.id_surat_masuk')
        ->where('disposisi.id_disposisi', $id)
        ->first();

    if (!$disposisi) {
        return redirect()->back()->with('error', 'Disposisi tidak ditemukan.');
    }

    // Cek apakah disposisi ini ditujukan kepada pegawai ini
    if ($disposisi['diteruskan_kepada'] != session()->get('user_id')) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke disposisi ini.');
    }

    $data['disposisi'] = $disposisi;

    return view('pegawai/disposisi/detail', $data);
}

}
