<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat' => [
                'type'           => 'INT',
                'constraint'     => 11, // Sesuaikan dengan panjang int yang Anda inginkan
                'unsigned'       => false, // int tidak unsigned
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11, // Sesuaikan dengan panjang int yang Anda inginkan
                'unsigned'   => false, // int tidak unsigned
                'null'       => false,
            ],
            'no_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status_surat' => [
                'type'    => 'ENUM',
                'constraint' => ['diajukan', 'proses', 'revisi', 'batal', 'selesai'],
                'default' => 'diajukan',
                'null'    => false,
            ],
            'jenis_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'kk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'form_f1' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'file_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_surat');
        // Menambahkan foreign key ke tabel 'users'
        // Pastikan tabel 'users' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat');
    }

    public function down()
    {
        $this->forge->dropTable('surat');
    }
}