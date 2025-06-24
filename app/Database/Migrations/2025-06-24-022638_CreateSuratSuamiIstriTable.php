<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratSuamiIstriTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_suami_istri' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // Pastikan ini sesuai dengan id_surat di tabel lain jika ini adalah foreign key
            ],
            'nama_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'ttl_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'agama_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'status_sebelum_nikah_suami' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'alamat_suami' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nama_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'ttl_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'agama_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'status_sebelum_nikah_istri' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'alamat_istri' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'hari_nikah' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'tbt_nikah' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'tempat_akat_nikah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'wali_nikah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'mahar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'saksi_nikah' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'jumlah_anak' => [
                'type'    => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null'    => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_surat_suami_istri');
        $this->forge->addKey('id_surat');
        $this->forge->createTable('surat_suami_istri'); // Nama tabel diubah di sini
    }

    public function down()
    {
        $this->forge->dropTable('surat_suami_istri'); // Nama tabel diubah di sini
    }
}