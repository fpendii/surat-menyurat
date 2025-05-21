<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratSuamiIstriController extends BaseController
{
    public function suamiIstri()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-suami-istri');
    }

    public function previewSuamiIstri()
    {
        $data = [
            'nama_suami' => $this->request->getPost('nama_suami'),
            'nik_suami' => $this->request->getPost('nik_suami'),
            'ttl_suami' => $this->request->getPost('ttl_suami'),
            'agama_suami' => $this->request->getPost('agama_suami'),
            'alamat_suami' => $this->request->getPost('alamat_suami'),
            'nama_istri' => $this->request->getPost('nama_istri'),
            'nik_istri' => $this->request->getPost('nik_istri'),
            'ttl_istri' => $this->request->getPost('ttl_istri'),
            'agama_istri' => $this->request->getPost('agama_istri'),
            'alamat_istri' => $this->request->getPost('alamat_istri')
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_suami_istri', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_suami_istri.pdf', ['Attachment' => false]); // true = download, false
        // tampil di browser
        exit();
    }

    public function ajukanSuamiIstri()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $validationRules = [
            'nama_suami'    => 'required',
            'nik_suami'     => 'required|numeric|exact_length[16]',
            'ttl_suami'     => 'required',
            'agama_suami'   => 'required',
            'alamat_suami'  => 'required',
            'nama_istri'    => 'required',
            'nik_istri'     => 'required|numeric|exact_length[16]',
            'ttl_istri'     => 'required',
            'agama_istri'   => 'required',
            'alamat_istri'  => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/masyarakat/surat/suami-istri')->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // Simpan ke tabel surat (misal ada kolom jenis_surat dan created_at)
        $suratModel = new \App\Models\SuratModel();

        $suratData = [
            'id_user' => 1,
            'no_surat' => 'SS-' . date('YmdHis'),
            'jenis_surat' => 'suami_istri',
            'status' => 'diajukan'
        ];

        $suratModel->insert($suratData);
        $suratId = $suratModel->getInsertID();

        // Simpan ke tabel suami_istri, dengan relasi ke surat via surat_id
        $suamiIstriModel = new \App\Models\SuamiIstriModel();

        $suamiIstriData = [
            'id_surat'      => $suratId,
            'nama_suami'    => $this->request->getPost('nama_suami'),
            'nik_suami'     => $this->request->getPost('nik_suami'),
            'ttl_suami'     => $this->request->getPost('ttl_suami'),
            'agama_suami'   => $this->request->getPost('agama_suami'),
            'alamat_suami'  => $this->request->getPost('alamat_suami'),
            'nama_istri'    => $this->request->getPost('nama_istri'),
            'nik_istri'     => $this->request->getPost('nik_istri'),
            'ttl_istri'     => $this->request->getPost('ttl_istri'),
            'agama_istri'   => $this->request->getPost('agama_istri'),
            'alamat_istri'  => $this->request->getPost('alamat_istri'),
        ];

        $suamiIstriModel->insert($suamiIstriData);

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengajukan surat. Silakan coba lagi.');
        }

        return redirect()->to('/masyarakat/surat/')->with('success', 'Pengajuan surat suami istri berhasil diajukan.');
    }
}
