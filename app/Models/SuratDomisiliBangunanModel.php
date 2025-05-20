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
        'nama_gapoktan',
        'tgl_pembentukan',
        'alamat',
        'ketua',
        'sekretaris',
        'bendahara',
    ];
}
