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

        // foreach ($dataInput as $index => $person) {
        //     $validation->setRules([
        //         "data[$index][nama]" => 'required|min_length[3]',
        //         "data[$index][no_kk]" => 'required|numeric',
        //         "data[$index][nik]" => 'required|numeric|exact_length[16]',
        //         "data[$index][keterangan]" => 'required|min_length[5]',
        //         "data[$index][jumlah]" => 'required|integer|greater_than[0]',
        //     ]);
        // }

        // if (!$validation->withRequest($this->request)->run()) {
        //     return redirect()->to('/masyarakat/surat/pengantar-kk-ktp')->withInput()->with('errors', $validation->getErrors());
        // }

        // Simpan data ke tabel surat
        $suratModel = new \App\Models\SuratModel();
        $idSurat = $suratModel->insert([
            'id_user' => 1,
            'no_surat' => 'KKKTP-' . date('YmdHis'),
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

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat pengantar KK dan KTP berhasil diajukan.');
    }
}
