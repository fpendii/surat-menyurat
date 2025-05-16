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
        // Ambil data array dari form input
        $dataOrang = $this->request->getPost('data'); // data adalah array

        // Simpan data ke database atau lakukan proses lainnya
        // ...

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }
}
