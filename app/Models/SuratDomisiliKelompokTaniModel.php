<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratDomisiliKelompokTaniModel extends Model
{
    protected $table            = 'surat_domisili_kelompok_tani';
    protected $primaryKey       = 'id_domisili';

    protected $allowedFields    = [
        'id_surat',
        'nama_gapoktan',
        'tgl_pembentukan',
        'alamat',
        'ketua',
        'sekretaris',
        'bendahara',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // kosong karena tidak pakai updated_at

   

    protected $validationMessages = [];
    protected $skipValidation     = false;
}
