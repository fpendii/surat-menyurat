<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratAhliWarisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_ahli_waris' => [
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
            'pemilik_harta' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'surat_nikah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'surat_kematian' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_surat_ahli_waris');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_ahli_waris');
    }

    public function down()
    {
        $this->forge->dropTable('surat_ahli_waris');
    }
}