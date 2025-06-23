<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengikutPindahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengikut_pindah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // Umumnya ID primary key unsigned jika auto_increment
                'auto_increment' => true,
            ],
            'id_surat_pindah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // int tidak unsigned
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
                'null'       => true,
            ],
            'umur' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'status_perkawinan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'no_ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_pengikut_pindah');
        // Menambahkan foreign key ke tabel 'surat_pindah'
        // Pastikan tabel 'surat_pindah' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat_pindah', 'surat_pindah', 'id_surat_pindah', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengikut_pindah');
    }

    public function down()
    {
        $this->forge->dropTable('pengikut_pindah');
    }
}