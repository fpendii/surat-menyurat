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
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat_masuk' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'surat_dari' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nomor_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_surat' => [
                'type' => 'DATE',
            ],
            'tanggal_diterima' => [
                'type' => 'DATE',
            ],
            'nomor_agenda' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sifat' => [
                'type'       => 'ENUM',
                'constraint' => ['Biasa', 'Segera', 'Rahasia'],
                'default'    => 'Biasa',
            ],
            'perihal' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'diteruskan_kepada' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id_disposisi', true);
        $this->forge->addForeignKey('diteruskan_kepada', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_surat_masuk', 'surat_masuk', 'id_surat_masuk', 'CASCADE', 'CASCADE');
        $this->forge->createTable('disposisi');
    }

    public function down()
    {
        $this->forge->dropTable('disposisi');
    }
}
