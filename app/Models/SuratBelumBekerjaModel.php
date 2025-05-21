<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratBelumBekerjaModel extends Model
{
    protected $table = 'surat_belum_bekerja';
    protected $primaryKey = 'id_belum_bekerja';
    protected $allowedFields = ['id_surat', 'nama', 'nik', 'ttl', 'jenis_kelamin', 'agama', 'status_pekerjaan', 'warga_negara', 'alamat'];

     protected $useTimestamps = false;
}
