<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'      => 'Admin Desa',
                'email'     => 'admin@desa.id',
                'password'  => password_hash('admin123', PASSWORD_DEFAULT),
                'role'      => 'admin',
                'phone'     => '081234567890',
                'address'   => 'Kantor Desa Contoh',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'name'      => 'Kepala Desa',
                'email'     => 'kades@desa.id',
                'password'  => password_hash('kades123', PASSWORD_DEFAULT),
                'role'      => 'kepala_desa',
                'phone'     => '081298765432',
                'address'   => 'Jl. Raya Desa No. 1',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'name'      => 'Warga Biasa',
                'email'     => 'warga@desa.id',
                'password'  => password_hash('warga123', PASSWORD_DEFAULT),
                'role'      => 'masyarakat',
                'phone'     => '089998887777',
                'address'   => 'Dusun 1, Desa Contoh',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
