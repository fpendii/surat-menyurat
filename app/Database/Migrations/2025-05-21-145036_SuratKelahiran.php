<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKelahiran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelahiran'             => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama'           => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'ttl'            => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_kelamin'  => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'pekerjaan'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat'         => [
                'type' => 'TEXT',
            ],
            'nama_ayah'      => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nama_ibu'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'anak_ke'        => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
        ]);

        $this->forge->addKey('id_kelahiran', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_kelahiran');
    }

    public function down()
    {
        $this->forge->dropTable('surat_kelahiran');
    }
}
