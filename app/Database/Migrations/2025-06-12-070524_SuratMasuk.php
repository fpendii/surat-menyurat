<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratMasuk extends Migration
{
    // database/migrations/2024_06_12_000000_create_surat_masuk.php

    public function up()
    {
        $this->forge->addField([
            'id_surat_masuk' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'jenis_surat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'file_surat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_surat_masuk', true);
        $this->forge->createTable('surat_masuk');
    }


    public function down()
    {
        //
    }
}
