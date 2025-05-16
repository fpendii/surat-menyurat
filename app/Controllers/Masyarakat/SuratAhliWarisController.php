<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        // Ambil data dari form
        $data = [
            'pemilik_harta' => $this->request->getPost('pemilik_harta'),
            'nama_ahli_waris' => $this->request->getPost('nama_ahli_waris'),
            'nik_ahli_waris' => $this->request->getPost('nik_ahli_waris'),
            'ttl_ahli_waris' => $this->request->getPost('ttl_ahli_waris'),
            'hubungan_ahli_waris' => $this->request->getPost('hubungan_ahli_waris')
        ];

        // Simpan data ke database atau lakukan proses lainnya sesuai kebutuhan
        // ...

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat berhasil diajukan.');
    }
}
