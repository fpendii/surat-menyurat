<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratDomisiliManusiaController extends BaseController
{
    public function domisiliManusia()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-manusia');
    }

    public function previewDomisiliWarga()
    {
        $data = [
            'nama_pejabat'   => $this->request->getPost('nama_pejabat'),
            'jabatan' => $this->request->getPost('jabatan'),
            'kecamatan_pejabat'          => $this->request->getPost('kecamatan_pejabat'),
            'kabupaten_pejabat'           => $this->request->getPost('kabupaten_pejabat'),
            'nama_warga'      => $this->request->getPost('nama_warga'),
            'nik'       => $this->request->getPost('nik'),
            'alamat'       => $this->request->getPost('alamat'),
            'desa'       => $this->request->getPost('desa'),
            'kecamatan'       => $this->request->getPost('kecamatan'),
            'kabupaten'       => $this->request->getPost('kabupaten'),
            'provinsi'       => $this->request->getPost('provinsi'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_domisili_warga', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_warga.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanDomisiliWarga()
    {
        $data = [
            'nama_pejabat'   => $this->request->getPost('nama_pejabat'),
            'jabatan' => $this->request->getPost('jabatan'),
            'kecamatan_pejabat'          => $this->request->getPost('kecamatan_pejabat'),
            'kabupaten_pejabat'           => $this->request->getPost('kabupaten_pejabat'),
            'nama_warga'      => $this->request->getPost('nama_warga'),
            'nik'       => $this->request->getPost('nik'),
            'alamat'       => $this->request->getPost('alamat'),
            'desa'       => $this->request->getPost('desa'),
            'kecamatan'       => $this->request->getPost('kecamatan'),
            'kabupaten'       => $this->request->getPost('kabupaten'),
            'provinsi'       => $this->request->getPost('provinsi'),
        ];

        // Simpan data ke database atau lakukan proses lainnya
        // ...

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }
}
