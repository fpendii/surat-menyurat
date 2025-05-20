<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratPengantarKkKtp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengantar' => [
                'type'           => 'INT',
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
            'no_kk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => 16,
            ],
            'keterangan' => [
                'type' => 'TEXT',
            ],
            'jumlah' => [
                'type' => 'INT',
            ],
        ]);

        $this->forge->addKey('id_pengantar', true);
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_pengantar_kk_ktp');
    }

    public function down()
    {
        $this->forge->dropTable('surat_pengantar_kk_ktp');
    }
}
