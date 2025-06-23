<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratBelumBekerjaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_belum_bekerja' => [
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
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null'    => false,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'status_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'warga_negara' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true, // Sesuai dengan tabel Anda (YES)
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true, // Sesuai dengan tabel Anda (YES)
            ],
        ]);

        $this->forge->addPrimaryKey('id_belum_bekerja');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_belum_bekerja');
    }

    public function down()
    {
        $this->forge->dropTable('surat_belum_bekerja');
    }
}