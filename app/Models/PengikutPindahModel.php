<?php

namespace App\Models;

use CodeIgniter\Model;

class PengikutPindahModel extends Model
{
    protected $table = 'pengikut_pindah';
    protected $primaryKey = 'id_pengikut_pindah';
    protected $allowedFields = [
        'id_surat_pindah',
        'nama',
        'jenis_kelamin',
        'umur',
        'status_perkawinan',
        'pendidikan',
        'no_ktp',
    ];
    protected $useTimestamps = false;
}
