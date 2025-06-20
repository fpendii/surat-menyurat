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
            'nama_kepala_desa' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kabupaten' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kantor' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'desa' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kecamatan_desa' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'kabupaten_desa' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
