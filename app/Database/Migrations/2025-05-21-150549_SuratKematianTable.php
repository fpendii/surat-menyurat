<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKematianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kematian'            => ['type' => 'INT', 'auto_increment' => true],
             'id_surat'            => [
                'type' => 'INT',
                'null' => true
            ],
            'nama'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'jenis_kelamin' => ['type' => 'ENUM', 'constraint' => ['Laki-laki', 'Perempuan']],
            'ttl'           => ['type' => 'VARCHAR', 'constraint' => 255],
            'agama'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'hari_tanggal'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'jam'           => ['type' => 'TIME'],
            'tempat'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'penyebab'      => ['type' => 'TEXT'],
        ]);

        $this->forge->addKey('id_kematian', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');

        $this->forge->createTable('surat_kematian');
    }

    public function down()
    {
        $this->forge->dropTable('surat_kematian');
    }
}
