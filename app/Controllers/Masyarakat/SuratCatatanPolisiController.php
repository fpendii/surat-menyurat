<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratCatatanPolisiController extends BaseController
{
    public function catatanPolisi()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-catatan-polisi');
    }

    public function previewCatatanPolisi()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_tanggal_lahir' => $this->request->getPost('tempat_tanggal_lahir'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_catatan_polisi', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_catatan_polisi.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanCatatanPolisi()
    {

        $validation = \Config\Services::validation();
        $userId = session()->get('user_id'); // Ambil ID user dari session login

        $valid = $this->validate([
            'kk' => 'uploaded[kk]|max_size[kk,2048]|mime_in[kk,image/jpg,image/jpeg,image/png,application/pdf]',
            'ktp' => 'uploaded[ktp]|max_size[ktp,2048]|mime_in[ktp,image/jpg,image/jpeg,image/png,application/pdf]',
            'akta_lahir' => 'uploaded[akta_lahir]|max_size[akta_lahir,2048]|mime_in[akta_lahir,image/jpg,image/jpeg,image/png,application/pdf]',
            'ijazah' => 'uploaded[ijazah]|max_size[ijazah,2048]|mime_in[ijazah,image/jpg,image/jpeg,image/png,application/pdf]',
            'foto_latar_belakang' => 'uploaded[foto_latar_belakang]|max_size[foto_latar_belakang,2048]|mime_in[foto_latar_belakang,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$valid) {
            return redirect()->to('masyarakat/surat/catatan-polisi')->withInput()->with('errors', $validation->getErrors());
        }

        // 1. Tentukan kode klasifikasi dan lokasi
        $klasifikasi = '300.1.6';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        // 2. Hitung nomor urut surat dari database berdasarkan tahun
        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['catatan_polisi','kehilangan'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = $jumlahSuratTahunIni + 1;

        // 3. Gabungkan semua jadi nomor surat
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Simpan dulu data surat umum ke tabel surat dan dapatkan id_surat
       
        $suratData = [
            'id_user' => $userId,
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'catatan_polisi',
            'status' => 'diajukan'
        ];

        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert($suratData);

        if (!$idSurat) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data surat.');
        }

        $berkasPath = WRITEPATH . 'uploads/surat_catatan_polisi/';
        if (!is_dir($berkasPath)) {
            mkdir($berkasPath, 0777, true);
        }

        // Upload file & simpan nama file-nya saja
        $kkFile = $this->request->getFile('kk');
        $kkName = $kkFile->getRandomName();
        $kkFile->move($berkasPath, $kkName);

        $ktpFile = $this->request->getFile('ktp');
        $ktpName = $ktpFile->getRandomName();
        $ktpFile->move($berkasPath, $ktpName);

        $aktaFile = $this->request->getFile('akta_lahir');
        $aktaName = $aktaFile->getRandomName();
        $aktaFile->move($berkasPath, $aktaName);

        $ijazahFile = $this->request->getFile('ijazah');
        $ijazahName = $ijazahFile->getRandomName();
        $ijazahFile->move($berkasPath, $ijazahName);

        $fotoFile = $this->request->getFile('foto_latar_belakang');
        $fotoName = $fotoFile->getRandomName();
        $fotoFile->move($berkasPath, $fotoName);

        $catatanPolisiData = [
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_tanggal_lahir' => $this->request->getPost('tempat_tanggal_lahir'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'kk' => $kkName,
            'ktp' => $ktpName,
            'akta_lahir' => $aktaName,
            'ijazah' => $ijazahName,
            'foto_latar_belakang' => $fotoName,
        ];

        $catatanPolisiModel = new \App\Models\CatatanPolisiModel();

        if (!$catatanPolisiModel->insert($catatanPolisiData)) {
            // Jika gagal simpan, rollback hapus surat juga
            $suratModel->delete($idSurat);
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data surat catatan polisi.');
        }

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Notifikasi Pengajuan Surat Catatan Polisi');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Terdapat pengajuan <strong>Surat Catatan Polisi</strong> baru.<br>" .
                    "Nomor Surat: <strong>$nomorSurat</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat Catatan Polisi berhasil diajukan.');
    }

    public function downloadSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $catatanPolisiModel = new \App\Models\CatatanPolisiModel();

        // Ambil data surat
        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['jenis_surat'] !== 'catatan_polisi') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan atau bukan surat catatan polisi');
        }

        // Ambil data catatan polisi
        $catatanPolisi = $catatanPolisiModel->where('id_surat', $idSurat)->first();
        if (!$catatanPolisi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data surat catatan polisi tidak ditemukan');
        }

        // Siapkan data untuk view
        $data = [
            'nama' => $catatanPolisi['nama'],
            'jenis_kelamin' => $catatanPolisi['jenis_kelamin'],
            'tempat_tanggal_lahir' => $catatanPolisi['tempat_tanggal_lahir'],
            'status_perkawinan' => $catatanPolisi['status_perkawinan'],
            'kewarganegaraan' => $catatanPolisi['kewarganegaraan'],
            'agama' => $catatanPolisi['agama'],
            'pekerjaan' => $catatanPolisi['pekerjaan'],
            'nik' => $catatanPolisi['nik'],
            'alamat' => $catatanPolisi['alamat'],
            'no_surat' => $surat['no_surat'],
        ];

        // Ambil dan encode logo
        $path = FCPATH . 'img/logo.png'; // Ubah path sesuai kebutuhan
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view ke HTML
        $html = view('masyarakat/surat/preview-surat/preview_catatan_polisi', $data); // Sesuaikan nama view-nya

        // Siapkan PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Unduh PDF
        $dompdf->stream('Surat_Catatan_Polisi_' . $catatanPolisi['nama'] . '.pdf', ['Attachment' => false]);
    }

    public function editSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $catatanPolisiModel = new \App\Models\CatatanPolisiModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat || $surat['jenis_surat'] !== 'catatan_polisi') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan atau bukan surat catatan polisi');
        }

        // Ambil data catatan polisi
        $catatanPolisi = $catatanPolisiModel->where('id_surat', $id)->first();
        if (!$catatanPolisi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data surat catatan polisi tidak ditemukan');
        }

        return view('masyarakat/surat/edit-surat/edit_catatan_polisi', [
            'surat' => $surat,
            'catatanPolisi' => $catatanPolisi
        ]);
    }

    public function updateSurat($idSurat)
    {
        $validation = \Config\Services::validation();
        $userId = 1; // Ambil ID user dari session login, sesuaikan dengan implementasi Anda

        // Validasi input (file boleh tidak diupload ulang saat update)
        $valid = $this->validate([
            'kk' => 'max_size[kk,2048]|mime_in[kk,image/jpg,image/jpeg,image/png,application/pdf]',
            'ktp' => 'max_size[ktp,2048]|mime_in[ktp,image/jpg,image/jpeg,image/png,application/pdf]',
            'akta_lahir' => 'max_size[akta_lahir,2048]|mime_in[akta_lahir,image/jpg,image/jpeg,image/png,application/pdf]',
            'ijazah' => 'max_size[ijazah,2048]|mime_in[ijazah,image/jpg,image/jpeg,image/png,application/pdf]',
            'foto_latar_belakang' => 'max_size[foto_latar_belakang,2048]|mime_in[foto_latar_belakang,image/jpg,image/jpeg,image/png]',
        ]);

        if (!$valid) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $suratModel = new \App\Models\SuratModel();
        $catatanPolisiModel = new \App\Models\CatatanPolisiModel();

        // Cari data surat lama, pastikan milik user dan ada
        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['id_user'] != $userId) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan atau Anda tidak berhak mengubahnya.');
        }

        // Update data surat jika diperlukan, contoh update status tetap 'diajukan'
        $suratUpdateData = [
            'status_surat' => 'diajukan',
        ];
        $suratModel->update($idSurat, $suratUpdateData);

        // Ambil data catatan polisi terkait
        $catatanPolisi = $catatanPolisiModel->where('id_surat', $idSurat)->first();
        if (!$catatanPolisi) {
            return redirect()->back()->with('error', 'Data catatan polisi tidak ditemukan.');
        }

        $berkasPath = WRITEPATH . 'uploads/surat_catatan_polisi/';
        if (!is_dir($berkasPath)) {
            mkdir($berkasPath, 0777, true);
        }

        // Siapkan array update data
        $updateData = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tempat_tanggal_lahir' => $this->request->getPost('tempat_tanggal_lahir'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'agama' => $this->request->getPost('agama'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        // Fungsi bantu upload file jika ada, return nama file baru, atau null jika tidak ada upload
        $handleUpload = function ($inputName, $oldFileName) use ($berkasPath) {
            $file = $this->request->getFile($inputName);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Hapus file lama jika ada
                if ($oldFileName && file_exists($berkasPath . $oldFileName)) {
                    unlink($berkasPath . $oldFileName);
                }
                $newName = $file->getRandomName();
                $file->move($berkasPath, $newName);
                return $newName;
            }
            return null; // tidak ada upload
        };

        // Cek dan upload file baru jika ada, jika tidak, gunakan file lama
        $kkName = $handleUpload('kk', $catatanPolisi['kk']);
        if ($kkName) $updateData['kk'] = $kkName;

        $ktpName = $handleUpload('ktp', $catatanPolisi['ktp']);
        if ($ktpName) $updateData['ktp'] = $ktpName;

        $aktaName = $handleUpload('akta_lahir', $catatanPolisi['akta_lahir']);
        if ($aktaName) $updateData['akta_lahir'] = $aktaName;

        $ijazahName = $handleUpload('ijazah', $catatanPolisi['ijazah']);
        if ($ijazahName) $updateData['ijazah'] = $ijazahName;

        $fotoName = $handleUpload('foto_latar_belakang', $catatanPolisi['foto_latar_belakang']);
        if ($fotoName) $updateData['foto_latar_belakang'] = $fotoName;

        // Update data catatan polisi
        if (!$catatanPolisiModel->update($catatanPolisi['id_surat_keterangan_polisi'], $updateData)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data catatan polisi.');
        }

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Surat Catatan Polisi berhasil diperbarui.');
    }
}
