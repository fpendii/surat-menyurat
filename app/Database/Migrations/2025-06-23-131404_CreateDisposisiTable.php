<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDisposisiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_disposisi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // Umumnya ID primary key unsigned jika auto_increment
                'auto_increment' => true,
            ],
            'id_surat_masuk' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, // int tidak unsigned
                'null'       => false, // Sesuai dengan tabel Anda (NO)
            ],
            'surat_dari' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'tanggal_surat' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tanggal_diterima' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'nomor_agenda' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'sifat' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'perihal' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, // int tidak unsigned
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addPrimaryKey('id_disposisi');
        // Menambahkan foreign key ke tabel 'surat_masuk'
        // Pastikan tabel 'surat_masuk' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat_masuk', 'surat_masuk', 'id_surat_masuk', 'CASCADE', 'CASCADE');
        // Menambahkan foreign key ke tabel 'users'
        // Pastikan tabel 'users' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'SET NULL', 'CASCADE'); // Gunakan SET NULL karena id_user nullable
        $this->forge->createTable('disposisi');
    }

    public function down()
    {
        $this->forge->dropTable('disposisi');
    }
}