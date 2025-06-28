<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SuratController extends BaseController
{
    public function surat()
    {
        $data['suratList'] = [
            ['nama' => 'Surat Domisili Kelompok Tani', 'slug' => 'domisili-kelompok-tani', 'deskripsi' => 'Surat keterangan tempat tinggal untuk kelompok tani.'],
            ['nama' => 'Surat Domisili Bangunan', 'slug' => 'domisili-bangunan', 'deskripsi' => 'Surat keterangan lokasi bangunan.'],
            ['nama' => 'Surat Domisili Warga', 'slug' => 'domisili-warga', 'deskripsi' => 'Surat keterangan tempat tinggal untuk individu.'],
            ['nama' => 'Surat Keterangan Usaha', 'slug' => 'usaha', 'deskripsi' => 'Surat bukti menjalankan usaha.'],
            ['nama' => 'Surat Keterangan Tidak Mampu', 'slug' => 'tidak-mampu', 'deskripsi' => 'Surat keterangan tidak mampu secara ekonomi.'],
            ['nama' => 'Surat Keterangan Belum Bekerja', 'slug' => 'belum-bekerja', 'deskripsi' => 'Surat keterangan belum memiliki pekerjaan.'],
            ['nama' => 'Surat Keterangan Kehilangan', 'slug' => 'kehilangan', 'deskripsi' => 'Surat keterangan kehilangan barang atau dokumen.'],
            ['nama' => 'Surat Pengantar Keterangan Catatan Kepolisian', 'slug' => 'catatan-polisi', 'deskripsi' => 'Surat keterangan catatan kepolisian.'],
            ['nama' => 'Surat Keterangan Kelahiran', 'slug' => 'kelahiran', 'deskripsi' => 'Surat keterangan kelahiran.'],
            ['nama' => 'Surat Keterangan Kematian', 'slug' => 'kematian', 'deskripsi' => 'Surat keterangan kematian.'],
            ['nama' => 'Surat Keterangan Status Perkawinan', 'slug' => 'status-perkawinan', 'deskripsi' => 'Surat keterangan status perkawinan.'],
        ];

        return view('masyarakat/surat/surat', $data);
    }
}
