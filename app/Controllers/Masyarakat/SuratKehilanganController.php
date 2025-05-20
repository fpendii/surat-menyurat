<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratKehilanganController extends BaseController
{
    public function kehilangan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kehilangan');
    }

    public function previewKehilangan()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'nik' => $this->request->getPost('nik'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'barang_hilang' => $this->request->getPost('barang_hilang'),
            'keperluan' => $this->request->getPost('keperluan'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_kehilangan', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_kehilangan.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanKehilangan()
    {
        $validation = \Config\Services::validation();
        $userId = 1; // Ambil dari session login seharusnya

        // Validasi input
        $rules = [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'ttl' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'agama' => 'required',
            'alamat' => 'required',
            'barang_hilang' => 'required',
            'keperluan' => 'required',
            'kk' => 'uploaded[kk]|max_size[kk,2048]|ext_in[kk,jpg,jpeg,png,pdf]',
            'ktp' => 'uploaded[ktp]|max_size[ktp,2048]|ext_in[ktp,jpg,jpeg,png,pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data ke tabel surat
        $suratModel = new \App\Models\SuratModel();
        $suratData = [
            'id_user' => $userId,
            'no_surat' => 'KH-' . date('YmdHis'),
            'jenis_surat' => 'kehilangan',
            'status' => 'diajukan'
        ];

        $idSurat = $suratModel->insert($suratData);
        if (!$idSurat) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data surat.');
        }

        // Upload file
        $uploadPath = WRITEPATH . 'uploads/surat_kehilangan/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $ktp = $this->request->getFile('ktp');
        $kk = $this->request->getFile('kk');

        $ktpName = $ktp->getRandomName();
        $kkName = $kk->getRandomName();

        $ktp->move($uploadPath, $ktpName);
        $kk->move($uploadPath, $kkName);

        // Simpan data ke tabel kehilangan
        $kehilanganData = [
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'nik' => $this->request->getPost('nik'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'barang_hilang' => $this->request->getPost('barang_hilang'),
            'keperluan' => $this->request->getPost('keperluan'),
            'ktp' => $ktpName,
            'kk' => $kkName,
        ];

        $kehilanganModel = new \App\Models\SuratKehilanganModel();
        if (!$kehilanganModel->insert($kehilanganData)) {
            // rollback surat
            $suratModel->delete($idSurat);
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data kehilangan.');
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat Keterangan Kehilangan berhasil diajukan.');
    }
}
