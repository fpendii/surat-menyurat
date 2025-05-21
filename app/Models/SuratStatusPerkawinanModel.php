<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratStatusPerkawinanModel extends Model
{
    protected $table      = 'surat_status_perkawinan';
    protected $primaryKey = 'id_status_perkawinan';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_surat',
        'nama',
        'nik',
        'ttl',
        'agama',
        'alamat',
        'status',
    ];

    // Jika ingin otomatis timestamp created_at dan updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
