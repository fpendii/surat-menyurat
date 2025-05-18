<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratPindahModel extends Model
{
    protected $table = 'surat_pindah';
    protected $primaryKey = 'id_surat_pindah';
    protected $allowedFields = [
        'id_surat',
        'nama',
        'jenis_kelamin',
        'ttl',
        'kewarganegaraan',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan',
        'alamat_asal',
        'nik',
        'tujuan_pindah',
        'alasan_pindah',
        'jumlah_pengikut',
    ];
    protected $useTimestamps = false;
}
