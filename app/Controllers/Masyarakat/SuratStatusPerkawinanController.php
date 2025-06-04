<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratStatusPerkawinanController extends BaseController
{
    public function statusPerkawinan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-status-perkawinan');
    }

    public function previewStatusPerkawinan()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'status' => $this->request->getPost('status'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_status_perkawinan', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_status_perkawinan.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanStatusPerkawinan()
    {
        // Validasi input
        $validationRules = [
            'nama'    => 'required|max_length[100]',
            'nik'     => 'required|numeric',
            'ttl'     => 'required|max_length[100]',
            'agama'   => 'required',
            'alamat'  => 'required',
            'status'  => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/masyarakat/surat/status-perkawinan')->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $suratModel = new \App\Models\SuratModel();
        $statusPerkawinanModel = new \App\Models\SuratStatusPerkawinanModel();

        // Transaksi agar data konsisten
        $db->transStart();

         // 1. Tentukan kode klasifikasi dan lokasi
        $klasifikasi = '400.12.3.2';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        // 2. Hitung nomor urut surat dari database berdasarkan tahun
        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['status_perkawinan','suami_istri'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = $jumlahSuratTahunIni + 1;

        // 3. Gabungkan semua jadi nomor surat
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Simpan data ke tabel surat
       
        $suratData = [
            'id_user' => session()->get('user_id'),
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'status_perkawinan',
            'status' => 'diajukan',
        ];
        $suratModel->insert($suratData);
        $idSurat = $suratModel->getInsertID();

        // Simpan data ke tabel surat_status_perkawinan
        $statusPerkawinanData = [
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'status' => $this->request->getPost('status'),
        ];
        $statusPerkawinanModel->insert($statusPerkawinanData);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Status Perkawinan Baru');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat status perkawinan baru telah diajukan.<br>" .
                    "Nomor Surat: <strong>$nomorSurat</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat berhasil diajukan.');
    }

    public function downloadSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $statusModel = new \App\Models\SuratStatusPerkawinanModel();

        // Ambil data surat dan detail status perkawinan
        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['jenis_surat'] !== 'status_perkawinan') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat tidak ditemukan');
        }

        $detail = $statusModel->where('id_surat', $idSurat)->first();

        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        $data['logo'] = $logo;

        // Siapkan data untuk view
        $data = [
            'logo' => $logo,
            'no_surat' => $surat['no_surat'],
            'tanggal' => date('d F Y', strtotime($surat['created_at'] ?? date('Y-m-d'))),

            'nama' => $detail['nama'],
            'nik' => $detail['nik'],
            'ttl' => $detail['ttl'],
            'agama' => $detail['agama'],
            'alamat' => $detail['alamat'],
            'status' => $detail['status'],
        ];

        // Render view surat jadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_status_perkawinan', $data);

        // Load dan generate PDF
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Tampilkan PDF ke browser langsung (inline)
        $dompdf->stream("Surat_Status_Perkawinan_{$detail['nama']}.pdf", ["Attachment" => false]);
    }

    public function editSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $statusModel = new \App\Models\SuratStatusPerkawinanModel();

        // Ambil data surat dan detail status perkawinan
        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['jenis_surat'] !== 'status_perkawinan') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat tidak ditemukan');
        }

        $detail = $statusModel->where('id_surat', $idSurat)->first();

        return view('masyarakat/surat/edit-surat/edit_status_perkawinan', [
            'surat' => $surat,
            'detail' => $detail,
        ]);
    }

    public function updateSurat($idSurat)
    {
        $validationRules = [
            'nama'   => 'required|max_length[100]',
            'nik'    => 'required|numeric',
            'ttl'    => 'required|max_length[100]',
            'agama'  => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $suratModel = new \App\Models\SuratModel();
        $statusModel = new \App\Models\SuratStatusPerkawinanModel();

        // Update data surat
        $suratData = [
            'jenis_surat' => 'status_perkawinan',
            'status'      => 'diajukan',
        ];
        $suratModel->update($idSurat, $suratData);

        // Update data status perkawinan
        $statusData = [
            'nama'   => $this->request->getPost('nama'),
            'nik'    => $this->request->getPost('nik'),
            'ttl'    => $this->request->getPost('ttl'),
            'agama'  => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'status' => $this->request->getPost('status'),
        ];
        $statusModel->set($statusData)->where('id_surat', $idSurat)->update();

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Surat berhasil diperbarui.');
    }
}
