<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKematianModel extends Model
{
    protected $table = 'surat_kematian';
    protected $primaryKey = 'id_kematian';

    protected $allowedFields = [
        'id_surat',
        'nama',
        'jenis_kelamin',
        'ttl',
        'agama',
        'hari_tanggal',
        'jam',
        'tempat',
        'penyebab',
    ];

    protected $useTimestamps = false;
}
