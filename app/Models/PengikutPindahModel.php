<?php

namespace App\Models;

use CodeIgniter\Model;

class PengikutPindahModel extends Model
{
    protected $table = 'pengikut_pindah';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'surat_pindah_id',
        'nama',
        'jenis_kelamin',
        'umur',
        'status_perkawinan',
        'pendidikan',
        'no_ktp',
    ];
    protected $useTimestamps = true;
}
