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
        // Ambil data dari form
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

        // Simpan data ke database atau lakukan proses lainnya
        // ...

        return redirect()->to('/masyarakat/surat/')->with('success', 'Pengajuan surat suami istri berhasil diajukan.');
    }

}
