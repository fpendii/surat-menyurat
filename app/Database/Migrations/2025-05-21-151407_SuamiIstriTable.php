<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuamiIstriTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_suami_istri' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
             'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'nik_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'ttl_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'agama_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'alamat_suami' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'nama_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'nik_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'ttl_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'agama_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'alamat_istri' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id_suami_istri', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');

        $this->forge->createTable('suami_istri');
    }

    public function down()
    {
        $this->forge->dropTable('suami_istri');
    }
}
