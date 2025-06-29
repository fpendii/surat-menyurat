<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratKehilanganTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_kehilangan' => [
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
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'ttl' => [ // Tempat Tanggal Lahir
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nik' => [
                'type'       => 'CHAR',
                'constraint' => '16',
                'null'       => false,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'barang_hilang' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'keperluan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'deskripsi_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_surat_kehilangan');
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_kehilangan');
    }

    public function down()
    {
        $this->forge->dropTable('surat_kehilangan');
    }
}