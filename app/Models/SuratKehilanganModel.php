<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKehilanganModel extends Model
{
    protected $table            = 'surat_kehilangan';
    protected $primaryKey       = 'id_surat_kehilangan';

    protected $allowedFields    = [
        'id_surat',
        'nama',
        'jenis_kelamin',
        'ttl',
        'nik',
        'agama',
        'alamat',
        'barang_hilang',
        'keperluan',
        'ktp',
        'kk'
    ];

    protected $useTimestamps    = false;
}
