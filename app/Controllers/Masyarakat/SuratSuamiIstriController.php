<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratSuamiIstriController extends BaseController
{
    public function suamiIstri()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-suami-istri');
    }

    public function previewSuamiIstri()
    {
        $data = [
            'nama_suami' => $this->request->getPost('nama_suami'),
            'nik_suami' => $this->request->getPost('nik_suami'),
            'ttl_suami' => $this->request->getPost('ttl_suami'),
            'agama_suami' => $this->request->getPost('agama_suami'),
            'alamat_suami' => $this->request->getPost('alamat_suami'),
            'nama_istri' => $this->request->getPost('nama_istri'),
            'nik_istri' => $this->request->getPost('nik_istri'),
            'ttl_istri' => $this->request->getPost('ttl_istri'),
            'agama_istri' => $this->request->getPost('agama_istri'),
            'alamat_istri' => $this->request->getPost('alamat_istri')
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_suami_istri', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_suami_istri.pdf', ['Attachment' => false]); // true = download, false
        // tampil di browser
        exit();
    }

    public function ajukanSuamiIstri()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $validationRules = [
            'nama_suami'    => 'required',
            'nik_suami'     => 'required|numeric|exact_length[16]',
            'ttl_suami'     => 'required',
            'agama_suami'   => 'required',
            'alamat_suami'  => 'required',
            'nama_istri'    => 'required',
            'nik_istri'     => 'required|numeric|exact_length[16]',
            'ttl_istri'     => 'required',
            'agama_istri'   => 'required',
            'alamat_istri'  => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/masyarakat/surat/suami-istri')->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
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

        // Simpan ke tabel surat (misal ada kolom jenis_surat dan created_at)
        $suratModel = new \App\Models\SuratModel();
        $suratData = [
            'id_user' => session()->get('user_id'),
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'suami_istri',
            'status' => 'diajukan'
        ];

        $suratModel->insert($suratData);
        $suratId = $suratModel->getInsertID();

        // Simpan ke tabel suami_istri, dengan relasi ke surat via surat_id
        $suamiIstriModel = new \App\Models\SuamiIstriModel();

        $suamiIstriData = [
            'id_surat'      => $suratId,
            'nama_suami'    => $this->request->getPost('nama_suami'),
            'nik_suami'     => $this->request->getPost('nik_suami'),
            'ttl_suami'     => $this->request->getPost('ttl_suami'),
            'agama_suami'   => $this->request->getPost('agama_suami'),
            'alamat_suami'  => $this->request->getPost('alamat_suami'),
            'nama_istri'    => $this->request->getPost('nama_istri'),
            'nik_istri'     => $this->request->getPost('nik_istri'),
            'ttl_istri'     => $this->request->getPost('ttl_istri'),
            'agama_istri'   => $this->request->getPost('agama_istri'),
            'alamat_istri'  => $this->request->getPost('alamat_istri'),
        ];

        $suamiIstriModel->insert($suamiIstriData);

        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengajukan surat. Silakan coba lagi.');
        }

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Suami Istri Baru');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat suami istri baru telah diajukan.<br>" .
                    "Nomor Surat: <strong>$nomorSurat</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat/')->with('success', 'Pengajuan surat suami istri berhasil diajukan.');
    }

    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $suamiIstriModel = new \App\Models\SuamiIstriModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail suami istri
        $detail = $suamiIstriModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat suami istri tidak ditemukan.');
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
            'nama_suami' => $detail['nama_suami'],
            'nik_suami' => $detail['nik_suami'],
            'ttl_suami' => $detail['ttl_suami'],
            'agama_suami' => $detail['agama_suami'],
            'alamat_suami' => $detail['alamat_suami'],
            'nama_istri' => $detail['nama_istri'],
            'nik_istri' => $detail['nik_istri'],
            'ttl_istri' => $detail['ttl_istri'],
            'agama_istri' => $detail['agama_istri'],
            'alamat_istri' => $detail['alamat_istri'],

            // tanggal_nikah dan tempat_nikah bisa ditambahkan jika perlu
        ];


        // Render HTML ke PDF
        $html = view('masyarakat/surat/preview-surat/preview_suami_istri', $data);

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_suami_istri_' . strtolower(str_replace(' ', '_', $detail['nama_suami'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => false]);

        exit();
    }

    public function editSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $suamiIstriModel = new \App\Models\SuamiIstriModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail suami istri
        $detail = $suamiIstriModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat suami istri tidak ditemukan.');
        }

        // Siapkan data untuk view
        $data = [
            'surat' => $surat,
            'detail' => $detail,
        ];

        return view('masyarakat/surat/edit-surat/edit_suami_istri', $data);
    }

    public function updateSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $suamiIstriModel = new \App\Models\SuamiIstriModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail suami istri
        $detail = $suamiIstriModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat suami istri tidak ditemukan.');
        }

        // Validasi input
        $validationRules = [
            'nama_suami'    => 'required',
            'nik_suami'     => 'required|numeric|exact_length[16]',
            'ttl_suami'     => 'required',
            'agama_suami'   => 'required',
            'alamat_suami'  => 'required',
            'nama_istri'    => 'required',
            'nik_istri'     => 'required|numeric|exact_length[16]',
            'ttl_istri'     => 'required',
            'agama_istri'   => 'required',
            'alamat_istri'  => 'required',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data surat
        $suratData = [
            'status_surat' => 'diajukan',
        ];
        $suratModel->update($id, $suratData);

        // Update data detail suami istri
        $suamiIstriData = [
            'nama_suami'    => $this->request->getPost('nama_suami'),
            'nik_suami'     => $this->request->getPost('nik_suami'),
            'ttl_suami'     => $this->request->getPost('ttl_suami'),
            'agama_suami'   => $this->request->getPost('agama_suami'),
            'alamat_suami
            ' => $this->request->getPost('alamat_suami'),
            'nama_istri'    => $this->request->getPost('nama_istri'),
            'nik_istri'     => $this->request->getPost('nik_istri'),
            'ttl_istri'     => $this->request->getPost('ttl_istri'),
            'agama_istri'   => $this->request->getPost('agama_istri'),
            'alamat_istri'  => $this->request->getPost('alamat_istri'),
        ];
        $suamiIstriModel->update($detail['id_suami_istri'], $suamiIstriData);
        return redirect()->to('/masyarakat/data-surat/')->with('success', 'Data surat suami istri berhasil diperbarui.');
    }
}
