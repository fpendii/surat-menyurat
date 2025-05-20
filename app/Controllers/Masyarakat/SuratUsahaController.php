<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratUsahaController extends BaseController
{
    public function usaha()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-usaha');
    }

    public function previewUsaha()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'rt_rw' => $this->request->getPost('rt_rw'),
            'desa' => $this->request->getPost('desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'provinsi' => $this->request->getPost('provinsi'),
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'alamat_usaha' => $this->request->getPost('alamat_usaha'),
            'sejak_tahun' => $this->request->getPost('sejak_tahun'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_usaha', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_keterangan_usaha.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanUsaha()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'sejak_tahun' => 'required|numeric|exact_length[4]',
            'kk' => 'uploaded[kk]|max_size[kk,2048]|mime_in[kk,image/jpg,image/jpeg,image/png,application/pdf]',
            'ktp' => 'uploaded[ktp]|max_size[ktp,2048]|mime_in[ktp,image/jpg,image/jpeg,image/png,application/pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userId = 1; // Ambil dari session login seharusnya

        $kk = $this->request->getFile('kk');
        $ktp = $this->request->getFile('ktp');

        $kkName = $kk->getRandomName();
        $ktpName = $ktp->getRandomName();

        $kk->move('uploads/kk/', $kkName);
        $ktp->move('uploads/ktp/', $ktpName);

        // Simpan data ke tabel surat dulu
        $suratModel = new \App\Models\SuratModel();

        $idSurat = $suratModel->insert([
            'id_user' => $userId,
            'no_surat' => 'US-' . date('YmdHis'),
            'jenis_surat' => 'usaha',
            'status' => 'diajukan'
        ]);

        // Simpan data detail surat usaha
        $usahaModel = new \App\Models\SuratUsahaModel();

        $usahaModel->insert([
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'rt_rw' => $this->request->getPost('rt_rw'),
            'desa' => $this->request->getPost('desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'provinsi' => $this->request->getPost('provinsi'),
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'alamat_usaha' => $this->request->getPost('alamat_usaha'),
            'sejak_tahun' => $this->request->getPost('sejak_tahun'),
            'kk' => $kkName,
            'ktp' => $ktpName,
        ]);

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }
}
