<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratBelumBekerjaController extends BaseController
{
    public function belumBekerja()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-belum-bekerja');
    }

    public function previewBelumBekerja()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'status_pekerjaan' => $this->request->getPost('status_pekerjaan'),
            'warga_negara' => $this->request->getPost('warga_negara'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_belum_bekerja', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_belum_bekerja.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanBelumBekerja()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'ttl' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_pekerjaan' => 'required',
            'warga_negara' => 'required',
            'alamat' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/masyarakat/surat/belum-bekerja')->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'status_pekerjaan' => $this->request->getPost('status_pekerjaan'),
            'warga_negara' => $this->request->getPost('warga_negara'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        // Simpan ke tabel `surat`
        $suratModel = new \App\Models\SuratModel();
        $suratData = [
            'id_user' => 1,
            'no_surat' => 'BB-' . date('YmdHis'),
            'jenis_surat' => 'belum_bekerja',
            'status' => 'diajukan'
        ];
        $suratModel->insert($suratData);
        $idSurat = $suratModel->getInsertID();

        // Simpan ke tabel `surat_belum_bekerja`
        $detailModel = new \App\Models\SuratBelumBekerjaModel();
        $data['id_surat'] = $idSurat;
        $detailModel->insert($data);

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat berhasil diajukan.');
    }
}
