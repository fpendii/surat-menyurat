<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKelahiranModel extends Model
{
  protected $table            = 'surat_kelahiran';
    protected $primaryKey       = 'id_kelahiran';
    protected $useAutoIncrement= true;

    protected $allowedFields    = [
        'id_surat',
        'nama',
        'ttl',
        'jenis_kelamin',
        'pekerjaan',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'anak_ke',
    ];

    protected $useTimestamps = false;
}
