<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratPindahModel extends Model
{
    protected $table = 'surat_pindah';
    protected $primaryKey = 'id';
    protected $allowedFields = [
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
        'kk',
        'ktp',
        'form_f1',
    ];
    protected $useTimestamps = true;
}
