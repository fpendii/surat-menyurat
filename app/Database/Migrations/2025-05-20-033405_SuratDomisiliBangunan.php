<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratDomisiliBangunan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_domisili_bangunan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama_gapoktan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tgl_pembentukan' => [
                'type' => 'DATE',
            ],
            'alamat' => [
                'type'       => 'TEXT',
            ],
            'ketua' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sekretaris' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'bendahara' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);

        $this->forge->addKey('id_surat_domisili_bangunan', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_domisili_bangunan');
    }

    public function down()
    {
        $this->forge->dropTable('surat_domisili_bangunan');
    }
}
