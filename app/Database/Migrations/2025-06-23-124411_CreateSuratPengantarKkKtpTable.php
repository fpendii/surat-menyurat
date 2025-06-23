<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratPengantarKkKtpTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengantar' => [
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
                'constraint' => '100',
                'null'       => false,
            ],
            'no_kk' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => false,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null'       => false,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_pengantar');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_pengantar_kk_ktp');
    }

    public function down()
    {
        $this->forge->dropTable('surat_pengantar_kk_ktp');
    }
}