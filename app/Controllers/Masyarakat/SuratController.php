<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratController extends BaseController
{
    public function index()
    {
        $data['suratList'] = [
            ['nama' => 'Surat Domisili Kelompok Tani', 'slug' => 'domisili-kelompok-tani', 'deskripsi' => 'Surat keterangan tempat tinggal untuk kelompok tani.'],
            ['nama' => 'Surat Domisili Bangunan', 'slug' => 'domisili-bangunan', 'deskripsi' => 'Surat keterangan lokasi bangunan.'],
            ['nama' => 'Surat Domisili Manusia', 'slug' => 'domisili-manusia', 'deskripsi' => 'Surat keterangan tempat tinggal untuk individu.'],
            ['nama' => 'Surat Pindah', 'slug' => 'pindah', 'deskripsi' => 'Surat keterangan pindah domisili.'],
            ['nama' => 'Surat Keterangan Usaha', 'slug' => 'usaha', 'deskripsi' => 'Surat bukti menjalankan usaha.'],
            ['nama' => 'Surat Pengantar KK dan KTP', 'slug' => 'pengantar-kk-ktp', 'deskripsi' => 'Surat pengantar untuk pembuatan KK dan KTP.'],
            ['nama' => 'Surat Keterangan Tidak Mampu', 'slug' => 'tidak-mampu', 'deskripsi' => 'Surat keterangan tidak mampu secara ekonomi.'],
            ['nama' => 'Surat Keterangan Belum Bekerja', 'slug' => 'belum-bekerja', 'deskripsi' => 'Surat keterangan belum memiliki pekerjaan.'],
            ['nama' => 'Surat Keterangan Kehilangan', 'slug' => 'kehilangan', 'deskripsi' => 'Surat keterangan kehilangan barang atau dokumen.'],
            ['nama' => 'Surat Keterangan Catatan Polisi', 'slug' => 'catatan-polisi', 'deskripsi' => 'Surat keterangan dari kepolisian.'],
            ['nama' => 'Surat Keterangan Kelahiran', 'slug' => 'kelahiran', 'deskripsi' => 'Surat keterangan kelahiran.'],
            ['nama' => 'Surat Keterangan Kematian', 'slug' => 'kematian', 'deskripsi' => 'Surat keterangan kematian.'],
            ['nama' => 'Surat Keterangan Ahli Waris', 'slug' => 'ahli-waris', 'deskripsi' => 'Surat yang menyatakan seseorang sebagai ahli waris.'],
            ['nama' => 'Surat Keterangan Suami Istri', 'slug' => 'suami-istri', 'deskripsi' => 'Surat keterangan status pasangan suami istri.'],
            ['nama' => 'Surat Keterangan Janda/Duda/Perjaka', 'slug' => 'status-perkawinan', 'deskripsi' => 'Surat keterangan status janda, duda, atau perjaka.'],
        ];

        return view('masyarakat/surat/index', $data);
    }

    public function domisiliKelompokTani()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-kelompok-tani');
    }

    public function previewDomisiliKelompokTani()
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
        $html = view('masyarakat/surat/preview-surat/preview_domisili_kelompok_tani', $data);
        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_kelompok_tani.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
    }


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



    public function domisiliManusia()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-manusia');
    }

    public function previewDomisiliWarga()
    {
        $data = [
            'nama_pejabat'   => $this->request->getPost('nama_pejabat'),
            'jabatan' => $this->request->getPost('jabatan'),
            'kecamatan_pejabat'          => $this->request->getPost('kecamatan_pejabat'),
            'kabupaten_pejabat'           => $this->request->getPost('kabupaten_pejabat'),
            'nama_warga'      => $this->request->getPost('nama_warga'),
            'nik'       => $this->request->getPost('nik'),
            'alamat'       => $this->request->getPost('alamat'),
            'desa'       => $this->request->getPost('desa'),
            'kecamatan'       => $this->request->getPost('kecamatan'),
            'kabupaten'       => $this->request->getPost('kabupaten'),
            'provinsi'       => $this->request->getPost('provinsi'),
        ];

        $path = FCPATH . 'img/logo.png'; // pastikan path benar
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $imageData = file_get_contents($path); // gunakan variabel baru
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($imageData);

        $data['logo'] = $logo;

        // Render view menjadi HTML
        $html = view('masyarakat/surat/preview-surat/preview_domisili_warga', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream('surat_domisili_warga.pdf', ['Attachment' => false]); // true = download, false = tampil di browser
        exit();
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

    public function tidakMampu()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-tidak-mampu');
    }
    public function belumBekerja()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-belum-bekerja');
    }
    public function kehilangan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kehilangan');
    }
    public function catatanPolisi()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-catatan-polisi');
    }
    public function kelahiran()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kelahiran');
    }
    public function kematian()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-kematian');
    }
    public function ahliWaris()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-ahli-waris');
    }
    public function suamiIstri()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-suami-istri');
    }
    public function statusPerkawinan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-status-perkawinan');
    }
}
