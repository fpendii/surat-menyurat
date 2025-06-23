<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratStatusPerkawinanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status_perkawinan' => [
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
                'constraint' => '255',
                'null'       => false,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'ttl' => [ // Tempat Tanggal Lahir
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true, // Sesuai dengan Null = YES
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true, // Sesuai dengan Null = YES
            ],
        ]);

        $this->forge->addPrimaryKey('id_status_perkawinan');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_status_perkawinan');
    }

    public function down()
    {
        $this->forge->dropTable('surat_status_perkawinan');
    }
}