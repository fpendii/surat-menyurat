<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'name'           => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email'          => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role'           => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'masyarakat', 'kepala_desa' ],
                'default'    => 'masyarakat',
            ],
            'phone'          => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'address'        => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at'     => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'     => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_user', true); // primary key
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
