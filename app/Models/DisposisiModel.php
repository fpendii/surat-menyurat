<?php

namespace App\Models;

use CodeIgniter\Model;

class DisposisiModel extends Model
{
    protected $table            = 'disposisi';
    protected $primaryKey       = 'id_disposisi';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id_surat_masuk',
        'surat_dari',
        'nomor_surat',
        'tanggal_surat',
        'tanggal_diterima',
        'nomor_agenda',
        'sifat',
        'perihal',
        'diteruskan_kepada',
        'catatan',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'surat_dari'        => 'required',
        'nomor_surat'       => 'required',
        'tanggal_surat'     => 'required|valid_date',
        'tanggal_diterima'  => 'required|valid_date',
        'nomor_agenda'      => 'required',
        'sifat'             => 'required|in_list[Biasa,Segera,Rahasia]',
        'perihal'           => 'required',
        'diteruskan_kepada' => 'required|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'diteruskan_kepada' => [
            'is_natural_no_zero' => 'Field ini wajib dipilih dan tidak boleh nol.'
        ],
        'sifat' => [
            'in_list' => 'Sifat surat harus Biasa, Segera, atau Rahasia.'
        ]
    ];

    protected $skipValidation = false;
}
