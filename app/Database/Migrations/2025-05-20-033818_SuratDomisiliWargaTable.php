<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratDomisiliWargaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_domisili_warga' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama_pejabat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kecamatan_pejabat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kabupaten_pejabat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_warga' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'alamat' => [
                'type'       => 'TEXT',
            ],
            'desa' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kabupaten' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);

        $this->forge->addKey('id_domisili_warga', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');

        $this->forge->createTable('surat_domisili_warga');
    }

    public function down()
    {
        $this->forge->dropTable('surat_domisili_warga');
    }
}
