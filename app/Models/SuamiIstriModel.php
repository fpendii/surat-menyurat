<?php

namespace App\Models;

use CodeIgniter\Model;

class SuamiIstriModel extends Model
{
    protected $table      = 'surat_suami_istri'; // Changed from 'suami_istri'
    protected $primaryKey = 'id_surat_suami_istri'; // Changed from 'id_suami_istri'

    protected $allowedFields = [
        'id_surat',
        'nama_suami',
        'nik_suami',        // Added NIK fields
        'ttl_suami',
        'agama_suami',
        'status_sebelum_nikah_suami', // New field
        'alamat_suami',
        'nama_istri',
        'nik_istri',        // Added NIK fields
        'ttl_istri',
        'agama_istri',
        'status_sebelum_nikah_istri', // New field
        'alamat_istri',
        'hari_nikah',       // New field
        'tbt_nikah',        // New field
        'tempat_akat_nikah',// New field
        'wali_nikah',       // New field
        'mahar',            // New field
        'saksi_nikah',      // New field
        'jumlah_anak',      // New field
    ];

    // Based on your table structure, you have 'created_at' and 'updated_at' columns.
    // So, it's recommended to enable timestamps.
    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // If you have a 'deleted_at' column for soft deletes:
    // protected $useSoftDeletes = false;
    // protected $deletedField  = 'deleted_at';
}