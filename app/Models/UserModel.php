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
        'name', 'email', 'password', 'role', 'phone', 'address', 'created_at', 'updated_at', 'is_active','activation_code'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah digunakan.',
        ],
    ];

    protected $skipValidation = false;
}
