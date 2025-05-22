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
        $validation = \Config\Services::validation();

        // Aturan validasi
        $validation->setRules([
            'nama_pejabat'       => 'required|min_length[3]',
            'jabatan'            => 'required|min_length[3]',
            'kecamatan_pejabat'  => 'required|min_length[3]',
            'kabupaten_pejabat'  => 'required|min_length[3]',
            'nama_warga'         => 'required|min_length[3]',
            'nik'                => 'required|numeric|exact_length[16]',
            'alamat'             => 'required|min_length[5]',
            'desa'               => 'required|min_length[3]',
            'kecamatan'          => 'required|min_length[3]',
            'kabupaten'          => 'required|min_length[3]',
            'provinsi'           => 'required|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/masyarakat/surat/domisili-manusia')->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data ke tabel surat dulu
        $suratModel = new \App\Models\SuratModel();
        $noSurat = 'DW-' . date('YmdHis');
        $idSurat = $suratModel->insert([
            'id_user'    => 1, // pastikan user login
            'no_surat'   => $noSurat,
            'jenis_surat' => 'domisili_warga',
            'status'     => 'diajukan',
        ], true);

        // Simpan data ke tabel surat_domisili_warga
        $domisiliWargaModel = new \App\Models\SuratDomisiliWargaModel();
        $domisiliWargaModel->insert([
            'id_surat'           => $idSurat,
            'nama_pejabat'       => $this->request->getPost('nama_pejabat'),
            'jabatan'            => $this->request->getPost('jabatan'),
            'kecamatan_pejabat'  => $this->request->getPost('kecamatan_pejabat'),
            'kabupaten_pejabat'  => $this->request->getPost('kabupaten_pejabat'),
            'nama_warga'         => $this->request->getPost('nama_warga'),
            'nik'                => $this->request->getPost('nik'),
            'alamat'             => $this->request->getPost('alamat'),
            'desa'               => $this->request->getPost('desa'),
            'kecamatan'          => $this->request->getPost('kecamatan'),
            'kabupaten'          => $this->request->getPost('kabupaten'),
            'provinsi'           => $this->request->getPost('provinsi'),
        ]);

         // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['fpendii210203@gmail.com', 'fpendii210203@gmail.com']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Domisili Warga Baru');
            $email->setMessage(
                "Halo,<br><br>" .
                "Pengajuan surat domisili warga baru telah diajukan.<br>" .
                "No Surat: $noSurat<br>" .
                "Nama Warga: " . $this->request->getPost('nama_warga') . "<br>" .
                "NIK: " . $this->request->getPost('nik') . "<br>" .
                "Alamat: " . $this->request->getPost('alamat') . "<br><br>" .
                "Silakan cek sistem untuk informasi lebih lanjut.<br><br>" .
                "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }

    public function downloadSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['jenis_surat'] !== 'domisili_warga') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan atau bukan surat domisili warga');
        }

        $domisiliWargaModel = new \App\Models\SuratDomisiliWargaModel();
        $domisiliWarga = $domisiliWargaModel->where('id_surat', $idSurat)->first();
        if (!$domisiliWarga) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data domisili warga tidak ditemukan');
        }

        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_domisili_warga', [
            'logo' => $logo,
            'nama_pejabat' => $domisiliWarga['nama_pejabat'],
            'jabatan' => $domisiliWarga['jabatan'],
            'kecamatan_pejabat' => $domisiliWarga['kecamatan_pejabat'],
            'kabupaten_pejabat' => $domisiliWarga['kabupaten_pejabat'],
            'nama_warga' => $domisiliWarga['nama_warga'],
            'nik' => $domisiliWarga['nik'],
            'alamat' => $domisiliWarga['alamat'],
            'desa' => $domisiliWarga['desa'],
            'kecamatan' => $domisiliWarga['kecamatan'],
            'kabupaten' => $domisiliWarga['kabupaten'],
            'provinsi' => $domisiliWarga['provinsi'],
        ]);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_warga.pdf', ['Attachment' => true]); // true = download, false = tampil di browser
        exit();
    }
        
}
