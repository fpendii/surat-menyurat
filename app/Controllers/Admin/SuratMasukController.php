<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel;
use CodeIgniter\Files\File;
use Config\Services;

class SuratMasukController extends BaseController
{
    protected $suratMasukModel;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
    }

    // Menampilkan daftar surat masuk
    public function index()
    {
        $data = [
            'surat_masuk' => $this->suratMasukModel->findAll()
        ];
        return view('admin/surat-masuk/index', $data);
    }

    // Menampilkan form untuk menambah surat masuk baru
    public function tambah()
    {
        return view('admin/surat-masuk/tambah');
    }

    // Menangani pengiriman form surat masuk baru
    public function simpan()
    {
        // Validasi input
        $rules = [
            'jenis_surat' => 'required|min_length[3]|max_length[255]',
            'file_surat'  => 'uploaded[file_surat]|max_size[file_surat,10240]|ext_in[file_surat,pdf,jpg,jpeg,png]', // Max 10MB, PDF/JPG/PNG only
            'nama_instansi' => 'required|min_length[3]|max_length[255]',
            'no_surat' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file_surat');
        $newName = $file->getRandomName();

        if ($file->isValid() && ! $file->hasMoved()) {
            $file->move(ROOTPATH . 'public/uploads/surat_masuk', $newName);

            $this->suratMasukModel->save([
                'jenis_surat' => $this->request->getPost('jenis_surat'),
                'file_surat'  => $newName,
                'nama_instansi' => $this->request->getPost('nama_instansi'),
                'no_surat' => $this->request->getPost('no_surat'),
                'tanggal_surat' => $this->request->getPost('tanggal_surat') ?: date('Y-m-d'), // Default to today if not provided
            ]);

            // --- Bagian Baru: Mengirim Email Pemberitahuan ---
            $email = Services::email();

            // Konfigurasi email penerima (ganti dengan email kepala desa yang sebenarnya)
            $kepalaDesaEmail = 'kepaladesa.suruk@gmail.com'; // GANTI DENGAN EMAIL KEPALA DESA YANG VALID!

            $subject = 'Pemberitahuan: Ada Surat Masuk Baru di Sistem Arsip Desa';
            $message = "Yth. Bapak/Ibu Kepala Desa,\n\n";
            $message .= "Ada surat masuk baru yang telah diunggah ke sistem arsip desa.\n\n";
            $message .= "Detail Surat:\n";
            $message .= "Jenis Surat: " . esc($this->request->getPost('jenis_surat')) . "\n";
            $message .= "Waktu Upload: " . date('Y-m-d H:i:s') . "\n\n";
            $message .= "Silakan login ke sistem untuk melihat detail lengkap dan melakukan disposisi.\n";
            $message .= "Link Sistem: " . base_url('login') . " (atau link ke dashboard admin)\n\n";
            $message .= "Terima kasih.";

            $email->setTo($kepalaDesaEmail);
            $email->setSubject($subject);
            $email->setMessage($message);

            if ($email->send()) {
                session()->setFlashdata('success', 'Surat masuk berhasil ditambahkan dan notifikasi email telah dikirim ke Kepala Desa!');
            } else {
                // Opsional: Untuk debugging jika email gagal dikirim
                // echo $email->printDebugger(['headers']);
                session()->setFlashdata('success', 'Surat masuk berhasil ditambahkan, namun gagal mengirim notifikasi email ke Kepala Desa.');
            }
            // --- Akhir Bagian Baru ---

            return redirect()->to(base_url('/admin/surat-masuk'));
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file.');
        }
    }

    // Menangani penghapusan surat masuk
    public function hapus($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('admin/surat-masuk'))->with('error', 'ID surat masuk tidak ditemukan.');
        }

        // Ambil nama file sebelum menghapus record
        $surat = $this->suratMasukModel->find($id);
        if ($surat && $surat['file_surat']) {
            $filePath = ROOTPATH . 'public/uploads/surat_masuk/' . $surat['file_surat'];
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file fisik
            }
        }

        if ($this->suratMasukModel->delete($id)) {
            return redirect()->to(base_url('admin/surat-masuk'))->with('success', 'Surat masuk berhasil dihapus!');
        } else {
            return redirect()->to(base_url('admin/surat-masuk'))->with('error', 'Gagal menghapus surat masuk.');
        }
    }

    // Menampilkan form edit surat masuk
    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('admin/surat-masuk'))->with('error', 'ID surat masuk tidak ditemukan.');
        }

        $surat = $this->suratMasukModel->find($id);
        if (!$surat) {
            return redirect()->to(base_url('admin/surat-masuk'))->with('error', 'Surat masuk tidak ditemukan.');
        }

        $data = [
            'surat' => $surat
        ];
        return view('admin/surat-masuk/edit', $data);
    }

    // Menangani pembaruan data surat masuk
    public function update($id = null)
    {

        if ($id === null) {
            return redirect()->to(base_url('admin/surat-masuk'))->with('error', 'ID surat masuk tidak ditemukan.');
        }

        // Ambil data surat yang sudah ada untuk referensi file lama
        $existingSurat = $this->suratMasukModel->find($id);
        if (!$existingSurat) {
            return redirect()->to(base_url('admin/surat-masuk'))->with('error', 'Surat masuk tidak ditemukan.');
        }

        // Aturan validasi
        $rules = [
            'jenis_surat' => 'required|min_length[3]|max_length[255]',
            'nama_instansi' => 'required|min_length[3]|max_length[255]',
            'no_surat' => 'required'
            
        ];

        // Jika ada file baru diunggah, tambahkan aturan validasi untuk file
        $file = $this->request->getFile('file_surat');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $rules['file_surat'] = 'uploaded[file_surat]|max_size[file_surat,10240]|ext_in[file_surat,pdf,jpg,jpeg,png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataToUpdate = [
            'jenis_surat' => $this->request->getPost('jenis_surat'),
            'nama_instansi' => $this->request->getPost('nama_instansi'),
            'no_surat' => $this->request->getPost('no_surat'),
            'tanggal_surat' => $this->request->getPost('tanggal_surat') ?: date('Y-m-d'), // Default to today if not provided
        ];

        // Tangani upload file jika ada file baru
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada
            if ($existingSurat['file_surat']) {
                $oldFilePath = ROOTPATH . 'public/uploads/surat_masuk/' . $existingSurat['file_surat'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            // Pindahkan file baru
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/surat_masuk', $newName);
            $dataToUpdate['file_surat'] = $newName;
        }

        // Lakukan update data
        if ($this->suratMasukModel->update($id, $dataToUpdate)) {
            session()->setFlashdata('success', 'Surat masuk berhasil diperbarui!');
            return redirect()->to(base_url('/admin/surat-masuk'));
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui surat masuk.');
            return redirect()->back()->withInput();
        }
    }
}