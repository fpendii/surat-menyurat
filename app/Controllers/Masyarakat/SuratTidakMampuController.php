<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratTidakMampuController extends BaseController
{
    public function tidakMampu()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-tidak-mampu');
    }

    public function previewTidakMampu()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'bin_binti' => $this->request->getPost('bin_binti'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'keperluan' => $this->request->getPost('keperluan'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_tidak_mampu', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_tidak_mampu.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanTidakMampu()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'bin_binti' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'ttl' => 'required',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            'ktp' => 'uploaded[ktp]|mime_in[ktp,image/jpeg,image/png,application/pdf]|max_size[ktp,2048]',
            'kk' => 'uploaded[kk]|mime_in[kk,image/jpeg,image/png,application/pdf]|max_size[kk,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $ktpFile = $this->request->getFile('ktp');
        $kkFile = $this->request->getFile('kk');

        $ktpName = $ktpFile->getRandomName();
        $kkName = $kkFile->getRandomName();

        $ktpFile->move(WRITEPATH . 'uploads/surat_tidak_mampu/', $ktpName);
        $kkFile->move(WRITEPATH . 'uploads/surat_tidak_mampu/', $kkName);

         // 1. Tentukan kode klasifikasi dan lokasi
        $klasifikasi = '400.9.14.5';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        // 2. Hitung nomor urut surat dari database berdasarkan tahun
        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['tidak_mampu'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = $jumlahSuratTahunIni + 1;

        // 3. Gabungkan semua jadi nomor surat
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Ambil ID user dari session login
        $userId = 1;

        // Simpan ke tabel `surat`
        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert([
            'id_user' => $userId,
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'tidak_mampu',
            'status' => 'diajukan'
        ], true); // 'true' agar return ID yang baru disisipkan

        // Simpan ke tabel `surat_tidak_mampu`
        $tidakMampuModel = new \App\Models\SuratTidakMampuModel();

        $tidakMampuModel->insert([
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'bin_binti' => $this->request->getPost('bin_binti'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'keperluan' => $this->request->getPost('keperluan'),
            'ktp' => $ktpName,
            'kk' => $kkName,
        ]);

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Tidak Mampu Baru');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat tidak mampu telah diajukan.<br>" .
                    "Nomor Surat: <strong>$nomorSurat</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }

    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $tidakMampuModel = new \App\Models\SuratTidakMampuModel();

        // Ambil data dari database
        $surat = $suratModel->find($id);
        $suratTidakMampu = $tidakMampuModel->where('id_surat', $surat['id_surat'])->first();

        // Pastikan data ditemukan
        if (!$surat || !$suratTidakMampu) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Siapkan data untuk view
        $data = [
            'nama' => $suratTidakMampu['nama'],
            'bin_binti' => $suratTidakMampu['bin_binti'],
            'nik' => $suratTidakMampu['nik'],
            'ttl' => $suratTidakMampu['ttl'],
            'jenis_kelamin' => $suratTidakMampu['jenis_kelamin'],
            'agama' => $suratTidakMampu['agama'],
            'pekerjaan' => $suratTidakMampu['pekerjaan'],
            'alamat' => $suratTidakMampu['alamat'],
            'keperluan' => $suratTidakMampu['keperluan'],
            'tanggal_surat' => $surat['created_at'] ?? date('Y-m-d'),
            'no_surat' => $surat['no_surat'],
        ];

        // Logo
        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        $data['logo'] = $logo;

        // Render view
        $html = view('masyarakat/surat/preview-surat/preview_tidak_mampu', $data);

        // PDF config
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_tidak_mampu_' . strtolower(str_replace(' ', '_', $suratTidakMampu['nama'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);

        exit();
    }

    public function editSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $tidakMampuModel = new \App\Models\SuratTidakMampuModel();

        $surat = $suratModel->find($id);
        $suratTidakMampu = $tidakMampuModel->where('id_surat', $surat['id_surat'])->first();

        if (!$surat || !$suratTidakMampu) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        return view('masyarakat/surat/edit-surat/edit_tidak_mampu', [
            'surat' => $surat,
            'detail' => $suratTidakMampu,
        ]);
    }

    public function updateSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $tidakMampuModel = new \App\Models\SuratTidakMampuModel();

        $surat = $suratModel->find($id);
        $suratTidakMampu = $tidakMampuModel->where('id_surat', $surat['id_surat'])->first();

        if (!$surat || !$suratTidakMampu) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        $suratModel->update($id, ['status_surat' => 'diajukan']);

        $updateData = [
            'nama' => $this->request->getPost('nama'),
            'bin_binti' => $this->request->getPost('bin_binti'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'keperluan' => $this->request->getPost('keperluan'),
        ];

        $ktpFile = $this->request->getFile('ktp');
        if ($ktpFile && $ktpFile->isValid() && !$ktpFile->hasMoved()) {
            $ktpName = $ktpFile->getRandomName();
            $ktpFile->move('uploads/surat_tidak_mampu/', $ktpName);
            $updateData['ktp'] = $ktpName;
        }

        $kkFile = $this->request->getFile('kk');
        if ($kkFile && $kkFile->isValid() && !$kkFile->hasMoved()) {
            $kkName = $kkFile->getRandomName();
            $kkFile->move('uploads/surat_tidak_mampu/', $kkName);
            $updateData['kk'] = $kkName;
        }

        $tidakMampuModel->update($suratTidakMampu['id_tidak_mampu'], $updateData);

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Pengajuan surat berhasil diperbarui.');
    }
}
