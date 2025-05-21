<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratStatusPerkawinanController extends BaseController
{
    public function statusPerkawinan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-status-perkawinan');
    }

    public function previewStatusPerkawinan()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'status' => $this->request->getPost('status'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_status_perkawinan', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_status_perkawinan.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanStatusPerkawinan()
    {
        // Validasi input
        $validationRules = [
            'nama'    => 'required|max_length[100]',
            'nik'     => 'required|numeric',
            'ttl'     => 'required|max_length[100]',
            'agama'   => 'required',
            'alamat'  => 'required',
            'status'  => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/masyarakat/surat/status-perkawinan')->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $suratModel = new \App\Models\SuratModel();
        $statusPerkawinanModel = new \App\Models\SuratStatusPerkawinanModel();

        // Transaksi agar data konsisten
        $db->transStart();

        // Simpan data ke tabel surat
        $suratData = [
            'id_user' => 1,
            'no_surat' => 'SP-' . date('YmdHis'),
            'jenis_surat' => 'status_perkawinan',
            'status' => 'diajukan',
        ];
        $suratModel->insert($suratData);
        $idSurat = $suratModel->getInsertID();

        // Simpan data ke tabel surat_status_perkawinan
        $statusPerkawinanData = [
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'status' => $this->request->getPost('status'),
        ];
        $statusPerkawinanModel->insert($statusPerkawinanData);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat berhasil diajukan.');
    }
}
