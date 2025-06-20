<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratDomisiliBangunanModel extends Model
{
    protected $table      = 'surat_domisili_bangunan';
    protected $primaryKey = 'id_surat_domisili_bangunan';

    protected $useTimestamps = false;

    protected $allowedFields = [
        'id_surat',
        'nama_kepala_desa',
        'jabatan',
        'kecamatan',
        'kabupaten',
        'kantor',
        'alamat',
        'desa',
        'kecamatan_desa',
        'kabupaten_desa',
        'provinsi'
    ];
}
