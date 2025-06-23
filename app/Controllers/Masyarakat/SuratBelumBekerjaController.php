<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\I18n\Time;

class SuratBelumBekerjaController extends BaseController
{
    public function belumBekerja()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-belum-bekerja');
    }

    public function previewBelumBekerja()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'status_pekerjaan' => $this->request->getPost('status_pekerjaan'),
            'warga_negara' => $this->request->getPost('warga_negara'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_belum_bekerja', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_belum_bekerja.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanBelumBekerja()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'ttl' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_pekerjaan' => 'required',
            'warga_negara' => 'required',
            'alamat' => 'required',
            'ktp' => 'uploaded[ktp]|max_size[ktp,2048]|mime_in[ktp,image/png,image/jpeg,image/jpg,application/pdf]',
            'kk' => 'uploaded[kk]|max_size[kk,2048]|mime_in[kk,image/png,image/jpeg,image/jpg,application/pdf]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/masyarakat/surat/belum-bekerja')->withInput()->with('errors', $validation->getErrors());
        }

        // Upload file KTP ke public/uploads/ktp/
        $ktpFile = $this->request->getFile('ktp');
        $ktpName = $ktpFile->getRandomName();
        $ktpFile->move(ROOTPATH . 'public/uploads/ktp', $ktpName); // Simpan ke public/uploads/ktp/

        // Upload file KK ke public/uploads/kk/
        $kkFile = $this->request->getFile('kk');
        $kkName = $kkFile->getRandomName();
        $kkFile->move(ROOTPATH . 'public/uploads/kk', $kkName);    // Simpan ke public/uploads/kk/

        // Ambil data dari form
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'status_pekerjaan' => $this->request->getPost('status_pekerjaan'),
            'warga_negara' => $this->request->getPost('warga_negara'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        // Nomor surat
        $klasifikasi = '500.15.9.4';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['belum_bekerja'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();

        $nomorUrut = $jumlahSuratTahunIni + 1;
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Simpan ke tabel `surat`
        $suratData = [
            'id_user' => session()->get('user_id'),
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'belum_bekerja',
            'status' => 'diajukan',
            'ktp' => $ktpName,
            'kk' => $kkName
        ];

        $suratModel->insert($suratData);
        $idSurat = $suratModel->getInsertID();

        // Simpan ke tabel `surat_belum_bekerja`
        $detailModel = new \App\Models\SuratBelumBekerjaModel();
        $data['id_surat'] = $idSurat;
        $detailModel->insert($data);

        // --- Dynamic Email Recipients ---
        // Load your User Model (adjust namespace if different)
        $userModel = new \App\Models\UserModel(); // Assuming your user model is App\Models\UserModel

        // Fetch emails of users with 'kepala_desa' or 'admin' roles
        $emailRecipients = $userModel->select('email')
            ->whereIn('role', ['kepala_desa', 'admin']) // Targeted roles
            ->findAll();

        // Extract just the email addresses into a simple array
        $emailRecipients = array_column($emailRecipients, 'email');

        // Remove any null or empty emails if they somehow exist
        $emailRecipients = array_filter($emailRecipients);
        // --- End Dynamic Email Recipients ---

        // Kirim email notifikasi
        $email = \Config\Services::email();

        $jenisSurat = 'Surat Keterangan Belum Bekerja';
        // Load view email
        $view = view('email/notifikasi', [
            'nomorSurat' => $nomorSurat,
            'jenisSurat' => $jenisSurat
        ]);

        // Only send if there are recipients
        if (!empty($emailRecipients)) {
            foreach ($emailRecipients as $recipient) {
                $email->setTo($recipient);
                $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil Suruk');
                $email->setSubject('Pengajuan Surat Belum Bekerja Baru');
                $email->setMessage($view);
                $email->setMailType('html'); // Important for HTML rendering

                if (!$email->send()) {
                    log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
                }

                $email->clear(); // Clear for the next iteration
            }
        } else {
            log_message('warning', 'Tidak ada penerima email ditemukan untuk role kepala_desa atau admin.');
        }


        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan Surat Berhasil diajukan dan notifikasi dikirim');
    }


    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $belumBekerjaModel = new \App\Models\SuratBelumBekerjaModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail belum bekerja
        $detail = $belumBekerjaModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat belum bekerja tidak ditemukan.');
        }

        // Load logo (jika tersedia)
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
            'nama' => $detail['nama'],
            'nik' => $detail['nik'],
            'ttl' => $detail['ttl'],
            'jenis_kelamin' => $detail['jenis_kelamin'],
            'agama' => $detail['agama'],
            'status_pekerjaan' => $detail['status_pekerjaan'],
            'warga_negara' => $detail['warga_negara'],
            'alamat' => $detail['alamat'],
            'created_at' => Time::parse($surat['created_at'])->toLocalizedString('d MMMM yyyy'),
            'ktp_file'               => base_url('uploads/ktp/' . $surat['ktp']), // URL untuk KTP
            'kk_file'                => base_url('uploads/kk/' . $surat['kk']), // URL untuk KK
        ];

        // Render HTML dari view
        $html = view('masyarakat/surat/preview-surat/preview_belum_bekerja', $data);

        // Dompdf config
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nama file
        $filename = 'surat_belum_bekerja_' . strtolower(str_replace(' ', '_', $detail['nama'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => false]);

        exit();
    }

    public function editSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $belumBekerjaModel = new \App\Models\SuratBelumBekerjaModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail belum bekerja
        $detail = $belumBekerjaModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat belum bekerja tidak ditemukan.');
        }

        // Siapkan data untuk view
        $data = [
            'surat' => $surat,
            'detail' => $detail,
        ];

        return view('masyarakat/surat/edit-surat/edit_belum_bekerja', $data);
    }

    public function updateSurat($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'ttl' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_pekerjaan' => 'required',
            'warga_negara' => 'required',
            'alamat' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Cek apakah surat dan detailnya ada
        $suratModel = new \App\Models\SuratModel();
        $detailModel = new \App\Models\SuratBelumBekerjaModel();

        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        $detail = $detailModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data detail surat tidak ditemukan.');
        }

        $suratModel->update($id, [
            'status_surat' => 'diajukan'
        ]);

        // Data update
        $updateData = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'status_pekerjaan' => $this->request->getPost('status_pekerjaan'),
            'warga_negara' => $this->request->getPost('warga_negara'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $detailModel->update($detail['id_belum_bekerja'], $updateData);

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Data surat berhasil diperbarui.');
    }
}
