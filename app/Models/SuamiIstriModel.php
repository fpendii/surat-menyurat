<?php

namespace App\Models;

use CodeIgniter\Model;

class SuamiIstriModel extends Model
{
    protected $table      = 'suami_istri';
    protected $primaryKey = 'id_suami_istri';

    protected $allowedFields = [
        'id_surat',
        'nama_suami',
        'nik_suami',
        'ttl_suami',
        'agama_suami',
        'alamat_suami',
        'nama_istri',
        'nik_istri',
        'ttl_istri',
        'agama_istri',
        'alamat_istri',
    ];

    protected $useTimestamps = false;

    // Jika kamu ingin otomatis handle timestamps created_at dan updated_at,
    // pastikan di tabel ada kolom created_at dan updated_at,
    // lalu aktifkan fitur ini:
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}
