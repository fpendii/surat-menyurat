<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratTidakMampuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tidak_mampu' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, // int tidak unsigned
                'null'       => true, // Sesuai dengan Null = YES
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'bin_binti' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null'       => false,
            ],
            'ttl' => [ // Tempat Tanggal Lahir
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'jenis_kelamin' => [
                'type'    => 'ENUM',
                'constraint' => ['L', 'P'],
                'null'    => false,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'keperluan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'kk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_tidak_mampu');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_tidak_mampu');
    }

    public function down()
    {
        $this->forge->dropTable('surat_tidak_mampu');
    }
}