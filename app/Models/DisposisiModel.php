<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiModel extends Model
{
    protected $table            = 'disposisi';
    protected $primaryKey       = 'id_disposisi';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id_surat_masuk',
        'surat_dari',
        'tanggal_surat',
        'tanggal_diterima',
        'nomor_agenda',
        'sifat',
        'perihal',
        'id_user',
        'catatan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
