<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\Hash;
use CodeIgniter\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $dataPegawai = [
            [
                'name'     => 'Budi Santoso',
                'email'    => 'budi@example.com',
                'password' => 'password123',
                'phone'    => '081234567890',
                'address'  => 'Jl. Merdeka No. 1',
                'role'     => 'kepala_desa',
                'nip'      => '198001012005011001',
                'jabatan'  => 'Kepala Desa',
            ],
            [
                'name'     => 'Siti Aminah',
                'email'    => 'siti@example.com',
                'password' => 'password123',
                'phone'    => '081234567891',
                'address'  => 'Jl. Pahlawan No. 2',
                'role'     => 'kepala_desa',
                'nip'      => '198305102006021002',
                'jabatan'  => 'Sekretaris Desa',
            ],
            [
                'name'     => 'Andi Wijaya',
                'email'    => 'andi@example.com',
                'password' => 'password123',
                'phone'    => '081234567892',
                'address'  => 'Jl. Kenanga No. 3',
                'role'     => 'kepala_desa',
                'nip'      => '199001152010031003',
                'jabatan'  => 'Bendahara',
            ],
        ];

        foreach ($dataPegawai as $pegawai) {
            // Insert ke tabel users
            $userId = DB::table('users')->insertGetId([
                'name'            => $pegawai['name'],
                'email'           => $pegawai['email'],
                'password'        => Hash::make($pegawai['password']),
                'phone'           => $pegawai['phone'],
                'address'         => $pegawai['address'],
                'role'            => $pegawai['role'],
                'is_active'       => 1,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
                'activation_code' => null,
            ]);

            // Insert ke tabel pegawais
            DB::table('pegawais')->insert([
                'id_user'   => $userId,
                'nama'      => $pegawai['name'],
                'nip'       => $pegawai['nip'],
                'jabatan'   => $pegawai['jabatan'],
                'alamat'    => $pegawai['address'],
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ]);
        }
    }
}
