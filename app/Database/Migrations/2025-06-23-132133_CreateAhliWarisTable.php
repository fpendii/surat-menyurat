<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAhliWarisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ahli_waris' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // Umumnya ID primary key unsigned jika auto_increment
                'auto_increment' => true,
            ],
            'id_surat_ahli_waris' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, // int tidak unsigned
                'null'       => false, // Sesuai dengan tabel Anda (NO)
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
            'hubungan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'file_ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'file_kk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'file_akta_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_ahli_waris');
        // Menambahkan foreign key ke tabel 'surat_ahli_waris'
        // Pastikan tabel 'surat_ahli_waris' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat_ahli_waris', 'surat_ahli_waris', 'id_surat_ahli_waris', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ahli_waris');
    }

    public function down()
    {
        $this->forge->dropTable('ahli_waris');
    }
}