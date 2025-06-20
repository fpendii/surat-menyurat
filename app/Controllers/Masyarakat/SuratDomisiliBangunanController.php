<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\I18n\Time;
use App\Models\SuratModel;
use App\Models\SuratDomisiliBangunanModel;

class SuratDomisiliBangunanController extends BaseController
{
    public function domisiliBangunan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-bangunan');
    }


    public function previewDomisiliBangunan()
    {
        $data = [
            'nama_gapoktan'   => $this->request->getPost('nama_gapoktan'),
            'tgl_pembentukan' => $this->request->getPost('tgl_pembentukan'),
            'alamat'          => $this->request->getPost('alamat'),
            'ketua'           => $this->request->getPost('ketua'),
            'sekretaris'      => $this->request->getPost('sekretaris'),
            'bendahara'       => $this->request->getPost('bendahara'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;


        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_domisili_bangunan', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_bangunan.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }

    public function ajukanDomisiliBangunan()
{
    $validation = \Config\Services::validation();
    // Validasi input
    $validation->setRules([
        'nama_kepala_desa' => 'required|min_length[3]',
        'jabatan'          => 'required|min_length[3]',
        'kecamatan'        => 'required|min_length[3]',
        'kabupaten'        => 'required|min_length[3]',
        'kantor'           => 'required|min_length[3]',
        'alamat'           => 'required|min_length[5]',
        'desa'             => 'required|min_length[3]',
        'kecamatan_desa'   => 'required|min_length[3]',
        'kabupaten_desa'   => 'required|min_length[3]',
        'provinsi'         => 'required|min_length[3]',
        'ktp'              => 'uploaded[ktp]|max_size[ktp,2048]|ext_in[ktp,jpg,jpeg,png,pdf]',
        'kk'               => 'uploaded[kk]|max_size[kk,2048]|ext_in[kk,jpg,jpeg,png,pdf]',
    ]);

   

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Upload file KTP
    $ktpFile = $this->request->getFile('ktp');
    $ktpName = $ktpFile->getRandomName();
    $ktpFile->move(ROOTPATH . 'public/uploads/ktp', $ktpName);

    // Upload file KK
    $kkFile = $this->request->getFile('kk');
    $kkName = $kkFile->getRandomName();
    $kkFile->move(ROOTPATH . 'public/uploads/kk', $kkName);

    // 1. Tentukan kode klasifikasi dan lokasi
    $klasifikasi = '400.12.2.2';
    $lokasi = 'Handil Suruk';
    $tahun = date('Y');

    // 2. Hitung nomor urut surat dari database berdasarkan tahun
    $suratModel = new \App\Models\SuratModel();
    $jumlahSuratTahunIni = $suratModel
        ->whereIn('jenis_surat', ['domisili_kelompok_tani', 'domisili_warga', 'domisili_bangunan', 'surat-pindah'])
        ->where('YEAR(created_at)', $tahun)
        ->countAllResults();
    $nomorUrut = $jumlahSuratTahunIni + 1;

    // 3. Buat nomor surat
    $nomorSurat = "{$klasifikasi}/{$nomorUrut}/{$lokasi}/{$tahun}";

    // Simpan ke tabel surat
    $idSurat = $suratModel->insert([
        'id_user'     => session()->get('user_id'),
        'no_surat'    => $nomorSurat,
        'jenis_surat' => 'domisili_bangunan',
        'status'      => 'diajukan',
        'ktp'         => $ktpName,
        'kk'          => $kkName,
    ], true);

    // Simpan ke tabel surat_domisili_bangunan
    $domisiliModel = new \App\Models\SuratDomisiliBangunanModel();
    $domisiliModel->insert([
        'id_surat'         => $idSurat,
        'nama_kepala_desa' => $this->request->getPost('nama_kepala_desa'),
        'jabatan'          => $this->request->getPost('jabatan'),
        'kecamatan'        => $this->request->getPost('kecamatan'),
        'kabupaten'        => $this->request->getPost('kabupaten'),
        'kantor'           => $this->request->getPost('kantor'),
        'alamat'           => $this->request->getPost('alamat'),
        'desa'             => $this->request->getPost('desa'),
        'kecamatan_desa'   => $this->request->getPost('kecamatan_desa'),
        'kabupaten_desa'   => $this->request->getPost('kabupaten_desa'),
        'provinsi'         => $this->request->getPost('provinsi'),
    ]);

    // Kirim email
    $email = \Config\Services::email();
    $recipients = ['norrahmah57@gmail.com', 'norrahmah@mhs.politala.ac.id'];
    $jenisSurat = 'Surat Domisili Bangunan';

    $view = view('email/notifikasi', [
        'nomorSurat' => $nomorSurat,
        'jenisSurat' => $jenisSurat
    ]);

    foreach ($recipients as $recipient) {
        $email->setTo($recipient);
        $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
        $email->setSubject('Pengajuan Surat Domisili Bangunan Baru');
        $email->setMessage($view);
        $email->setMailType('html');

        if (!$email->send()) {
            log_message('error', 'Gagal mengirim email ke ' . $recipient . ': ' . $email->printDebugger(['headers']));
        }

        $email->clear();
    }

    return redirect()->to('/masyarakat/surat')->with('success', 'Pengajuan Surat Berhasil diajukan dan notifikasi dikirim');
}

    public function downloadSurat($id)
    {
        // Load model
        $suratModel = new SuratModel();
        $domisiliBangunanModel = new SuratDomisiliBangunanModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail domisili bangunan
        $detail = $domisiliBangunanModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data domisili bangunan tidak ditemukan.');
        }

        // Logo desa (jika ada)
        $path = FCPATH . 'img/logo.png';
        $logo = null;
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $imageData = file_get_contents($path);
            $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        }

        // Siapkan data untuk view, disesuaikan dengan data dari ajukanDomisiliBangunan
        $data = [
            'logo'              => $logo,
            'no_surat'          => $surat['no_surat'],
            'tanggal'           => Time::parse($surat['created_at'])->toLocalizedString('d MMMM Y'), // Formatted date
            'nama_kepala_desa'  => $detail['nama_kepala_desa'],
            'jabatan'           => $detail['jabatan'],
            'kecamatan_pejabat' => $detail['kecamatan'], // Assuming 'kecamatan' in detail table is for pejabat
            'kabupaten_pejabat' => $detail['kabupaten'], // Assuming 'kabupaten' in detail table is for pejabat
            'nama_kantor'       => $detail['kantor'],   // 'kantor' in ajukan function is 'nama_kantor' in form
            'alamat_kantor'     => $detail['alamat'],   // 'alamat' in ajukan function is 'alamat_kantor' in form
            'desa'              => $detail['desa'],
            'kecamatan'         => $detail['kecamatan_desa'], // 'kecamatan_desa' in ajukan function
            'kabupaten'         => $detail['kabupaten_desa'], // 'kabupaten_desa' in ajukan function
            'provinsi'          => $detail['provinsi'],
            // KTP dan KK tidak langsung dimasukkan ke PDF, hanya sebagai referensi di form
            // Jika Anda perlu menampilkannya, Anda mungkin ingin menyimpan nama file asli atau URL
        ];

        // Render HTML ke PDF
        $html = view('masyarakat/surat/preview-surat/preview_domisili_bangunan', $data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'surat_domisili_bangunan_' . strtolower(str_replace(' ', '_', $detail['kantor'])) . '_' . date('Ymd') . '.pdf';
        $dompdf->stream($filename, ['Attachment' => false]);

        exit();
    }

    public function editSurat($id)
    {
        $suratModel = new \App\Models\SuratModel();
        $domisiliBangunanModel = new \App\Models\SuratDomisiliBangunanModel();

        // Ambil data surat
        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        // Ambil data detail domisili bangunan
        $detail = $domisiliBangunanModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data domisili bangunan tidak ditemukan.');
        }

        // Siapkan data untuk view
        $data = [
            'surat' => $surat,
            'detail' => $detail,
        ];

        return view('masyarakat/surat/edit-surat/edit_surat_domisili_bangunan', $data);
    }

    public function updateSurat($id)
    {
        $validation = \Config\Services::validation();

        // Ambil data surat dan detail domisili bangunan yang sudah ada
        $suratModel = new SuratModel();
        $domisiliBangunanModel = new SuratDomisiliBangunanModel();

        $surat = $suratModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Data surat tidak ditemukan.');
        }

        $detail = $domisiliBangunanModel->where('id_surat', $id)->first();
        if (!$detail) {
            return redirect()->back()->with('error', 'Data detail domisili bangunan tidak ditemukan.');
        }

        // 1. Aturan Validasi
        // Sesuaikan dengan nama field di form edit Anda
        $rules = [
            'nama_kepala_desa' => 'required|min_length[3]',
            'jabatan'          => 'required|min_length[3]',
            'kecamatan'        => 'required|min_length[3]', // Kecamatan Kepala Desa
            'kabupaten'        => 'required|min_length[3]', // Kabupaten Kepala Desa
            'kantor'           => 'required|min_length[3]',
            'alamat'           => 'required|min_length[5]',
            'desa'             => 'required|min_length[3]',
            'kecamatan_desa'   => 'required|min_length[3]',
            'kabupaten_desa'   => 'required|min_length[3]',
            'provinsi'         => 'required|min_length[3]',
        ];

        // Tambahkan aturan validasi untuk file hanya jika file diupload
        if ($this->request->getFile('ktp') && $this->request->getFile('ktp')->isValid() && !$this->request->getFile('ktp')->hasMoved()) {
            $rules['ktp'] = 'uploaded[ktp]|max_size[ktp,2048]|ext_in[ktp,jpg,jpeg,png,pdf]';
        }
        if ($this->request->getFile('kk') && $this->request->getFile('kk')->isValid() && !$this->request->getFile('kk')->hasMoved()) {
            $rules['kk'] = 'uploaded[kk]|max_size[kk,2048]|ext_in[kk,jpg,jpeg,png,pdf]';
        }

        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // 2. Penanganan Upload File (jika ada file baru)
        $ktpName = $surat['ktp']; // Pertahankan nama file lama
        $kkName = $surat['kk'];   // Pertahankan nama file lama

        $ktpFile = $this->request->getFile('ktp');
        if ($ktpFile && $ktpFile->isValid() && !$ktpFile->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($ktpName) && file_exists(ROOTPATH . 'public/uploads/ktp/' . $ktpName)) {
                unlink(ROOTPATH . 'public/uploads/ktp/' . $ktpName);
            }
            $ktpName = $ktpFile->getRandomName();
            $ktpFile->move(ROOTPATH . 'public/uploads/ktp', $ktpName);
        }

        $kkFile = $this->request->getFile('kk');
        if ($kkFile && $kkFile->isValid() && !$kkFile->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($kkName) && file_exists(ROOTPATH . 'public/uploads/kk/' . $kkName)) {
                unlink(ROOTPATH . 'public/uploads/kk/' . $kkName);
            }
            $kkName = $kkFile->getRandomName();
            $kkFile->move(ROOTPATH . 'public/uploads/kk', $kkName);
        }

        // 3. Update Data Surat (tabel 'surat')
        // Pastikan 'id' yang digunakan untuk update adalah id dari tabel surat
        $suratData = [
            // 'no_surat' => $this->request->getPost('no_surat'), // no_surat tidak perlu diupdate jika sudah digenerate
            // 'jenis_surat' => 'domisili_bangunan', // ini juga tidak perlu diupdate
            'status' => 'diajukan', // Setel ulang status menjadi 'diajukan' setelah di-edit
            'ktp'    => $ktpName,
            'kk'     => $kkName,
        ];

        // Jika Anda menggunakan hidden input untuk no_surat di form, Anda bisa menyertakannya jika perlu diperbarui.
        // Tapi umumnya no_surat tidak berubah setelah surat dibuat.
        // Jika status_surat bisa berubah, pastikan ada logika untuk itu, saat ini saya set ke 'diajukan'.
        // Saya asumsikan $surat['id'] adalah primary key untuk SuratModel
        $suratModel->update($id, $suratData);


        // 4. Update Data Detail Domisili Bangunan (tabel 'surat_domisili_bangunan')
        // Pastikan Anda mendapatkan id_detail_domisili_bangunan atau update berdasarkan id_surat
        // Menggunakan id_surat untuk update record di detail table
        $domisiliBangunanData = [
            'nama_kepala_desa' => $this->request->getPost('nama_kepala_desa'),
            'jabatan'          => $this->request->getPost('jabatan'),
            'kecamatan'        => $this->request->getPost('kecamatan'),       // Kecamatan Kepala Desa
            'kabupaten'        => $this->request->getPost('kabupaten'),       // Kabupaten Kepala Desa
            'kantor'           => $this->request->getPost('kantor'),
            'alamat'           => $this->request->getPost('alamat'),
            'desa'             => $this->request->getPost('desa'),
            'kecamatan_desa'   => $this->request->getPost('kecamatan_desa'),
            'kabupaten_desa'   => $this->request->getPost('kabupaten_desa'),
            'provinsi'         => $this->request->getPost('provinsi'),
        ];
        
        // Asumsi bahwa $detail['id'] adalah primary key dari tabel surat_domisili_bangunan
        $domisiliBangunanModel->update($detail['id'], $domisiliBangunanData);


        // Opsional: Kirim email notifikasi setelah update jika diperlukan
        // log_message('info', 'Surat Domisili Bangunan ' . $id . ' berhasil diperbarui.');

        return redirect()->to('/masyarakat/data-surat')->with('success', 'Surat Domisili Bangunan berhasil diperbarui.');
    }
}
