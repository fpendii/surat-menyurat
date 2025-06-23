<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratKematianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kematian' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // Umumnya ID primary key unsigned jika auto_increment
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
                'constraint' => '255',
                'null'       => false,
            ],
            'jenis_kelamin' => [
                'type'    => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null'    => false,
            ],
            'ttl' => [ // Tempat Tanggal Lahir
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'hari_tanggal' => [ // Bisa juga menggunakan DATE atau DATETIME jika formatnya konsisten
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'jam' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'tempat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'penyebab' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_kematian');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_kematian');
    }

    public function down()
    {
        $this->forge->dropTable('surat_kematian');
    }
}