<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SuratPindahModel; // Pastikan Anda menggunakan model yang sesuai
use App\Models\PengikutPindahModel; // Pastikan Anda menggunakan model yang sesuai
use App\Models\SuratModel; // Pastikan Anda menggunakan model yang sesuai

class SuratPindahController extends BaseController
{
    protected $suratPindahModel;
    protected $pengikutPindahModel;
    protected $suratModel;
    public function __construct()
    {
        $this->suratPindahModel = new SuratPindahModel();
        $this->pengikutPindahModel = new PengikutPindahModel();
        $this->suratModel = new SuratModel();
    }
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
        // Upload file KK
        $kk = $this->request->getFile('file_kk');
        $kkName = null;
        if ($kk && $kk->isValid() && !$kk->hasMoved()) {
            $kkName = $kk->getRandomName();
            $kk->move('uploads/surat_pindah', $kkName);
        }

        // Upload file KTP
        $ktp = $this->request->getFile('file_ktp');
        $ktpName = null;
        if ($ktp && $ktp->isValid() && !$ktp->hasMoved()) {
            $ktpName = $ktp->getRandomName();
            $ktp->move('uploads/surat', $ktpName);
        }

        // Upload file Form F1
        $formF1 = $this->request->getFile('file_f1');
        $formF1Name = null;
        if ($formF1 && $formF1->isValid() && !$formF1->hasMoved()) {
            $formF1Name = $formF1->getRandomName();
            $formF1->move('uploads/surat', $formF1Name);
        }

        // Tambah Data Surat
        $this->suratModel->insert([
            'no_surat' => 'SP-' . date('YmdHis'),
            'id_user' => 1, // Ganti dengan ID user yang sesuai
            'jenis_surat' => 'surat-pindah',
            'kk' => $kkName,
            'ktp' => $ktpName,
            'form_f1' => $formF1Name,
        ]);
        $suratId = $this->suratModel->getInsertID();


        // Ambil data utama
        $dataSurat = [
            'id_surat' => $suratId,

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
        ];

        // Simpan ke database
        $this->suratPindahModel->insert($dataSurat);
        $suratPindahId = $this->suratPindahModel->getInsertID();

        // Ambil data pengikut (array)
        $namaPengikut = $this->request->getPost('nama_pengikut');
        $jkPengikut = $this->request->getPost('jenis_kelamin_pengikut');
        $umurPengikut = $this->request->getPost('umur_pengikut');
        $statusPengikut = $this->request->getPost('status_perkawinan_pengikut');
        $pendidikanPengikut = $this->request->getPost('pendidikan_pengikut');
        $noKtpPengikut = $this->request->getPost('no_ktp_pengikut');

        // Siapkan array pengikut
        $pengikutData = [];
        if (is_array($namaPengikut)) {
            for ($i = 0; $i < count($namaPengikut); $i++) {
                $pengikutData[] = [
                    'id_surat_pindah' => $suratPindahId,
                    'nama' => $namaPengikut[$i],
                    'jenis_kelamin' => $jkPengikut[$i],
                    'umur' => $umurPengikut[$i],
                    'status_perkawinan' => $statusPengikut[$i],
                    'pendidikan' => $pendidikanPengikut[$i],
                    'no_ktp' => $noKtpPengikut[$i]
                ];
            }
            $this->pengikutPindahModel->insertBatch($pengikutData);
        }

        return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan surat berhasil diajukan.');
    }

    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new \App\Models\SuratModel();
        $suratPindahModel = new \App\Models\SuratPindahModel();
        $pengikutModel = new \App\Models\PengikutPindahModel();

        // Ambil data dari database
        $surat = $suratModel->find($id);
        $suratPindah = $suratPindahModel->where('id_surat', $surat['id_surat'])->first();
        $pengikutList = $pengikutModel->where('id_surat_pindah', $suratPindah['id_surat_pindah'])->findAll();

        // Pastikan data ditemukan
        if (!$surat || !$suratPindah) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Siapkan data untuk view
        $data = [
            'nama' => $suratPindah['nama'],
            'jenis_kelamin' => $suratPindah['jenis_kelamin'],
            'ttl' => $suratPindah['ttl'],
            'kewarganegaraan' => $suratPindah['kewarganegaraan'],
            'agama' => $suratPindah['agama'],
            'status_perkawinan' => $suratPindah['status_perkawinan'],
            'pekerjaan' => $suratPindah['pekerjaan'],
            'pendidikan' => $suratPindah['pendidikan'],
            'alamat_asal' => $suratPindah['alamat_asal'],
            'nik' => $suratPindah['nik'],
            'tujuan_pindah' => $suratPindah['tujuan_pindah'],
            'alasan_pindah' => $suratPindah['alasan_pindah'],
            'jumlah_pengikut' => count($pengikutList),
            'nama_pengikut' => array_column($pengikutList, 'nama'),
            'jenis_kelamin_pengikut' => array_column($pengikutList, 'jenis_kelamin'),
            'umur_pengikut' => array_column($pengikutList, 'umur'),
            'status_perkawinan_pengikut' => array_column($pengikutList, 'status_perkawinan'),
            'pendidikan_pengikut' => array_column($pengikutList, 'pendidikan'),
            'no_ktp_pengikut' => array_column($pengikutList, 'no_ktp'),
        ];

        // Logo
        $path = FCPATH . 'img/logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view
        $html = view('masyarakat/surat/preview-surat/preview_pindah', $data);

        // PDF config
        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_pindah_' . strtolower(str_replace(' ', '_', $suratPindah['nama'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);

        exit();
    }
}
