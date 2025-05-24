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

        // 1. Tentukan kode klasifikasi dan lokasi
        $klasifikasi = '400.12.2.2';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        // 2. Hitung nomor urut surat dari database berdasarkan tahun
        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['domisili_kelompok_tani', 'domisili_warga', 'domisili_bangunan'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = $jumlahSuratTahunIni + 1;

        // 3. Gabungkan semua jadi nomor surat
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Simpan data ke tabel surat
        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert([
            'id_user' => session()->get('user_id'), // Ganti sesuai session user login kalau sudah implementasi login
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'domisili_kelompok_tani',
            'status' => 'diajukan'
        ], true);

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

        // Kirim email ke kepala desa dan admin
        $email = \Config\Services::email();

        $emailRecipients = ['fpendii210203@gmail.com', 'fpendii210203@gmail.com']; // Ganti dengan email yang sesuai

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Domisili Kelompok Tani');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat domisili kelompok tani baru telah diajukan.<br>" .
                    "Nomor Surat: <strong>KLT-" . date('YmdHis') . "</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear(); // Reset sebelum kirim email berikutnya
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan dan notifikasi telah dikirim.');
    }


    public function downloadSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['jenis_surat'] !== 'domisili_kelompok_tani') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan atau bukan surat domisili kelompok tani');
        }

        $domisiliModel = new \App\Models\SuratDomisiliKelompokTaniModel();
        $domisili = $domisiliModel->where('id_surat', $idSurat)->first();
        if (!$domisili) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data surat domisili kelompok tani tidak ditemukan');
        }

        $data = [
            'nama_gapoktan'    => $domisili['nama_gapoktan'],
            'tgl_pembentukan'  => $domisili['tgl_pembentukan'],
            'alamat'           => $domisili['alamat'],
            'ketua'            => $domisili['ketua'],
            'sekretaris'       => $domisili['sekretaris'],
            'bendahara'        => $domisili['bendahara'],
        ];

        // Logo
        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        $data['logo'] = $logo;

        // Render view
        $html = view('masyarakat/surat/preview-surat/preview_domisili_kelompok_tani', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_kelompok_tani.pdf', ['Attachment' => true]);
        exit();
    }

    public function editSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $domisiliModel = new \App\Models\SuratDomisiliKelompokTaniModel();

        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['jenis_surat'] !== 'domisili_kelompok_tani') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan atau bukan surat domisili kelompok tani');
        }

        $domisili = $domisiliModel->where('id_surat', $idSurat)->first();
        if (!$domisili) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data surat domisili kelompok tani tidak ditemukan');
        }

        return view('masyarakat/surat/edit-surat/edit_domisili_kelompok_tani', [
            'surat' => $surat,
            'detail' => $domisili
        ]);
    }

    public function updateSurat($idSurat)
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

        // Update data ke tabel surat
        $suratModel = new \App\Models\SuratModel();
        $suratModel->update($idSurat, [
            'no_surat' => $this->request->getPost('no_surat'),
            'status' => 'diajukan'
        ]);

        // Update data ke tabel surat_domisili_kelompok_tani
        $domisiliModel = new \App\Models\SuratDomisiliKelompokTaniModel();
        $domisiliModel->where('id_surat', $idSurat)->set([
            'nama_gapoktan'    => $this->request->getPost('nama_gapoktan'),
            'tgl_pembentukan'  => $this->request->getPost('tgl_pembentukan'),
            'alamat'           => $this->request->getPost('alamat'),
            'ketua'            => $this->request->getPost('ketua'),
            'sekretaris'       => $this->request->getPost('sekretaris'),
            'bendahara'        => $this->request->getPost('bendahara'),
        ])->update();

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Pengajuan surat berhasil diperbarui.');
    }
}
