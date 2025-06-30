<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FileController extends BaseController
{
    public function lihat($folder, $filename)
    {
        $path = WRITEPATH . '../public/uploads/' . $folder . '/' . $filename;


        if (!file_exists($path)) {
            return "File tidak ditemukan.";
        }

        // Set header agar file bisa ditampilkan di browser
        return response()
            ->setHeader('Content-Type', mime_content_type($path))
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody(file_get_contents($path));
    }

    public function lihatSuratKeluar($filename)
    {
        $path = WRITEPATH . '../public/uploads/surat_dikirim/' . $filename;
        if (!file_exists($path)) {
            return "File tidak ditemukan.";
        }

        // Set header agar file bisa ditampilkan di browser
        return response()
            ->setHeader('Content-Type', mime_content_type($path))
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody(file_get_contents($path));
    }
}
