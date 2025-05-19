<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AhliWaris extends Migration
{
    public function up()
    {
        // Tabel ahli_waris
        $this->forge->addField([
            'id_ahli_waris'              => ['type' => 'INT', 'auto_increment' => true],
            'id_surat_ahli_waris'        => ['type' => 'INT'],
            'nama'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'nik'             => ['type' => 'VARCHAR', 'constraint' => 50],
            'ttl'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'hubungan'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_ktp'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_kk'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'file_akta_lahir' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id_ahli_waris', true);
        $this->forge->addForeignKey('id_surat_ahli_waris', 'surat_ahli_waris', 'id_surat_ahli_waris', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ahli_waris');
    }

    public function down()
    {
        $this->forge->dropTable('ahli_waris');
    }
}
