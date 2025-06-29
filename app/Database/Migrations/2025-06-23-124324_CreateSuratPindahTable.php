<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuratPindahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_pindah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // Umumnya ID primary key unsigned jika auto_increment
                'auto_increment' => true,
            ],
            'id_surat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => false, // int tidak unsigned
                'null'       => false, // Sesuai dengan tabel Anda (NO)
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
            'ttl' => [ // Tempat Tanggal Lahir
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'kewarganegaraan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'status_perkawinan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'alamat_asal' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nik' => [ // NIK mungkin merupakan duplikasi jika sudah ada id_user atau nama
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'tujuan_pindah' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alasan_pindah' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'jumlah_pengikut' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'status' => [
                'type'    => 'ENUM',
                'constraint' => ['diajukan', 'diproses', 'ditolak', 'selesai'],
                'default' => 'diajukan',
                'null'    => true, // Sesuai dengan tabel Anda (YES)
            ],
        ]);

        $this->forge->addPrimaryKey('id_surat_pindah');
        // Menambahkan foreign key ke tabel 'surat'
        // Pastikan tabel 'surat' sudah ada sebelum migration ini dijalankan
        $this->forge->addForeignKey('id_surat', 'surat', 'id_surat', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_pindah');
    }

    public function down()
    {
        $this->forge->dropTable('surat_pindah');
    }
}