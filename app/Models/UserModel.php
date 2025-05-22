<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [
        'name'     => 'required|min_length[3]',
        'email'    => 'required|valid_email|is_unique[users.email,id_user,{id_user}]',
        'password' => 'permit_empty|min_length[6]',
        'role'     => 'required|in_list[admin,masyarakat,kepala_desa]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah digunakan.',
        ],
    ];

    protected $skipValidation = false;
}
