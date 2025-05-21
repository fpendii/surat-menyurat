<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratKelahiranController extends BaseController
{
    public function kelahiran()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kelahiran');
    }

    public function previewKelahiran()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'anak_ke' => $this->request->getPost('anak_ke'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_kelahiran', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_kelahiran.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanKelahiran()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi
        $rules = [
            'nama'         => 'required',
            'ttl'          => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan'    => 'required',
            'alamat'       => 'required',
            'nama_ayah'    => 'required',
            'nama_ibu'     => 'required',
            'anak_ke'      => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/masyarakat/surat/kelahiran')->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $data = [
            'nama'          => $this->request->getPost('nama'),
            'ttl'           => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pekerjaan'     => $this->request->getPost('pekerjaan'),
            'alamat'        => $this->request->getPost('alamat'),
            'nama_ayah'     => $this->request->getPost('nama_ayah'),
            'nama_ibu'      => $this->request->getPost('nama_ibu'),
            'anak_ke'       => $this->request->getPost('anak_ke'),
        ];

        // Simpan ke tabel `surat`
        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert([
            'id_user' => 1,
            'no_surat' => 'KL-' . date('YmdHis'),
            'jenis_surat' => 'kelahiran',
            'status' => 'diajukan'
        ]);

        // Simpan ke tabel `surat_kelahiran`
        $kelahiranModel = new \App\Models\SuratKelahiranModel();
        $data['id_surat'] = $idSurat;
        $kelahiranModel->insert($data);

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat Kelahiran berhasil diajukan.');
    }
}
