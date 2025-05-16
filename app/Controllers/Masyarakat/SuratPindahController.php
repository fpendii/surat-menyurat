<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratPindahController extends BaseController
{
    public function pindah()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-pindah');
    }

    public function previewPindah()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'agama' => $this->request->getPost('agama'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'alamat_asal' => $this->request->getPost('alamat_asal'),
            'nik' => $this->request->getPost('nik'),
            'tujuan_pindah' => $this->request->getPost('tujuan_pindah'),
            'alasan_pindah' => $this->request->getPost('alasan_pindah'),
            'jumlah_pengikut' => $this->request->getPost('jumlah_pengikut'),
            'nama_pengikut' => $this->request->getPost('nama_pengikut'),  // Menangani input array
            'jenis_kelamin_pengikut' => $this->request->getPost('jenis_kelamin_pengikut'),  // Menangani input array
            'umur_pengikut' => $this->request->getPost('umur_pengikut'),  // Menangani input array
            'status_perkawinan_pengikut' => $this->request->getPost('status_perkawinan_pengikut'),  // Menangani input array
            'pendidikan_pengikut' => $this->request->getPost('pendidikan_pengikut'),  // Menangani input array
            'no_ktp_pengikut' => $this->request->getPost('no_ktp_pengikut')  // Menangani input array
        ];


        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_pindah', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_pindah.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanPindah()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'ttl' => $this->request->getPost('ttl'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'agama' => $this->request->getPost('agama'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'alamat_asal' => $this->request->getPost('alamat_asal'),
            'nik' => $this->request->getPost('nik'),
            'tujuan_pindah' => $this->request->getPost('tujuan_pindah'),
            'alasan_pindah' => $this->request->getPost('alasan_pindah'),
            'jumlah_pengikut' => $this->request->getPost('jumlah_pengikut'),
            'nama_pengikut' => $this->request->getPost('nama_pengikut'),  // Menangani input array
            'jenis_kelamin_pengikut' => $this->request->getPost('jenis_kelamin_pengikut'),  // Menangani input array
            'umur_pengikut' => $this->request->getPost('umur_pengikut'),  // Menangani input array
            'status_perkawinan_pengikut' => $this->request->getPost('status_perkawinan_pengikut'),  // Menangani input array
            'pendidikan_pengikut' => $this->request->getPost('pendidikan_pengikut'),  // Menangani input array
            'no_ktp_pengikut' => $this->request->getPost('no_ktp_pengikut')  // Menangani input array
        ];
        // Simpan data ke database atau lakukan proses lainnya
        // ...
        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }

}
