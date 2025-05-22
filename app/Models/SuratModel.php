<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    protected $allowedFields = [
        'status_surat',
        'id_user',
        'no_surat',
        'jenis_surat',
        'kk',
        'ktp',
        'form_f1',
        'catatan',
    ];
    protected $useTimestamps = true;
}
