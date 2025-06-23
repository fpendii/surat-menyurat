<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'role' => [
                'type'    => 'ENUM',
                'constraint' => ['admin', 'masyarakat', 'kepala_desa', 'pegawai'],
                'default' => 'masyarakat',
                'null'    => false,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true, // YES untuk Nullable
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true, // YES untuk Nullable
            ],
            'created_at datetime default current_timestamp', // Menggunakan default current_timestamp
            'updated_at datetime default current_timestamp on update current_timestamp', // Menggunakan default current_timestamp on update
            'is_active' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => false,
            ],
            'activation_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_user');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
