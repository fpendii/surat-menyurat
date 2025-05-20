<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratTidakMampu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tidak_mampu' => [
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
            'bin_binti' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
            ],
            'ttl' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat' => [
                'type' => 'TEXT',
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

        $this->forge->addKey('id_tidak_mampu', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_tidak_mampu');
    }

    public function down()
    {
        $this->forge->dropTable('surat_tidak_mampu');
    }
}
