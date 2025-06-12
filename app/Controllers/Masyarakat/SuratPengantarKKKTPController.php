<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratPengantarKKKTPController extends BaseController
{
    public function pengantarKKKTP()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-pengantar-kk-ktp');
    }

    public function previewPengantarKKKTP()
    {
        // Ambil data array dari form input
        $dataOrang = $this->request->getPost('data'); // data adalah array

        // Ambil logo dan ubah ke base64
        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        // Siapkan data untuk dikirim ke view
        $data = [
            'logo' => $logo,
            'dataOrang' => $dataOrang
        ];

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_pengantar_kk_ktp', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_pengantar_kk_ktp.pdf', ['Attachment' => false]);
        exit();
    }

    public function ajukanPengantarKKKTP()
    {
        $validation = \Config\Services::validation();
        $dataInput = $this->request->getPost('data');

        // 1. Tentukan kode klasifikasi dan lokasi
        $klasifikasi = '400.12.3.1';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        // 2. Hitung nomor urut surat dari database berdasarkan tahun
        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['pengantar_kk_ktp'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = $jumlahSuratTahunIni + 1;

        // 3. Gabungkan semua jadi nomor surat
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Simpan data ke tabel surat
        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert([
            'id_user' => session()->get('user_id'),
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'pengantar_kk_ktp',
            'status' => 'diajukan'
        ], true);

        // Simpan detail orang
        $detailModel = new \App\Models\SuratPengantarKkKtpModel();
        foreach ($dataInput as $person) {
            $detailModel->insert([
                'id_surat' => $idSurat,
                'nama' => $person['nama'],
                'no_kk' => $person['no_kk'],
                'nik' => $person['nik'],
                'keterangan' => $person['keterangan'],
                'jumlah' => $person['jumlah']
            ]);
        }

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Pengantar KK dan KTP Baru');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat pengantar KK dan KTP baru telah diajukan.<br>" .
                    "Nomor Surat: <strong>$nomorSurat</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat pengantar KK dan KTP berhasil diajukan.');
    }



    public function downloadSurat($id)
    {
        // Ambil data surat
        $suratModel = new \App\Models\SuratModel();
        $detailModel = new \App\Models\SuratPengantarKkKtpModel();

        $surat = $suratModel->find($id);
        $dataOrang = $detailModel->where('id_surat', $id)->findAll();
    

        // Jika data tidak ditemukan
        if (!$surat) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Logo, bisa dari file lokal atau base64
        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        $data['logo'] = $logo;

        // Load view
        $html = view('masyarakat/surat/preview-surat/preview_pengantar_kk_ktp', [
            'surat' => $surat,
            'dataOrang' => $dataOrang,
            'logo' => $logo,
        ]);

        // Setup Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // dibutuhkan jika ada gambar dari URL
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Setting ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Download PDF
        $dompdf->stream('surat-pengantar-kk-ktp.pdf', ['Attachment' => false]);
    }

    public function editSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $detailModel = new \App\Models\SuratPengantarKkKtpModel();

        $surat = $suratModel->find($id);
        $dataOrang = $detailModel->where('id_surat', $id)->findAll();

        if (!$surat) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        return view('masyarakat/surat/edit-surat/edit_pengantar_kk_ktp', [
            'surat' => $surat,
            'dataOrang' => $dataOrang
        ]);
    }

    public function updateSurat($id)
    {
        $validation = \Config\Services::validation();
        $dataInput = $this->request->getPost('data');

        // Validasi sederhana: cek dataInput tidak kosong
        if (empty($dataInput)) {
            return redirect()->back()->with('error', 'Data orang tidak boleh kosong.')->withInput();
        }

        $suratModel = new \App\Models\SuratModel();
        $detailModel = new \App\Models\SuratPengantarKkKtpModel();

        // Cek surat ada
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Update surat, misal update status atau data lain jika ada
        $suratModel->update($id, [
            'status_surat' => 'diajukan', // contoh update status kalau ada input
            // tambahkan field lain kalau perlu
        ]);

        // Hapus dulu data detail lama yang terkait surat ini
        $detailModel->where('id_surat', $id)->delete();

        // Simpan ulang data detail orang
        foreach ($dataInput as $person) {
            $detailModel->insert([
                'id_surat' => $id,
                'nama' => $person['nama'],
                'no_kk' => $person['no_kk'],
                'nik' => $person['nik'],
                'keterangan' => $person['keterangan'],
                'jumlah' => $person['jumlah']
            ]);
        }

        // Opsional: Kirim email notifikasi update
        $email = \Config\Services::email();
        $emailRecipients = ['fpendii210203@gmail.com', 'fpendii210203@gmail.com']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Update Surat Pengantar KK dan KTP');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Surat pengantar KK dan KTP dengan nomor surat <strong>{$surat['no_surat']}</strong> telah diperbarui.<br>" .
                    "Silakan cek sistem untuk melihat perubahan.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi update ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }
            $email->clear();
        }

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Pengajuan surat berhasil diperbarui.');
    }
}
