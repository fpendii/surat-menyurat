<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratMasukModel;

class SuratMasukController extends BaseController
{
    public function index()
    {
        $model = new SuratMasukModel();
        $data['surat_masuk'] = $model->findAll();

        return view('admin/surat-masuk/index', $data);
    }

    public function tambah()
    {
        return view('admin/surat-masuk/tambah');
    }

    public function simpan()
    {
        $file = $this->request->getFile('file_surat');
        $jenis = $this->request->getPost('jenis_surat');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/surat_masuk', $newName);

            $model = new SuratMasukModel();
            $model->save([
                'jenis_surat' => $jenis,
                'file_surat' => $newName,
            ]);

            return redirect()->to('/admin/surat-masuk')->with('success', 'Surat masuk berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah surat.');
    }

    public function hapus($id)
{
    $model = new \App\Models\SuratMasukModel();

    // Ambil data surat
    $surat = $model->find($id);
    if ($surat) {
        // Hapus file dari folder jika ada
        $filePath = WRITEPATH . '../public/uploads/surat_masuk/' . $surat['file_surat'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus dari database
        $model->delete($id);
        return redirect()->to(site_url('admin/surat-masuk'))->with('success', 'Surat berhasil dihapus.');
    }

    return redirect()->to(site_url('admin/surat-masuk'))->with('error', 'Surat tidak ditemukan.');
}

}

