<?php

namespace App\Controllers\KepalaDesa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratModel;
use App\Models\SuratKehilanganModel;
use App\Models\SuratPindahModel;
use App\Models\UserModel;

class PengajuanSuratController extends BaseController
{
    protected $suratModel;
    protected $suratKehilanganModel;
    protected $suratPindahModel;
    protected $userModel;
    public function __construct()
    {
        $this->suratModel = new SuratModel();
        $this->suratKehilanganModel = new SuratKehilanganModel();
        $this->suratPindahModel = new SuratPindahModel();
        $this->userModel = new UserModel();
    }
    public function pengajuanSurat()
    {
        $dataSurat = $this->suratModel->where('status_surat', 'diajukan')->findAll();
        $data = [
            'dataSurat' => $dataSurat,
        ];
        return view('kepala-desa/pengajuan-surat/pengajuan-surat', $data);
    }
    public function konfirmasiSurat($id_surat)
    {
        // Ambil data surat dari model
        $dataSurat = $this->suratModel->find($id_surat);
        $aksi = $this->request->getPost('aksi');

        if ($aksi == 'revisi') {
            return redirect()->to('/kepala-desa/pengajuan-surat/revisi/' . $id_surat);
        }

        if ($dataSurat) {
            // Ubah status surat
            $this->suratModel->update($id_surat, ['status_surat' => $aksi]);

            // Jika surat di-ACC, kirim email ke pengaju
            if ($aksi == 'proses') {
                // Ambil data user pengaju
                $userModel = new \App\Models\UserModel();
                $user = $userModel->find($dataSurat['id_user']);
                $admin = $userModel->where('role', 'admin')->first(); // Ambil data admin

                if ($user && isset($user['email'])) {
                    $email = \Config\Services::email();
                    $email->setTo($admin['email']);
                    $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
                    $email->setSubject('Revisi Pengajuan Surat');
                    $email->setMessage(
                        "Halo <strong>{$user['name']}</strong>,<br><br>" .
                            "Pengajuan surat dengan nomor <strong>{$dataSurat['no_surat']}</strong> telah <strong>disetujui</strong> oleh Kepala Desa.<br>" .
                            "Silakan unggah surat yang telah ditandatangani untuk dikirim ke pemohon melalui sistem.<br><br>" .
                            "Terima kasih."
                    );


                    if (!$email->send()) {
                        log_message('error', 'Gagal mengirim email ke ' . $user['email'] . ': ' . $email->printDebugger(['headers']));
                    }
                }
            }

            return redirect()->to('/kepala-desa/pengajuan-surat')->with('success', 'Pengajuan surat berhasil diperbarui.');
        } else {
            return redirect()->to('/kepala-desa/pengajuan-surat')->with('error', 'Data surat tidak ditemukan.');
        }
    }


    public function revisiSurat($id_surat)
    {
        $dataSurat = $this->suratModel->find($id_surat);
        $data = [
            'dataSurat' => $dataSurat,
        ];
        return view('kepala-desa/pengajuan-surat/revisi-surat', $data);
    }

    public function kirimRevisi($id_surat)
    {
        $dataSurat = $this->suratModel->find($id_surat);
        $user = $this->userModel->find($dataSurat['id_user']); // Sesuai kolom id_user pada tabel users

        $catatanRevisi = $this->request->getPost('catatan_revisi');
        $data = [
            'catatan' => $catatanRevisi,
            'status_surat' => 'revisi'
        ];

        $this->suratModel->update($id_surat, $data);
        // Kirim email ke user
        $email = \Config\Services::email();
        $email->setTo($user['email']);
        $email->setFrom('desa@example.com', 'Desa Contoh');
        $email->setSubject('Revisi Pengajuan Surat');
        $email->setMessage(
            "Halo <strong>" . esc($user['name']) . "</strong>,<br><br>" .
                "Pengajuan surat Anda dengan nomor <strong>" . esc($dataSurat['no_surat']) . "</strong> memerlukan revisi.<br><br>" .
                "<strong>Catatan Revisi:</strong><br>" .
                "<blockquote>" . nl2br(esc($catatanRevisi)) . "</blockquote>" .
                "<br>Silakan login kembali dan lakukan revisi atas pengajuan Anda.<br><br>Terima kasih."
        );

        if ($email->send()) {
            return redirect()->to('/kepala-desa/pengajuan-surat')->with('success', 'Revisi berhasil dikirim dan email pemberitahuan telah dikirim.');
        } else {

            return redirect()->to('/kepala-desa/pengajuan-surat')->with('error', 'Revisi berhasil, namun email gagal dikirim.');
        }
    }
}
