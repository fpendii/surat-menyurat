<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratCatatanPolisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_keterangan_polisi' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_surat'                   => ['type' => 'INT', 'null' => true],
            'nama'                      => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis_kelamin'             => ['type' => 'ENUM', 'constraint' => ['Laki-laki', 'Perempuan']],
            'tempat_tanggal_lahir'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'status_perkawinan'         => ['type' => 'VARCHAR', 'constraint' => 20],
            'kewarganegaraan'           => ['type' => 'VARCHAR', 'constraint' => 50],
            'agama'                     => ['type' => 'VARCHAR', 'constraint' => 20],
            'pekerjaan'                 => ['type' => 'VARCHAR', 'constraint' => 100],
            'nik'                       => ['type' => 'VARCHAR', 'constraint' => 20],
            'alamat'                    => ['type' => 'TEXT'],

            'kk'                        => ['type' => 'VARCHAR', 'constraint' => 255],
            'ktp'                       => ['type' => 'VARCHAR', 'constraint' => 255],
            'akta_lahir'                => ['type' => 'VARCHAR', 'constraint' => 255],
            'ijazah'                    => ['type' => 'VARCHAR', 'constraint' => 255],
            'foto_latar_belakang'       => ['type' => 'VARCHAR', 'constraint' => 255],

        ]);

        $this->forge->addKey('id_surat_keterangan_polisi', true); // Primary key
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');

        $this->forge->createTable('surat_catatan_polisi');
    }

    public function down()
    {
        $this->forge->dropTable('surat_catatan_polisi');
    }


}
