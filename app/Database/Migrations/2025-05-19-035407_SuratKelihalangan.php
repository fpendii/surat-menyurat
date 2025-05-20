<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKelihalangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_kehilangan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'ttl' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nik' => [
                'type'       => 'CHAR',
                'constraint' => 16,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'barang_hilang' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'keperluan' => [
                'type' => 'TEXT',
            ],
            'ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'kk' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_surat_kehilangan', true); // Primary key
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_kehilangan');
    }

    public function down()
    {
        $this->forge->dropTable('surat_kehilangan');
    }
}
