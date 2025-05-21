<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SuratModel;
use App\Models\SuratAhliWarisModel;
use App\Models\AhliWarisModel;

class SuratAhliWarisController extends BaseController
{
    public function ahliWaris()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-ahli-waris');
    }

    public function previewAhliWaris()
    {
        $data = [
            'pemilik_harta' => $this->request->getPost('pemilik_harta'),
            'nama_ahli_waris' => $this->request->getPost('nama_ahli_waris'),
            'nik_ahli_waris' => $this->request->getPost('nik_ahli_waris'),
            'ttl_ahli_waris' => $this->request->getPost('ttl_ahli_waris'),
            'hubungan_ahli_waris' => $this->request->getPost('hubungan_ahli_waris')
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_ahli_waris', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_ahli_waris.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanAhliWaris()
    {
        helper(['form', 'url']);

        $userId = 1; // Ambil ID user dari session login
        $pemilikHarta = $this->request->getPost('pemilik_harta');
        $namaAhliWaris = $this->request->getPost('nama_ahli_waris');
        $nikAhliWaris = $this->request->getPost('nik_ahli_waris');
        $ttlAhliWaris = $this->request->getPost('ttl_ahli_waris');
        $hubunganAhliWaris = $this->request->getPost('hubungan_ahli_waris');

        // Upload surat nikah
        $suratNikah = $this->request->getFile('surat_nikah');
        $namaFileNikah = null;
        if ($suratNikah && $suratNikah->isValid() && !$suratNikah->hasMoved()) {
            $namaFileNikah = $suratNikah->getRandomName();
            $suratNikah->move(FCPATH . 'uploads/ahli_waris', $namaFileNikah);
        }

        // Simpan surat
        $suratModel = new SuratModel();
        $suratId = $suratModel->insert([
            'id_user' => $userId,
            'no_surat' => 'AW-' . date('YmdHis'),
            'jenis_surat' => 'ahli_waris',
            'status' => 'diajukan'
        ]);


        // Simpan ke tabel surat_ahli_waris
        $suratAhliWarisModel = new \App\Models\SuratAhliWarisModel();
        $idSuratAhliWaris = $suratAhliWarisModel->insert([
            'id_surat' => $suratId,
            'pemilik_harta' => $pemilikHarta,
            'surat_nikah' => $namaFileNikah,
            'status' => 'diproses'
        ]);

        // Simpan data ahli waris
        $ahliWarisModel = new \App\Models\AhliWarisModel();
        $jumlahAhliWaris = count($namaAhliWaris);

        for ($i = 0; $i < $jumlahAhliWaris; $i++) {
            $ktp = $this->request->getFileMultiple('ktp_ahli_waris')[$i] ?? null;
            $kk = $this->request->getFileMultiple('kk_ahli_waris')[$i] ?? null;
            $akta = $this->request->getFileMultiple('akta_lahir_ahli_waris')[$i] ?? null;

            $ktpName = $ktp && $ktp->isValid() && !$ktp->hasMoved() ? $ktp->getRandomName() : null;
            $kkName = $kk && $kk->isValid() && !$kk->hasMoved() ? $kk->getRandomName() : null;
            $aktaName = $akta && $akta->isValid() && !$akta->hasMoved() ? $akta->getRandomName() : null;

            if ($ktpName) $ktp->move(FCPATH . 'uploads/ahli_waris', $ktpName);
            if ($kkName) $kk->move(FCPATH . 'uploads/ahli_waris', $kkName);
            if ($aktaName) $akta->move(FCPATH . 'uploads/ahli_waris', $aktaName);

            $ahliWarisModel->insert([
                'id_surat_ahli_waris' => $idSuratAhliWaris,
                'nama' => $namaAhliWaris[$i],
                'nik' => $nikAhliWaris[$i],
                'ttl' => $ttlAhliWaris[$i],
                'hubungan' => $hubunganAhliWaris[$i],
                'file_ktp' => $ktpName,
                'file_kk' => $kkName,
                'file_akta_lahir' => $aktaName
            ]);
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat ahli waris berhasil diajukan.');
    }


    public function downloadSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $suratAhliWarisModel = new \App\Models\SuratAhliWarisModel();
        $ahliWarisModel = new \App\Models\AhliWarisModel();

        // Ambil data surat
        $surat = $suratModel->find($idSurat);
        if (!$surat) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan');
        }

        // Ambil data surat ahli waris
        $suratAhliWaris = $suratAhliWarisModel->where('id_surat', $idSurat)->first();
        if (!$suratAhliWaris) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data ahli waris tidak ditemukan');
        }

        // Ambil data ahli waris
        $dataAhliWaris = $ahliWarisModel->where('id_surat_ahli_waris', $suratAhliWaris['id_surat_ahli_waris'])->findAll();

        // Data untuk view
        $data = [
            'pemilik_harta' => $suratAhliWaris['pemilik_harta'],
            'nama_ahli_waris' => array_column($dataAhliWaris, 'nama'),
            'nik_ahli_waris' => array_column($dataAhliWaris, 'nik'),
            'ttl_ahli_waris' => array_column($dataAhliWaris, 'ttl'),
            'hubungan_ahli_waris' => array_column($dataAhliWaris, 'hubungan'),
            'logo' => FCPATH . 'assets/logo.png' // sesuaikan path logo
        ];

         // Logo
        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render HTML
        $html = view('masyarakat/surat/preview-surat/preview_ahli_waris', $data); // sesuaikan nama view-mu

        // Siapkan PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // agar gambar bisa ditampilkan

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Download PDF
        $dompdf->stream('Surat_Keterangan_Ahli_Waris_' . $suratAhliWaris['pemilik_harta'] . '.pdf', ['Attachment' => true]);
    }
}
