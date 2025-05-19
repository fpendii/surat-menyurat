<?php

namespace App\Models;

use CodeIgniter\Model;

class AhliWarisModel extends Model
{
    protected $table            = 'ahli_waris';
    protected $primaryKey       = 'id_ahli_waris';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'id_surat_ahli_waris',
        'nama',
        'nik',
        'ttl',
        'hubungan',
        'file_ktp',
        'file_kk',
        'file_akta_lahir',
    ];

    protected $useTimestamps = false;
}
