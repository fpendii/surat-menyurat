<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratPengantarKkKtpModel extends Model
{
    protected $table      = 'surat_pengantar_kk_ktp';
    protected $primaryKey = 'id_pengantar';

    protected $allowedFields = [
        'id_surat',
        'nama',
        'no_kk',
        'nik',
        'keterangan',
        'jumlah',
    ];

    public $useTimestamps = false; // Tidak menggunakan created_at dan updated_at
}
