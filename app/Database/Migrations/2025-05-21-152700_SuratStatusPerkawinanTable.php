<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratStatusPerkawinanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status_perkawinan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
             'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'ttl' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'alamat' => [
                'type'       => 'TEXT',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id_status_perkawinan', true);
        // Asumsikan ada tabel surat, dan id_surat adalah foreign key
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');

        $this->forge->createTable('surat_status_perkawinan');
    }

    public function down()
    {
        $this->forge->dropTable('surat_status_perkawinan');
    }
}
