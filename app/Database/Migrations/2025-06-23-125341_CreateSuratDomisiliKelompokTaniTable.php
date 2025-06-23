<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratDomisiliKelompokTaniTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_domisili' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, // int tidak unsigned
                'null'       => true, // Sesuai dengan tabel Anda (YES)
            ],
            'nama_gapoktan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'tgl_pembentukan' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'ketua' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'sekretaris' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'bendahara' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id_domisili');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_domisili_kelompok_tani');
    }

    public function down()
    {
        $this->forge->dropTable('surat_domisili_kelompok_tani');
    }
}