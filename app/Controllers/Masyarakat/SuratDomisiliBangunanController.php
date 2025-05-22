<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratDomisiliBangunanController extends BaseController
{
    public function domisiliBangunan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-bangunan');
    }


    public function previewDomisiliBangunan()
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
        $html = view('masyarakat/surat/preview-surat/preview_domisili_bangunan', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_bangunan.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanDomisiliBangunan()
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
            'no_surat' => 'DB-' . date('YmdHis'),
            'jenis_surat' => 'domisili_bangunan',
            'status' => 'diajukan',
        ], true); // true supaya dapat id terakhir

        // Simpan data ke tabel surat_domisili_bangunan
        $domisiliBangunanModel = new \App\Models\SuratDomisiliBangunanModel();
        $domisiliBangunanModel->insert([
            'id_surat'         => $idSurat,
            'nama_gapoktan'    => $this->request->getPost('nama_gapoktan'),
            'tgl_pembentukan'  => $this->request->getPost('tgl_pembentukan'),
            'alamat'           => $this->request->getPost('alamat'),
            'ketua'            => $this->request->getPost('ketua'),
            'sekretaris'       => $this->request->getPost('sekretaris'),
            'bendahara'        => $this->request->getPost('bendahara'),
        ]);

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat Domisili Bangunan berhasil diajukan.');
    }


    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $domisiliBangunanModel = new \App\Models\SuratDomisiliBangunanModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail domisili bangunan
        $detail = $domisiliBangunanModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data domisili bangunan tidak ditemukan.');
        }

        // Logo desa (jika ada)
        $path = FCPATH . 'img/logo.png';
        $logo = null;
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $imageData = file_get_contents($path);
            $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        }

        // Siapkan data untuk view
        $data = [
            'logo' => $logo,
            'no_surat' => $surat['no_surat'],
            'tanggal' => date('d-m-Y', strtotime($surat['created_at'] ?? date('Y-m-d'))),
            'nama_gapoktan' => $detail['nama_gapoktan'],
            'tgl_pembentukan' => $detail['tgl_pembentukan'],
            'alamat' => $detail['alamat'],
            'ketua' => $detail['ketua'],
            'sekretaris' => $detail['sekretaris'],
            'bendahara' => $detail['bendahara'],
        ];

        // Render HTML ke PDF
        $html = view('masyarakat/surat/preview-surat/preview_domisili_bangunan', $data);

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_domisili_bangunan_' . strtolower(str_replace(' ', '_', $detail['nama_gapoktan'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);

        exit();
    }
}
