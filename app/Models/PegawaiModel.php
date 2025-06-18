<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id_pegawai';
    protected $allowedFields    = ['id_user', 'nama_pegawai', 'jabatan'];
    protected $useTimestamps    = true;
}
