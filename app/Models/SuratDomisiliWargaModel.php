<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratDomisiliWargaModel extends Model
{
    protected $table = 'surat_domisili_warga';
    protected $primaryKey = 'id_domisili_warga';

    protected $allowedFields = [
        'id_surat',
        'nama_pejabat',
        'jabatan',
        'kecamatan_pejabat',
        'kabupaten_pejabat',
        'nama_warga',
        'nik',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = false;
}
