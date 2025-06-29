<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_surat_masuk';
    protected $allowedFields = ['jenis_surat', 'file_surat','tanggal_surat', 'no_surat','nama_instansi'];
    protected $useTimestamps = true;
}
