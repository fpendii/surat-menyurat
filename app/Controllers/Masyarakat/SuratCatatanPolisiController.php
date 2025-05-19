<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratCatatanPolisiController extends BaseController
{
    public function catatanPolisi()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-catatan-polisi');
    }

    public function previewCatatanPolisi()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_tanggal_lahir' => $this->request->getPost('tempat_tanggal_lahir'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_catatan_polisi', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_catatan_polisi.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanCatatanPolisi()
    {
        
        $validation = \Config\Services::validation();
        $userId = 1; // Ambil ID user dari session login

        $valid = $this->validate([
            'kk' => 'uploaded[kk]|max_size[kk,2048]|mime_in[kk,image/jpg,image/jpeg,image/png,application/pdf]',
            'ktp' => 'uploaded[ktp]|max_size[ktp,2048]|mime_in[ktp,image/jpg,image/jpeg,image/png,application/pdf]',
            'akta_lahir' => 'uploaded[akta_lahir]|max_size[akta_lahir,2048]|mime_in[akta_lahir,image/jpg,image/jpeg,image/png,application/pdf]',
            'ijazah' => 'uploaded[ijazah]|max_size[ijazah,2048]|mime_in[ijazah,image/jpg,image/jpeg,image/png,application/pdf]',
            'foto_latar_belakang' => 'uploaded[foto_latar_belakang]|max_size[foto_latar_belakang,2048]|mime_in[foto_latar_belakang,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$valid) {
            return redirect()->to('masyarakat/surat/catatan-polisi')->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan dulu data surat umum ke tabel surat dan dapatkan id_surat
        $suratData = [
            'id_user' => $userId,
            'no_surat' => 'CP-' . date('YmdHis'),
            'jenis_surat' => 'catatan_polisi',
            'status' => 'diajukan'
        ];

        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert($suratData);

        if (!$idSurat) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data surat.');
        }

        $berkasPath = WRITEPATH . 'uploads/surat_catatan_polisi/';
        if (!is_dir($berkasPath)) {
            mkdir($berkasPath, 0777, true);
        }

        // Upload file & simpan nama file-nya saja
        $kkFile = $this->request->getFile('kk');
        $kkName = $kkFile->getRandomName();
        $kkFile->move($berkasPath, $kkName);

        $ktpFile = $this->request->getFile('ktp');
        $ktpName = $ktpFile->getRandomName();
        $ktpFile->move($berkasPath, $ktpName);

        $aktaFile = $this->request->getFile('akta_lahir');
        $aktaName = $aktaFile->getRandomName();
        $aktaFile->move($berkasPath, $aktaName);

        $ijazahFile = $this->request->getFile('ijazah');
        $ijazahName = $ijazahFile->getRandomName();
        $ijazahFile->move($berkasPath, $ijazahName);

        $fotoFile = $this->request->getFile('foto_latar_belakang');
        $fotoName = $fotoFile->getRandomName();
        $fotoFile->move($berkasPath, $fotoName);

        $catatanPolisiData = [
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_tanggal_lahir' => $this->request->getPost('tempat_tanggal_lahir'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'kk' => $kkName,
            'ktp' => $ktpName,
            'akta_lahir' => $aktaName,
            'ijazah' => $ijazahName,
            'foto_latar_belakang' => $fotoName,
        ];

        $catatanPolisiModel = new \App\Models\CatatanPolisiModel();

        if (!$catatanPolisiModel->insert($catatanPolisiData)) {
            // Jika gagal simpan, rollback hapus surat juga
            $suratModel->delete($idSurat);
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data surat catatan polisi.');
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat Catatan Polisi berhasil diajukan.');
    }
}
