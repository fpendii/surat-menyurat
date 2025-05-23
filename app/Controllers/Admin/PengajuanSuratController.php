<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel;
use App\Models\SuratKehilanganModel;

class PengajuanSuratController extends BaseController
{
    protected $suratModel;
    protected $suratKehilanganModel;
    public function __construct()
    {
        $this->suratModel = new SuratModel();
        $this->suratKehilanganModel = new SuratKehilanganModel();
    }
    public function pengajuanSurat()
    {
        $dataSurat = $this->suratModel->where('status_surat', 'proses')->findAll();
        $data = [
            'dataSurat' => $dataSurat,
        ];
        return view('admin/pengajuan-surat/pengajuan-surat', $data);
    }

    public function kirimSurat($id_surat)
    {
        $file = $this->request->getFile('file_surat');

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'File surat tidak valid atau gagal diunggah.');
        }

        // Buat nama file unik dan pindahkan
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/surat_dikirim', $newName);

        // Update data surat
        $suratModel = new \App\Models\SuratModel();
        $suratModel->update($id_surat, [
            'file_surat' => $newName,
            'status_surat' => 'selesai'
        ]);

        // Ambil data user yang mengajukan surat
        $surat = $suratModel->find($id_surat);
        $userModel = new \App\Models\UserModel(); // Pastikan ada model ini
        $user = $userModel->find($surat['id_user']);

        // Kirim email jika user ditemukan dan email tersedia
        if ($user && !empty($user['email'])) {
            $email = \Config\Services::email();

            $email->setTo($user['email']);
            $email->setSubject('Surat Anda Telah Selesai Diproses');

            $message = "
            <p>Halo <strong>{$user['name']}</strong>,</p>
            <p>Pengajuan surat Anda dengan nomor <strong>{$surat['no_surat']}</strong> telah selesai diproses.</p>
            <p>Anda dapat:</p>
            <ul>
                <li>Mengambil langsung surat di Balai Desa.</li>
                <li>Atau mengunduh surat melalui website pada menu <strong>Arsip Surat</strong>.</li>
            </ul>
            <br>
            <p>Terima kasih.</p>
        ";

            $email->setMessage($message);
            $email->setMailType('html');

            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email ke pengguna: ' . $email->printDebugger(['headers']));
            }
        }

        return redirect()->back()->with('success', 'Surat berhasil dikirim dan email pemberitahuan telah dikirim.');
    }
}
