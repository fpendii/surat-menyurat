<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratKelompokTaniController extends BaseController
{
    public function domisiliKelompokTani()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-kelompok-tani');
    }

    public function previewDomisiliKelompokTani()
    {
        $data = [
            'nama_gapoktan'   => $this->request->getPost('nama_gapoktan'),
            'tgl_pembentukan' => $this->request->getPost('tgl_pembentukan'),
            'alamat'          => $this->request->getPost('alamat'),
            'ketua'           => $this->request->getPost('ketua'),
            'sekretaris'      => $this->request->getPost('sekretaris'),
            'bendahara'       => $this->request->getPost('bendahara'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;
        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_domisili_kelompok_tani', $data);
        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_kelompok_tani.pdf', ['Attachment' => true]);
        exit();
    }

    public function ajukanDomisiliKelompokTani()
    {
        $validation = \Config\Services::validation();

        // Validasi input
        $validation->setRules([
            'nama_gapoktan'   => 'required|min_length[3]',
            'tgl_pembentukan' => 'required|valid_date',
            'alamat'          => 'required|min_length[5]',
            'ketua'           => 'required|min_length[3]',
            'sekretaris'      => 'required|min_length[3]',
            'bendahara'       => 'required|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data ke tabel surat terlebih dahulu
        $suratModel = new \App\Models\SuratModel();

        $idSurat = $suratModel->insert([
            'id_user' => 1,
            'no_surat' => 'KLT-' . date('YmdHis'),
            'jenis_surat' => 'domisili_kelompok_tani',
            'status' => 'diajukan'
        ], true); // `true` agar insert() mengembalikan last insert id

        // Simpan data ke tabel surat_domisili_kelompok_tani
        $domisiliModel = new \App\Models\SuratDomisiliKelompokTaniModel();
        $domisiliModel->insert([
            'id_surat'         => $idSurat,
            'nama_gapoktan'    => $this->request->getPost('nama_gapoktan'),
            'tgl_pembentukan'  => $this->request->getPost('tgl_pembentukan'),
            'alamat'           => $this->request->getPost('alamat'),
            'ketua'            => $this->request->getPost('ketua'),
            'sekretaris'       => $this->request->getPost('sekretaris'),
            'bendahara'        => $this->request->getPost('bendahara'),
        ]);

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }
}
