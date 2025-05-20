<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratTidakMampuController extends BaseController
{
    public function tidakMampu()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-tidak-mampu');
    }

    public function previewTidakMampu()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'bin_binti' => $this->request->getPost('bin_binti'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'keperluan' => $this->request->getPost('keperluan'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_tidak_mampu', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_tidak_mampu.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanTidakMampu()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'bin_binti' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'ttl' => 'required',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            'ktp' => 'uploaded[ktp]|mime_in[ktp,image/jpeg,image/png,application/pdf]|max_size[ktp,2048]',
            'kk' => 'uploaded[kk]|mime_in[kk,image/jpeg,image/png,application/pdf]|max_size[kk,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $ktpFile = $this->request->getFile('ktp');
        $kkFile = $this->request->getFile('kk');

        $ktpName = $ktpFile->getRandomName();
        $kkName = $kkFile->getRandomName();

        $ktpFile->move(WRITEPATH . 'uploads/surat_tidak_mampu/', $ktpName);
        $kkFile->move(WRITEPATH . 'uploads/surat_tidak_mampu/', $kkName);

        // Ambil ID user dari session login
        $userId = 1;

        // Simpan ke tabel `surat`
        $suratModel = new \App\Models\SuratModel();

        $idSurat = $suratModel->insert([
             'id_user' => $userId,
            'no_surat' => 'TM-' . date('YmdHis'),
            'jenis_surat' => 'tidak_mampu',
            'status' => 'diajukan'
        ], true); // 'true' agar return ID yang baru disisipkan

        // Simpan ke tabel `surat_tidak_mampu`
        $tidakMampuModel = new \App\Models\SuratTidakMampuModel();

        $tidakMampuModel->insert([
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'bin_binti' => $this->request->getPost('bin_binti'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'keperluan' => $this->request->getPost('keperluan'),
            'ktp' => $ktpName,
            'kk' => $kkName,
        ]);

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }
}
