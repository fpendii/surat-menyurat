<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratUsahaModel extends Model
{
    protected $table = 'surat_keterangan_usaha';
    protected $primaryKey = 'id_surat_usaha';

    protected $allowedFields = [
        'id_surat',
        'nama',
        'nik',
        'alamat',
        'rt_rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'nama_usaha',
        'alamat_usaha',
        'sejak_tahun',
        'kk',
        'ktp',
    ];

    // Nonaktifkan fitur timestamps karena tidak ada kolom created_at dan updated_at
    protected $useTimestamps = false;
}
