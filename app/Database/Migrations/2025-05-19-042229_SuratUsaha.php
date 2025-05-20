<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratUsaha extends Migration
{
     public function up()
    {
        $this->forge->addField([
            'id_surat_usaha' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => '16',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'rt_rw' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'desa' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'kabupaten' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'provinsi' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'nama_usaha' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat_usaha' => [
                'type' => 'TEXT',
            ],
            'sejak_tahun' => [
                'type' => 'YEAR',
            ],
            'kk' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ktp' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id_surat_usaha', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_keterangan_usaha');
    }

    public function down()
    {
        $this->forge->dropTable('surat_keterangan_usaha');
    }
}
