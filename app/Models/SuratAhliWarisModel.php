<?php

namespace App\Models;

use CodeIgniter\Model;


class SuratAhliWarisModel extends Model
{
    protected $table            = 'surat_ahli_waris';
    protected $primaryKey       = 'id_surat_ahli_waris';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'id_surat',
        'pemilik_harta',
        'surat_nikah',
    ];

    protected $useTimestamps = false;
}

