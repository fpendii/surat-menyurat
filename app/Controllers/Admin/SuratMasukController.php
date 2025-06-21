<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel;
use CodeIgniter\Files\File; // Pastikan ini ada
use Config\Services; // Tambahkan ini untuk menggunakan Services

class SuratMasukController extends BaseController
{
    protected $suratMasukModel;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
    }

    // Displays the list of incoming letters
    public function index()
    {
        $data = [
            'surat_masuk' => $this->suratMasukModel->findAll()
        ];
        return view('admin/surat-masuk/index', $data);
    }

    // Displays the form for adding a new incoming letter
    public function tambah()
    {
        return view('admin/surat-masuk/tambah');
    }

    // Handles the submission of the new incoming letter form
    public function simpan()
    {
        // Validate input
        $rules = [
            'jenis_surat' => 'required|min_length[3]|max_length[255]',
            'file_surat'  => 'uploaded[file_surat]|max_size[file_surat,10240]|ext_in[file_surat,pdf,doc,docx]', // Max 10MB, PDF/DOC/DOCX only
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
            ]);

            // --- Bagian Baru: Mengirim Email Pemberitahuan ---
            $email = Services::email();

            // Konfigurasi email penerima (ganti dengan email kepala desa yang sebenarnya)
            $kepalaDesaEmail = 'norrahmah@mhs.politala.ac.id'; // GANTI DENGAN EMAIL KEPALA DESA YANG VALID!

            $subject = 'Pemberitahuan: Ada Surat Masuk Baru di Sistem Arsip Desa';
            $message = "Yth. Bapak/Ibu Kepala Desa,\n\n";
            $message .= "Ada surat masuk baru yang telah diunggah ke sistem arsip desa.\n\n";
            $message .= "Detail Surat:\n";
            $message .= "Jenis Surat: " . esc($this->request->getPost('jenis_surat')) . "\n";
            $message .= "Waktu Upload: " . date('Y-m-d H:i:s') . "\n\n";
            $message .= "Silakan login ke sistem untuk melihat detail lengkap dan melakukan disposisi.\n";
            $message .= "Link Sistem: " . site_url('login') . " (atau link ke dashboard admin)\n\n";
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

            return redirect()->to(site_url('admin/surat-masuk'));
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file.');
        }
    }

    // Handles the deletion of an incoming letter
    public function hapus($id = null)
    {
        if ($id === null) {
            return redirect()->to(site_url('admin/surat-masuk'))->with('error', 'ID surat masuk tidak ditemukan.');
        }

        // Get the file name before deleting the record
        $surat = $this->suratMasukModel->find($id);
        if ($surat && $surat['file_surat']) {
            $filePath = ROOTPATH . 'public/uploads/surat_masuk/' . $surat['file_surat'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the actual file
            }
        }

        if ($this->suratMasukModel->delete($id)) {
            return redirect()->to(site_url('admin/surat-masuk'))->with('success', 'Surat masuk berhasil dihapus!');
        } else {
            return redirect()->to(site_url('admin/surat-masuk'))->with('error', 'Gagal menghapus surat masuk.');
        }
    }

    // Handles the disposition action for an incoming letter
   
}