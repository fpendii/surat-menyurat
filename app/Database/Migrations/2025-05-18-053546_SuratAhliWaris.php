<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratAhliWaris extends Migration
{
    public function up()
    {
        // Tabel surat_ahli_waris
        $this->forge->addField([
            'id_surat_ahli_waris'  => ['type' => 'INT', 'auto_increment' => true],
            'id_surat'      => ['type' => 'INT', 'null' => true],
            'pemilik_harta'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'surat_nikah'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id_surat_ahli_waris', true);
         $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_ahli_waris');
    }

    public function down()
    {
        $this->forge->dropTable('surat_ahli_waris');
    }
}
