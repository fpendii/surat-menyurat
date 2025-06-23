<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratKelahiranTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelahiran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, // int tidak unsigned
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'ttl' => [ // Tempat Tanggal Lahir
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
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
            'nama_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nama_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'anak_ke' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_kelahiran');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_kelahiran');
    }

    public function down()
    {
        $this->forge->dropTable('surat_kelahiran');
    }
}