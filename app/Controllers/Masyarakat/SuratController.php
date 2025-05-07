<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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


        return view('masyarakat/surat/preview-surat/preview_domisili_kelompok_tani', $data);
    }


    public function domisiliBangunan()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-bangunan');
    }
    public function domisiliManusia()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-domisili-manusia');
    }
    public function pindah()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-pindah');
    }
    public function usaha()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-usaha');
    }
    public function pengantarKKKTP()
    {
        return view('masyarakat/surat/ajukan-surat/ajukan-surat-pengantar-kk-ktp');
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
