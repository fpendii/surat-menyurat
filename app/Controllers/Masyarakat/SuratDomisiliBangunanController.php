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
            'ktp'             => 'uploaded[ktp]|max_size[ktp,2048]|ext_in[ktp,jpg,jpeg,png,pdf]',
            'kk'              => 'uploaded[kk]|max_size[kk,2048]|ext_in[kk,jpg,jpeg,png,pdf]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Upload file KTP ke public/uploads/ktp/
        $ktpFile = $this->request->getFile('ktp');
        $ktpName = $ktpFile->getRandomName();
        $ktpFile->move(ROOTPATH . 'public/uploads/ktp', $ktpName);  // Simpan ke public/uploads/ktp/

        // Upload file KK ke public/uploads/kk/
        $kkFile = $this->request->getFile('kk');
        $kkName = $kkFile->getRandomName();
        $kkFile->move(ROOTPATH . 'public/uploads/kk', $kkName);    // Simpan ke public/uploads/kk/

        // 1. Tentukan kode klasifikasi dan lokasi
        $klasifikasi = '400.12.2.2';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        // 2. Hitung nomor urut surat dari database berdasarkan tahun
        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['domisili_kelompok_tani', 'domisili_warga', 'domisili_bangunan', 'surat-pindah'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = $jumlahSuratTahunIni + 1;

        // 3. Gabungkan semua jadi nomor surat
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Simpan data ke tabel surat terlebih dahulu
        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert([
            'id_user' => session()->get('user_id'), // Ganti dengan session()->get('id_user') jika sudah login
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'domisili_bangunan',
            'status' => 'diajukan',
            'ktp' => $ktpName,
            'kk' => $kkName,
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

        // Kirim email ke kepala desa dan admin
        $email = \Config\Services::email();

        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Notifikasi Pengajuan Surat Domisili Bangunan');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Terdapat pengajuan <strong>Surat Domisili Bangunan</strong> baru.<br>" .
                    "Nomor Surat: <strong>{$nomorSurat}</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear(); // Reset konfigurasi sebelum kirim ke email berikutnya
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat Domisili Bangunan berhasil diajukan dan notifikasi dikirim.');
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
        $dompdf->stream($filename, ['Attachment' => false]);

        exit();
    }

    public function editSurat($id)
    {
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

        // Siapkan data untuk view
        $data = [
            'surat' => $surat,
            'detail' => $detail,
        ];

        return view('masyarakat/surat/edit-surat/edit_surat_domisili_bangunan', $data);
    }

    public function updateSurat($id)
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
        $suratModel->update($id, [
            'no_surat' => $this->request->getPost('no_surat'),
            'jenis_surat' => 'domisili_bangunan',
            'status_surat' => 'diajukan',
        ]);

        // Update data ke tabel surat_domisili_bangunan
        $domisiliBangunanModel = new \App\Models\SuratDomisiliBangunanModel();
        $domisiliBangunanModel->where('id_surat', $id)->set([
            'nama_gapoktan'    => $this->request->getPost('nama_gapoktan'),
            'tgl_pembentukan'  => $this->request->getPost('tgl_pembentukan'),
            'alamat'           => $this->request->getPost('alamat'),
            'ketua'            => $this->request->getPost('ketua'),
            'sekretaris'       => $this->request->getPost('sekretaris'),
            'bendahara'        => $this->request->getPost('bendahara'),
        ])->update();

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Surat Domisili Bangunan berhasil diperbarui.');
    }
}
