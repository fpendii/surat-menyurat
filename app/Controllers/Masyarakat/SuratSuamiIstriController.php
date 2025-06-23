<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\I18n\Time;
use App\Models\SuratModel;
use App\Models\SuamiIstriModel;

class SuratSuamiIstriController extends BaseController
{
    public function suamiIstri()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-suami-istri');
    }

    public function previewSuamiIstri()
    {
        // Ambil semua data dari POST request
        $data = $this->request->getPost();

        // Pastikan variabel logo terdefinisi
        $logo = null;
        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $imageData = file_get_contents($path);
            $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        }
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
        $dompdf->stream('surat_keterangan_suami_istri.pdf', ['Attachment' => false]);
        exit();
    }

    public function ajukanSuamiIstri()
    {
        $suratModel = new SuratModel();
        $suamiIstriModel = new SuamiIstriModel();
        $db = \Config\Database::connect();
        // --- TAHAP 1: VALIDASI INPUT ---
        try {
            $validationRules = [
                'nama_suami'                 => 'required|min_length[3]',
                'ttl_suami'                  => 'required|min_length[5]',
                'agama_suami'                => 'required',
                'status_sebelum_nikah_suami' => 'required',
                'alamat_suami'               => 'required|min_length[5]',
                'nama_istri'                 => 'required|min_length[3]',
                'ttl_istri'                  => 'required|min_length[5]',
                'agama_istri'                => 'required',
                'status_sebelum_nikah_istri' => 'required',
                'alamat_istri'               => 'required|min_length[5]',
                'hari_nikah'                 => 'required',
                'tbt_nikah'                  => 'required|valid_date',
                'tempat_akat_nikah'          => 'required',
                'wali_nikah'                 => 'required',
                'mahar'                      => 'required',
                'saksi_nikah'                => 'required',
                'jumlah_anak'                => 'required|integer|greater_than_equal_to[0]',
            ];

            if (!$this->validate($validationRules)) {
                log_message('error', 'AJUKAN_SURAT_SUAMI_ISTRI_VALIDATION_FAILED: ' . json_encode($this->validator->getErrors()));
                return redirect()->to('/masyarakat/surat/suami-istri')->withInput()->with('errors', $this->validator->getErrors());
            }
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_VALIDATION_SUCCESS.');
        } catch (\Exception $e) {
            log_message('critical', 'AJUKAN_SURAT_SUAMI_ISTRI_VALIDATION_CRITICAL_ERROR: ' . $e->getMessage() . ' - Trace: ' . $e->getTraceAsString());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem saat validasi. Detail: ' . $e->getMessage());
        }

        $db->transStart(); // Mulai transaksi database

        try {
            // 2. Generasi Nomor Surat
            $klasifikasi = '400.12.3.2';
            $lokasi = 'Handil Suruk';
            $tahun = date('Y');

            $jumlahSuratTahunIni = $suratModel
                ->whereIn('jenis_surat', ['status_perkawinan', 'suami_istri'])
                ->where('YEAR(created_at)', $tahun)
                ->countAllResults();
            $nomorUrut = $jumlahSuratTahunIni + 1;
            $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_NOMOR_SURAT_GENERATED: ' . $nomorSurat);

            // 3. Upload File KTP & KK
            $ktpFile = $this->request->getFile('ktp'); // Changed to ktp
            if (!$ktpFile || !$ktpFile->isValid()) {
                throw new \Exception('File KTP tidak valid atau tidak ditemukan.');
            }
            $ktpName = $ktpFile->getRandomName();
            if (!$ktpFile->move(ROOTPATH . 'public/uploads/surat_suami_istri', $ktpName)) { // Assuming common upload folder
                throw new \Exception('Gagal memindahkan file KTP: ' . $ktpFile->getErrorString());
            }
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_KTP_UPLOADED: ' . $ktpName);

            $kkFile = $this->request->getFile('kk'); // Changed to kk
            if (!$kkFile || !$kkFile->isValid()) {
                throw new \Exception('File KK tidak valid atau tidak ditemukan.');
            }
            $kkName = $kkFile->getRandomName();
            if (!$kkFile->move(ROOTPATH . 'public/uploads/surat_suami_istri', $kkName)) { // Assuming common upload folder
                throw new \Exception('Gagal memindahkan file KK: ' . $kkFile->getErrorString());
            }
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_KK_UPLOADED: ' . $kkName);

            // 4. Simpan ke tabel `surat`
            $suratData = [
                'id_user'     => session()->get('user_id'),
                'no_surat'    => $nomorSurat,
                'jenis_surat' => 'suami_istri',
                'status'      => 'diajukan',
                'ktp'         => $ktpName, // Storing file name in 'ktp' field in 'surat' table
                'kk'          => $kkName,  // Storing file name in 'kk' field in 'surat' table
            ];
            $suratModel->insert($suratData);
            $suratId = $suratModel->getInsertID();
            if (!$suratId) {
                throw new \Exception('Gagal mendapatkan ID surat yang baru setelah insert. Data mungkin tidak tersimpan.');
            }
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_MAIN_SURAT_INSERTED: ID=' . $suratId);

            // 5. Simpan ke tabel `surat_suami_istri`
            $suamiIstriData = [
                'id_surat'                   => $suratId,
                'nama_suami'                 => $this->request->getPost('nama_suami'),
                'ttl_suami'                  => $this->request->getPost('ttl_suami'),
                'agama_suami'                => $this->request->getPost('agama_suami'),
                'status_sebelum_nikah_suami' => $this->request->getPost('status_sebelum_nikah_suami'),
                'alamat_suami'               => $this->request->getPost('alamat_suami'),
                'nama_istri'                 => $this->request->getPost('nama_istri'),
                'ttl_istri'                  => $this->request->getPost('ttl_istri'),
                'agama_istri'                => $this->request->getPost('agama_istri'),
                'status_sebelum_nikah_istri' => $this->request->getPost('status_sebelum_nikah_istri'),
                'alamat_istri'               => $this->request->getPost('alamat_istri'),
                'hari_nikah'                 => $this->request->getPost('hari_nikah'),
                'tbt_nikah'                  => $this->request->getPost('tbt_nikah'),
                'tempat_akat_nikah'          => $this->request->getPost('tempat_akat_nikah'),
                'wali_nikah'                 => $this->request->getPost('wali_nikah'),
                'mahar'                      => $this->request->getPost('mahar'),
                'saksi_nikah'                => $this->request->getPost('saksi_nikah'),
                'jumlah_anak'                => $this->request->getPost('jumlah_anak'),
            ];

            // Debug data yang akan diinsert
            log_message('debug', 'AJUKAN_SURAT_SUAMI_ISTRI_DATA_DETAIL_TO_INSERT: ' . json_encode($suamiIstriData));

            $suamiIstriModel->insert($suamiIstriData);
            if ($suamiIstriModel->errors()) { // Cek jika ada error model (misal field tidak di allowedFields)
                throw new \Exception('Gagal menyimpan data detail suami istri ke database. Model errors: ' . json_encode($suamiIstriModel->errors()));
            }
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_DETAIL_INSERTED.');

            $db->transComplete(); // Selesaikan transaksi

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Transaksi database gagal dan di-rollback. Cek log database.');
            }
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_TRANSACTION_COMPLETE_SUCCESS.');

            // 6. Kirim email notifikasi
            $email = \Config\Services::email();
            $userModel = new \App\Models\UserModel();

            // Fetch emails of users with 'kepala_desa' or 'admin' roles
            $emailRecipients = $userModel->select('email')
                ->whereIn('role', ['kepala_desa', 'admin'])
                ->findAll();

            // Extract just the email addresses into a simple array
            $emailRecipients = array_column($emailRecipients, 'email');

            // Remove any null or empty emails to prevent errors
            $emailRecipients = array_filter($emailRecipients);
            // --- End Email Recipient Logic ---

            $jenisSurat = 'Surat Suami Istri';
            $viewEmail = view('email/notifikasi', [
                'nomorSurat' => $nomorSurat,
                'jenisSurat' => $jenisSurat
            ]);

            foreach ($emailRecipients as $recipient) {
                $email->setTo($recipient);
                $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil Suruk');
                $email->setSubject('Pengajuan Surat Keterangan Suami Istri Baru');
                $email->setMessage($viewEmail);
                $email->setMailType('html');

                if (!$email->send()) {
                    log_message('warning', 'AJUKAN_SURAT_SUAMI_ISTRI_EMAIL_SEND_FAILED: Ke ' . $recipient . ' - ' . $email->printDebugger(['headers']));
                    // Jika email gagal, kita mungkin tidak ingin menghentikan seluruh proses,
                    // tergantung pada tingkat kekritisan email. Di sini kita log saja.
                }
                $email->clear();
            }
            log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_EMAIL_SENT.');

            return redirect()->to('/masyarakat/surat/')->with('success', 'Pengajuan Surat Berhasil diajukan dan notifikasi dikirim');
        } catch (\Exception $e) {
            // Jika ada exception di tahap manapun setelah validasi, lakukan rollback
            $db->transRollback();
            log_message('error', 'AJUKAN_SURAT_SUAMI_ISTRI_PROCESS_FAILED: ' . $e->getMessage() . ' - Trace: ' . $e->getTraceAsString());

            // Hapus file yang mungkin sudah terupload jika transaksi gagal
            if (isset($ktpName) && file_exists(ROOTPATH . 'public/uploads/surat_suami_istri/' . $ktpName)) {
                unlink(ROOTPATH . 'public/uploads/surat_suami_istri/' . $ktpName);
                log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_KTP_ROLLED_BACK_DELETED: ' . $ktpName);
            }
            if (isset($kkName) && file_exists(ROOTPATH . 'public/uploads/surat_suami_istri/' . $kkName)) {
                unlink(ROOTPATH . 'public/uploads/surat_suami_istri/' . $kkName);
                log_message('info', 'AJUKAN_SURAT_SUAMI_ISTRI_KK_ROLLED_BACK_DELETED: ' . $kkName);
            }

            return redirect()->back()->withInput()->with('error', 'Gagal mengajukan surat. Detail: ' . $e->getMessage());
        }
    }

    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new SuratModel();
        $suamiIstriModel = new SuamiIstriModel();

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

        // Siapkan data untuk view, disesuaikan dengan semua field baru
        $data = [
            'logo'                       => $logo,
            'no_surat'                   => $surat['no_surat'],
            'tanggal'                    => Time::parse($surat['created_at'])->toLocalizedString('d MMMM Y', 'id'), // Menggunakan 'id' untuk bahasa Indonesia
            'nama_suami'                 => $detail['nama_suami'],
            'ttl_suami'                  => $detail['ttl_suami'],
            'agama_suami'                => $detail['agama_suami'],
            'status_sebelum_nikah_suami' => $detail['status_sebelum_nikah_suami'],
            'alamat_suami'               => $detail['alamat_suami'],
            'nama_istri'                 => $detail['nama_istri'],
            'ttl_istri'                  => $detail['ttl_istri'],
            'agama_istri'                => $detail['agama_istri'],
            'status_sebelum_nikah_istri' => $detail['status_sebelum_nikah_istri'],
            'alamat_istri'               => $detail['alamat_istri'],
            'hari_nikah'                 => $detail['hari_nikah'],
            'tbt_nikah'                  => Time::parse($detail['tbt_nikah'])->toLocalizedString('d MMMM Y', 'id'), // Format tanggal nikah
            'tempat_akat_nikah'          => $detail['tempat_akat_nikah'],
            'wali_nikah'                 => $detail['wali_nikah'],
            'mahar'                      => $detail['mahar'],
            'saksi_nikah'                => $detail['saksi_nikah'],
            'jumlah_anak'                => $detail['jumlah_anak'],
            'ktp_file'               => base_url('uploads/ktp/' . $surat['ktp']), // URL untuk KTP
            'kk_file'                => base_url('uploads/kk/' . $surat['kk']), // URL untuk KK
        ];

        // Render HTML ke PDF
        $html = view('masyarakat/surat/preview-surat/preview_suami_istri', $data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_keterangan_suami_istri_' . strtolower(str_replace(' ', '_', $detail['nama_suami'] . '_' . $detail['nama_istri'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => false]);

        exit();
    }

    public function editSurat($id)
    {
        // Load model
        $suratModel = new SuratModel();
        $suamiIstriModel = new SuamiIstriModel();

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
        $suratModel = new SuratModel();
        $suamiIstriModel = new SuamiIstriModel();
        $db = \Config\Database::connect(); // Mendapatkan instance database

        // Ambil data surat yang ada
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail suami istri yang ada
        $detail = $suamiIstriModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat suami istri tidak ditemukan.');
        }

        // --- TAHAP 1: VALIDASI INPUT ---
        try {
            $validationRules = [
                'nama_suami'                 => 'required|min_length[3]',
                'ttl_suami'                  => 'required|min_length[5]',
                'agama_suami'                => 'required',
                'status_sebelum_nikah_suami' => 'required',
                'alamat_suami'               => 'required|min_length[5]',
                'nama_istri'                 => 'required|min_length[3]',
                'ttl_istri'                  => 'required|min_length[5]',
                'agama_istri'                => 'required',
                'status_sebelum_nikah_istri' => 'required',
                'alamat_istri'               => 'required|min_length[5]',
                'hari_nikah'                 => 'required',
                'tbt_nikah'                  => 'required|valid_date',
                'tempat_akat_nikah'          => 'required',
                'wali_nikah'                 => 'required',
                'mahar'                      => 'required',
                'saksi_nikah'                => 'required',
                'jumlah_anak'                => 'required|integer|greater_than_equal_to[0]',
            ];

            // Tambahkan validasi untuk file hanya jika diupload
            if ($this->request->getFile('ktp') && $this->request->getFile('ktp')->isValid() && !$this->request->getFile('ktp')->hasMoved()) {
                $validationRules['ktp'] = 'uploaded[ktp]|max_size[ktp,2048]|ext_in[ktp,jpg,jpeg,png,pdf]';
            }
            if ($this->request->getFile('kk') && $this->request->getFile('kk')->isValid() && !$this->request->getFile('kk')->hasMoved()) {
                $validationRules['kk'] = 'uploaded[kk]|max_size[kk,2048]|ext_in[kk,jpg,jpeg,png,pdf]';
            }

            if (!$this->validate($validationRules)) {
                log_message('error', 'UPDATE_SURAT_SUAMI_ISTRI_VALIDATION_FAILED: ' . json_encode($this->validator->getErrors()));
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_VALIDATION_SUCCESS.');
        } catch (\Exception $e) {
            log_message('critical', 'UPDATE_SURAT_SUAMI_ISTRI_VALIDATION_CRITICAL_ERROR: ' . $e->getMessage() . ' - Trace: ' . $e->getTraceAsString());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem saat validasi update. Detail: ' . $e->getMessage());
        }


        // 2. Penanganan Upload File (jika ada file baru)
        $ktpName = $surat['ktp']; // Pertahankan nama file lama
        $kkName = $surat['kk'];   // Pertahankan nama file lama

        $ktpFile = $this->request->getFile('ktp'); // Using ktp as per form
        if ($ktpFile && $ktpFile->isValid() && !$ktpFile->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($ktpName) && file_exists(ROOTPATH . 'public/uploads/surat_suami_istri/' . $ktpName)) {
                unlink(ROOTPATH . 'public/uploads/surat_suami_istri/' . $ktpName);
                log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_OLD_KTP_DELETED: ' . $ktpName);
            }
            $ktpName = $ktpFile->getRandomName();
            if (!$ktpFile->move(ROOTPATH . 'public/uploads/surat_suami_istri', $ktpName)) {
                throw new \Exception('Gagal memindahkan file KTP: ' . $ktpFile->getErrorString());
            }
            log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_NEW_KTP_UPLOADED: ' . $ktpName);
        }

        $kkFile = $this->request->getFile('kk'); // Using kk as per form
        if ($kkFile && $kkFile->isValid() && !$kkFile->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($kkName) && file_exists(ROOTPATH . 'public/uploads/surat_suami_istri/' . $kkName)) {
                unlink(ROOTPATH . 'public/uploads/surat_suami_istri/' . $kkName);
                log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_OLD_KK_DELETED: ' . $kkName);
            }
            $kkName = $kkFile->getRandomName();
            if (!$kkFile->move(ROOTPATH . 'public/uploads/surat_suami_istri', $kkName)) {
                throw new \Exception('Gagal memindahkan file KK: ' . $kkFile->getErrorString());
            }
            log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_NEW_KK_UPLOADED: ' . $kkName);
        }

        // 3. Update data `surat`
        $suratData = [
            'status_surat' => 'diajukan', // Setel ulang status menjadi 'diajukan' setelah di-edit
            'ktp'    => $ktpName,
            'kk'     => $kkName,
        ];
        $suratModel->update($id, $suratData);
        if ($suratModel->errors()) {
            throw new \Exception('Gagal update data utama surat. Model errors: ' . json_encode($suratModel->errors()));
        }
        log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_MAIN_SURAT_UPDATED: ID=' . $id);

        // 4. Update data `surat_suami_istri`
        $suamiIstriData = [
            'nama_suami'                 => $this->request->getPost('nama_suami'),
            'ttl_suami'                  => $this->request->getPost('ttl_suami'),
            'agama_suami'                => $this->request->getPost('agama_suami'),
            'status_sebelum_nikah_suami' => $this->request->getPost('status_sebelum_nikah_suami'),
            'alamat_suami'               => $this->request->getPost('alamat_suami'),
            'nama_istri'                 => $this->request->getPost('nama_istri'),
            'ttl_istri'                  => $this->request->getPost('ttl_istri'),
            'agama_istri'                => $this->request->getPost('agama_istri'),
            'status_sebelum_nikah_istri' => $this->request->getPost('status_sebelum_nikah_istri'),
            'alamat_istri'               => $this->request->getPost('alamat_istri'),
            'hari_nikah'                 => $this->request->getPost('hari_nikah'),
            'tbt_nikah'                  => $this->request->getPost('tbt_nikah'),
            'tempat_akat_nikah'          => $this->request->getPost('tempat_akat_nikah'),
            'wali_nikah'                 => $this->request->getPost('wali_nikah'),
            'mahar'                      => $this->request->getPost('mahar'),
            'saksi_nikah'                => $this->request->getPost('saksi_nikah'),
            'jumlah_anak'                => $this->request->getPost('jumlah_anak'),
        ];
        $suamiIstriModel->update($detail['id_surat_suami_istri'], $suamiIstriData);
        if ($suamiIstriModel->errors()) {
            throw new \Exception('Gagal update data detail suami istri. Model errors: ' . json_encode($suamiIstriModel->errors()));
        }
        log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_DETAIL_UPDATED: ID=' . $detail['id_surat_suami_istri']);

        $db->transComplete(); // Selesaikan transaksi

        if ($db->transStatus() === FALSE) {
            throw new \Exception('Transaksi database gagal dan di-rollback saat update.');
        }
        log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_TRANSACTION_COMPLETE_SUCCESS.');

        // 5. Kirim email notifikasi bahwa surat telah direvisi/diperbarui
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Sesuaikan dengan email penerima notifikasi
        $jenisSurat = 'Surat Keterangan Suami Istri';
        $nomorSurat = $surat['no_surat']; // Ambil nomor surat yang sudah ada

        $viewEmail = view('email/notifikasi', [ // Create a new email template for revisions or reuse 'notifikasi'
            'nomorSurat' => $nomorSurat,
            'jenisSurat' => $jenisSurat,
            'pesan'      => 'Surat Keterangan Suami Istri Anda dengan nomor ' . $nomorSurat . ' telah berhasil direvisi/diperbarui.',
        ]);

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Notifikasi Revisi/Pembaruan Surat ' . $jenisSurat);
            $email->setMessage($viewEmail);
            $email->setMailType('html');

            if (!$email->send()) {
                log_message('warning', 'UPDATE_SURAT_SUAMI_ISTRI_EMAIL_REVISION_SEND_FAILED: Ke ' . $recipient . ' - ' . $email->printDebugger(['headers']));
            }
            $email->clear();
        }
        log_message('info', 'UPDATE_SURAT_SUAMI_ISTRI_REVISION_EMAIL_SENT.');


        return redirect()->to('/masyarakat/data-surat/')->with('success', 'Data surat suami istri berhasil diperbarui dan notifikasi revisi dikirim.');
    }
}
