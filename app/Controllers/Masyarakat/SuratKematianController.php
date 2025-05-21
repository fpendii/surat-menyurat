<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratKematianController extends BaseController
{
    public function kematian()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kematian');
    }

    public function previewKematian()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'hari_tanggal' => $this->request->getPost('hari_tanggal'),
            'jam' => $this->request->getPost('jam'),
            'tempat' => $this->request->getPost('tempat'),
            'penyebab' => $this->request->getPost('penyebab'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_kematian', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_kematian.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanKematian()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'ttl' => 'required',
            'agama' => 'required',
            'hari_tanggal' => 'required',
            'jam' => 'required',
            'tempat' => 'required',
            'penyebab' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/masyarakat/surat/kematian')->withInput()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan ke tabel `surat`
        $suratModel = new \App\Models\SuratModel();
        $idUser = 1; // Pastikan user login dan ada session

        $idSurat = $suratModel->insert([
            'id_user' => 1,
            'no_surat' => 'SK-' . date('YmdHis'),
            'jenis_surat' => 'kematian',
            'status' => 'diajukan'
        ]);

        // Simpan ke tabel `surat_kematian`
        $kematianModel = new \App\Models\SuratKematianModel();
        $kematianModel->insert([
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'agama' => $this->request->getPost('agama'),
            'hari_tanggal' => $this->request->getPost('hari_tanggal'),
            'jam' => $this->request->getPost('jam'),
            'tempat' => $this->request->getPost('tempat'),
            'penyebab' => $this->request->getPost('penyebab'),
        ]);

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat kematian berhasil diajukan.');
    }
}
