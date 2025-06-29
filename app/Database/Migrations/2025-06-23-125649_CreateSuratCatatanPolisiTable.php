<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratCatatanPolisiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_keterangan_polisi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, 
                'null'       => true, 
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'jenis_kelamin' => [
                'type'    => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null'    => false,
            ],
            'tempat_tanggal_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'status_perkawinan' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'kewarganegaraan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'akta_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'ijazah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'foto_latar_belakang' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_surat_keterangan_polisi');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_catatan_polisi');
    }

    public function down()
    {
        $this->forge->dropTable('surat_catatan_polisi');
    }
}