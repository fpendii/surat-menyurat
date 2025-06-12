<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_surat_masuk';
    protected $allowedFields = ['jenis_surat', 'file_surat'];
    protected $useTimestamps = true;
}