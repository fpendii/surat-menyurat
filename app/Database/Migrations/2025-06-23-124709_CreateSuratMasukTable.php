<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratMasukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_masuk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'jenis_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'file_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'nama_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true, 
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true, // Sesuai dengan tabel Anda (YES)
            ],
            'no_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_surat_masuk');
        $this->forge->createTable('surat_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('surat_masuk');
    }
}