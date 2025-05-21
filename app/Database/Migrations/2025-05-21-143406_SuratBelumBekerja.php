<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratBelumBekerja extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_belum_bekerja' => [
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
                'constraint' => 100,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
            ],
            'ttl' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'status_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'warga_negara' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id_belum_bekerja', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_belum_bekerja');
    }

    public function down()
    {
        $this->forge->dropTable('surat_belum_bekerja');
    }
}
