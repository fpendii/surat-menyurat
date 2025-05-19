<?php

namespace App\Models;

use CodeIgniter\Model;

class CatatanPolisiModel extends Model
{
   protected $table = 'surat_catatan_polisi';
    protected $primaryKey = 'id_surat_keterangan_polisi'; // sesuai migration

    protected $allowedFields = [
        'id_surat',
        'nama',
        'jenis_kelamin',
        'tempat_tanggal_lahir',
        'status_perkawinan',
        'kewarganegaraan',
        'agama',
        'pekerjaan',
        'nik',
        'alamat',
        'kk',
        'ktp',
        'akta_lahir',
        'ijazah',
        'foto_latar_belakang',
    ];

    protected $useTimestamps = false;
}
