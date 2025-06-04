<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratKematianController extends BaseController
{
    public function kematian()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kematian');
    }

    public function previewKematian()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'hari_tanggal' => $this->request->getPost('hari_tanggal'),
            'jam' => $this->request->getPost('jam'),
            'tempat' => $this->request->getPost('tempat'),
            'penyebab' => $this->request->getPost('penyebab'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_kematian', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_kematian.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanKematian()
    {
        // Validasi input
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'ttl' => 'required',
            'agama' => 'required',
            'hari_tanggal' => 'required',
            'jam' => 'required',
            'tempat' => 'required',
            'penyebab' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/masyarakat/surat/kematian')->withInput()->withInput()->with('errors', $validation->getErrors());
        }

        // 1. Tentukan kode klasifikasi dan lokasi
        $klasifikasi = '400.12.3.1';
        $lokasi = 'Handil Suruk';
        $tahun = date('Y');

        // 2. Hitung nomor urut surat dari database berdasarkan tahun
        $suratModel = new \App\Models\SuratModel();
        $jumlahSuratTahunIni = $suratModel
            ->whereIn('jenis_surat', ['ahli_waris', 'kematian', 'kelahiran'])
            ->where('YEAR(created_at)', $tahun)
            ->countAllResults();
        $nomorUrut = $jumlahSuratTahunIni + 1;

        // 3. Gabungkan semua jadi nomor surat
        $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

        // Simpan ke tabel `surat`
        $suratModel = new \App\Models\SuratModel();
        $idUser = session()->get('id_user'); // Pastikan user login dan ada session
        $idSurat = $suratModel->insert([
            'id_user' => $idUser,
            'no_surat' => $nomorSurat,
            'jenis_surat' => 'kematian',
            'status' => 'diajukan'
        ]);

        // Simpan ke tabel `surat_kematian`
        $kematianModel = new \App\Models\SuratKematianModel();
        $kematianModel->insert([
            'id_surat' => $idSurat,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'agama' => $this->request->getPost('agama'),
            'hari_tanggal' => $this->request->getPost('hari_tanggal'),
            'jam' => $this->request->getPost('jam'),
            'tempat' => $this->request->getPost('tempat'),
            'penyebab' => $this->request->getPost('penyebab'),
        ]);

         // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Kematian');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat kematian baru telah diajukan.<br>" .
                    "Nomor Surat: <strong>$nomorSurat</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat kematian berhasil diajukan.');
    }

    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $kematianModel = new \App\Models\SuratKematianModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail kematian
        $detail = $kematianModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat kematian tidak ditemukan.');
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
            'nama' => $detail['nama'],
            'jenis_kelamin' => $detail['jenis_kelamin'],
            'ttl' => $detail['ttl'],
            'agama' => $detail['agama'],
            'hari_tanggal' => $detail['hari_tanggal'],
            'jam' => $detail['jam'],
            'tempat' => $detail['tempat'],
            'penyebab' => $detail['penyebab'],
        ];

        // Render HTML ke PDF
        $html = view('masyarakat/surat/preview-surat/preview_kematian', $data);

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_kematian_' . strtolower(str_replace(' ', '_', $detail['nama'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);

        exit();
    }


    public function editSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $kematianModel = new \App\Models\SuratKematianModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail kematian
        $detail = $kematianModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat kematian tidak ditemukan.');
        }

        // Siapkan data untuk view
        $data = [
            'surat' => $surat,
            'detail' => $detail,
        ];

        return view('masyarakat/surat/edit-surat/edit_kematian', $data);
    }

    public function updateSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $kematianModel = new \App\Models\SuratKematianModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail kematian
        $detail = $kematianModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat kematian tidak ditemukan.');
        }

        // Validasi input
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'ttl' => 'required',
            'agama' => 'required',
            'hari_tanggal' => 'required',
            'jam' => 'required',
            'tempat' => 'required',
            'penyebab' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/masyarakat/surat/kematian')->withInput()->with('errors', $validation->getErrors());
        }

        // Update tabel `surat`
        $suratModel->update($id, ['status_surat' => 'diajukan']);

        // Update tabel `surat_kematian`
        $kematianModel->update($detail['id_surat'], [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'agama' => $this->request->getPost('agama'),
            'hari_tanggal' => $this->request->getPost('hari_tanggal'),
            'jam' => $this->request->getPost('jam'),
            'tempat' => $this->request->getPost('tempat'),
            'penyebab' => $this->request->getPost('penyebab'),
        ]);

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Surat kematian berhasil diperbarui.');
    }
}
