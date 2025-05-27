<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratKelahiranController extends BaseController
{
    public function kelahiran()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kelahiran');
    }

    public function previewKelahiran()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'ttl' => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'alamat' => $this->request->getPost('alamat'),
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'anak_ke' => $this->request->getPost('anak_ke'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_kelahiran', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_kelahiran.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanKelahiran()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi
        $rules = [
            'nama'         => 'required',
            'ttl'          => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan'    => 'required',
            'alamat'       => 'required',
            'nama_ayah'    => 'required',
            'nama_ibu'     => 'required',
            'anak_ke'      => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/masyarakat/surat/kelahiran')->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $data = [
            'nama'          => $this->request->getPost('nama'),
            'ttl'           => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pekerjaan'     => $this->request->getPost('pekerjaan'),
            'alamat'        => $this->request->getPost('alamat'),
            'nama_ayah'     => $this->request->getPost('nama_ayah'),
            'nama_ibu'      => $this->request->getPost('nama_ibu'),
            'anak_ke'       => $this->request->getPost('anak_ke'),
        ];

        // Simpan ke tabel `surat`
        $suratModel = new \App\Models\SuratModel();
        $noSurat = 'KL-' . date('YmdHis');
        $idSurat = $suratModel->insert([
            'id_user' => 1,
            'no_surat' => $noSurat,
            'jenis_surat' => 'kelahiran',
            'status' => 'diajukan'
        ]);

        // Simpan ke tabel `surat_kelahiran`
        $kelahiranModel = new \App\Models\SuratKelahiranModel();
        $data['id_surat'] = $idSurat;
        $kelahiranModel->insert($data);

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $emailRecipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id']; // Ganti sesuai kebutuhan

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Pengajuan Surat Kelahiran Baru');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Pengajuan surat kelahiran baru telah diajukan.<br>" .
                    "Nomor Surat: <strong>$noSurat</strong><br>" .
                    "Silakan cek sistem untuk melakukan verifikasi.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Surat Kelahiran berhasil diajukan.');
    }

    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $kelahiranModel = new \App\Models\SuratKelahiranModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail kelahiran
        $detail = $kelahiranModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat kelahiran tidak ditemukan.');
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
            'ttl' => $detail['ttl'],
            'jenis_kelamin' => $detail['jenis_kelamin'],
            'pekerjaan' => $detail['pekerjaan'],
            'alamat' => $detail['alamat'],
            'nama_ayah' => $detail['nama_ayah'],
            'nama_ibu' => $detail['nama_ibu'],
            'anak_ke' => $detail['anak_ke'],
        ];

        // Render HTML ke PDF
        $html = view('masyarakat/surat/preview-surat/preview_kelahiran', $data);

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_kelahiran_' . strtolower(str_replace(' ', '_', $detail['nama'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);

        exit();
    }

    public function editSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $kelahiranModel = new \App\Models\SuratKelahiranModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail kelahiran
        $detail = $kelahiranModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data surat kelahiran tidak ditemukan.');
        }

        // Siapkan data untuk view
        $data = [
            'id_surat' => $id,
            'nama' => $detail['nama'],
            'ttl' => $detail['ttl'],
            'jenis_kelamin' => $detail['jenis_kelamin'],
            'pekerjaan' => $detail['pekerjaan'],
            'alamat' => $detail['alamat'],
            'nama_ayah' => $detail['nama_ayah'],
            'nama_ibu' => $detail['nama_ibu'],
            'anak_ke' => $detail['anak_ke'],
        ];

        return view('masyarakat/surat/edit-surat/edit_kelahiran', $data);
    }



    public function updateSurat($id_surat)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama'         => 'required',
            'ttl'          => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan'    => 'required',
            'alamat'       => 'required',
            'nama_ayah'    => 'required',
            'nama_ibu'     => 'required',
            'anak_ke'      => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/masyarakat/surat/kelahiran/update/' . $id_surat)
                ->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'ttl'           => $this->request->getPost('ttl'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pekerjaan'     => $this->request->getPost('pekerjaan'),
            'alamat'        => $this->request->getPost('alamat'),
            'nama_ayah'     => $this->request->getPost('nama_ayah'),
            'nama_ibu'      => $this->request->getPost('nama_ibu'),
            'anak_ke'       => $this->request->getPost('anak_ke'),
        ];

        $suratModel = new \App\Models\SuratModel();
        $kelahiranModel = new \App\Models\SuratKelahiranModel();

        // Update data surat_kelahiran berdasarkan kolom id_surat (bukan primary key)
        $kelahiranModel->where('id_surat', $id_surat)->set($data)->update();

        // Update status surat di tabel surat
        $suratModel->update($id_surat, [
            'status_surat' => 'diajukan',
        ]);

        // Kirim email notifikasi update surat
        $email = \Config\Services::email();
        $emailRecipients = ['fpendii210203@gmail.com', 'fpendii210203@gmail.com'];

        foreach ($emailRecipients as $recipient) {
            $email->setTo($recipient);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Update Surat Kelahiran');
            $email->setMessage(
                "Halo,<br><br>" .
                    "Surat kelahiran dengan nomor surat <strong>" . $suratModel->find($id_surat)['no_surat'] . "</strong> telah diperbarui.<br>" .
                    "Silakan cek sistem untuk melihat perubahan.<br><br>" .
                    "Terima kasih."
            );

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email notifikasi update ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Surat Kelahiran berhasil diperbarui.');
    }
}
