<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratTidakMampuModel extends Model
{
    protected $table = 'surat_tidak_mampu';
    protected $primaryKey = 'id_tidak_mampu';

    protected $allowedFields = [
        'id_surat',
        'nama',
        'bin_binti',
        'nik',
        'ttl',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'alamat',
        'keperluan',
        'ktp',
        'kk',
    ];

    protected $useTimestamps = false;
}
