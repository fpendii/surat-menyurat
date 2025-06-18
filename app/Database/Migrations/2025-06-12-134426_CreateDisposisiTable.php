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
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_diterima' => [
                'type' => 'DATE',
            ],
            'tujuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'catatan' => [
                'type' => 'TEXT',
            ],
            'tanggal_disposisi' => [
                'type' => 'DATE',
            ],
            'id_pegawai' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id_disposisi', true);
        $this->forge->addForeignKey('id_pegawai', 'pegawai', 'id_pegawai', 'CASCADE', 'CASCADE');
        $this->forge->createTable('disposisi');
    }

    public function down()
    {
        $this->forge->dropTable('disposisi');
    }
}
