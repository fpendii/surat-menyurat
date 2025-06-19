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
            'id_surat' => [
                'type' => 'INT',
                'null' => true
            ],
            'nama_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => 'Contoh: "Taman Kanak-Kanak SARTIKA"',
            ],
            'alamat_instansi' => [
                'type'       => 'TEXT',
                'comment'    => 'Contoh: "Handil Suruk RT 003 RW 001"',
            ],
            'desa_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Contoh: "Handil Suruk"',
            ],
            'kecamatan_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Contoh: "Bumi Makmur"',
            ],
            'kabupaten_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Contoh: "Tanah Laut"',
            ],
            'provinsi_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Contoh: "Kalimantan Selatan"',
            ],
            'nama_pejabat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Contoh: "Khalikul Bashir"',
            ],
            'jabatan_pejabat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Contoh: "Kepala Desa"',
            ],
            'desa_pejabat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'Contoh: "Handil Suruk"',
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