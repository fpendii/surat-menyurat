<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratUsahaController extends BaseController
{
    public function usaha()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-usaha');
    }

    public function previewUsaha()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'rt_rw' => $this->request->getPost('rt_rw'),
            'desa' => $this->request->getPost('desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'provinsi' => $this->request->getPost('provinsi'),
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'alamat_usaha' => $this->request->getPost('alamat_usaha'),
            'sejak_tahun' => $this->request->getPost('sejak_tahun'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_usaha', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_keterangan_usaha.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanUsaha()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama' => 'required',
            'nik' => 'required|numeric|exact_length[16]',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'nama_usaha' => 'required',
            'alamat_usaha' => 'required',
            'sejak_tahun' => 'required|numeric|exact_length[4]',
            'kk' => 'uploaded[kk]|max_size[kk,2048]|mime_in[kk,image/jpg,image/jpeg,image/png,application/pdf]',
            'ktp' => 'uploaded[ktp]|max_size[ktp,2048]|mime_in[ktp,image/jpg,image/jpeg,image/png,application/pdf]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userId = 1; // Ambil dari session login seharusnya

        $kk = $this->request->getFile('kk');
        $ktp = $this->request->getFile('ktp');

        $kkName = $kk->getRandomName();
        $ktpName = $ktp->getRandomName();

        $kk->move('uploads/kk/', $kkName);
        $ktp->move('uploads/ktp/', $ktpName);

        // Simpan data ke tabel surat dulu
        $suratModel = new \App\Models\SuratModel();
        $noSurat = 'US-' . date('YmdHis');
        $idSurat = $suratModel->insert([
            'id_user' => $userId,
            'no_surat' => $noSurat,
            'jenis_surat' => 'usaha',
            'status' => 'diajukan'
        ]);

        // Simpan data detail surat usaha
        $usahaModel = new \App\Models\SuratUsahaModel();

        $usahaModel->insert([
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'rt_rw' => $this->request->getPost('rt_rw'),
            'desa' => $this->request->getPost('desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'provinsi' => $this->request->getPost('provinsi'),
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'alamat_usaha' => $this->request->getPost('alamat_usaha'),
            'sejak_tahun' => $this->request->getPost('sejak_tahun'),
            'kk' => $kkName,
            'ktp' => $ktpName,
        ]);

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Usaha Baru');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat usaha baru telah diajukan.<br>" .
                    "Nomor Surat: <strong>$noSurat</strong><br>" .
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


    public function downloadSurat($idSurat)
    {
        $suratModel = new \App\Models\SuratModel();
        $usahaModel = new \App\Models\SuratUsahaModel();

        // Ambil data surat
        $surat = $suratModel->find($idSurat);
        if (!$surat || $surat['jenis_surat'] !== 'usaha') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan atau bukan surat usaha');
        }

        // Ambil data usaha
        $usaha = $usahaModel->where('id_surat', $idSurat)->first();
        if (!$usaha) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data surat usaha tidak ditemukan');
        }

        // Siapkan data untuk view
        $data = [
            'nama' => $usaha['nama'],
            'nik' => $usaha['nik'],
            'alamat' => $usaha['alamat'],
            'rt_rw' => $usaha['rt_rw'],
            'desa' => $usaha['desa'],
            'kecamatan' => $usaha['kecamatan'],
            'kabupaten' => $usaha['kabupaten'],
            'provinsi' => $usaha['provinsi'],
            'nama_usaha' => $usaha['nama_usaha'],
            'alamat_usaha' => $usaha['alamat_usaha'],
            'sejak_tahun' => $usaha['sejak_tahun']
        ];

        // Ambil dan encode logo
        $path = FCPATH . 'img/logo.png'; // Ubah path sesuai lokasi logomu
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view ke HTML
        $html = view('masyarakat/surat/preview-surat/preview_usaha', $data); // Pastikan view ini tersedia

        // Siapkan PDF
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Unduh PDF
        $dompdf->stream('Surat_Keterangan_Usaha_' . $usaha['nama'] . '.pdf', ['Attachment' => true]);
    }

    public function editSurat($id)
    {
        $usahaModel = new \App\Models\SuratUsahaModel();
        $suratModel = new \App\Models\SuratModel();

        $usaha = $usahaModel->where('id_surat', $id)->first();
        if (!$usaha) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data surat usaha tidak ditemukan');
        }

        $surat = $suratModel->find($usaha['id_surat']);
        if (!$surat) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan');
        }

        return view('masyarakat/surat/edit-surat/edit_usaha', [
            'usaha' => $usaha,
            'surat' => $surat
        ]);
    }

    public function updateSurat($id)
    {
        $usahaModel = new \App\Models\SuratUsahaModel();
        $suratModel = new \App\Models\SuratModel();

        $usaha = $usahaModel->where('id_surat', $id)->first();
        if (!$usaha) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data surat usaha tidak ditemukan');
        }

        $surat = $suratModel->find($usaha['id_surat']);
        if (!$surat) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat tidak ditemukan');
        }

        $suratModel = new \App\Models\SuratModel();
        $suratModel->update($id, [
            'no_surat' => $this->request->getPost('no_surat'),
            'status' => 'diajukan'
        ]);

        $usahaModel->where('id_surat', $id)->set([
            'nama' => $this->request->getPost('nama'),
            'nik' => $this->request->getPost('nik'),
            'alamat' => $this->request->getPost('alamat'),
            'rt_rw' => $this->request->getPost('rt_rw'),
            'desa' => $this->request->getPost('desa'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'provinsi' => $this->request->getPost('provinsi'),
            'nama_usaha' => $this->request->getPost('nama_usaha'),
            'alamat_usaha' => $this->request->getPost('alamat_usaha'),
            'sejak_tahun' => $this->request->getPost('sejak_tahun')
        ])->update();

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Pengajuan surat berhasil diperbarui.');
    }
}
