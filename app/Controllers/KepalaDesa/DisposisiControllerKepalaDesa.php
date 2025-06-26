<?php

namespace App\Controllers\KepalaDesa;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuratMasukModel;
use App\Models\DisposisiModel;
use App\Models\UserModel; // Pastikan model PegawaiModel sudah ada

class DisposisiControllerKepalaDesa extends BaseController
{
    protected $suratMasukModel;
    protected $disposisiModel;
    protected $userModel;
    protected $pegawaiModel; // Tambahkan properti untuk PegawaiModel

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();
        $this->disposisiModel = new DisposisiModel();
        $this->userModel = new UserModel();
        $this->pegawaiModel = new UserModel(); // Inisialisasi model PegawaiModel
    }


    public function index()
    {

        // Contoh: Ambil semua surat masuk, lalu filter yang belum ada di tabel disposisi
        $allSuratMasuk = $this->suratMasukModel->findAll();
        $suratMasukYangSudahDidisposisi = $this->disposisiModel->select('id_surat_masuk')->findAll();

        $idsSudahDidisposisi = array_column($suratMasukYangSudahDidisposisi, 'id_surat_masuk');

        $surat_masuk_untuk_disposisi = [];
        foreach ($allSuratMasuk as $surat) {
            if (!in_array($surat['id_surat_masuk'], $idsSudahDidisposisi)) {
                $surat_masuk_untuk_disposisi[] = $surat;
            }
        }

        $data = [
            'title' => 'Disposisi Surat Masuk',
            'surat_masuk_untuk_disposisi' => $surat_masuk_untuk_disposisi,
        ];


        return view('kepala-desa/disposisi/index', $data);
    }

    // Menampilkan formulir untuk membuat disposisi baru
    public function form($id_surat_masuk = null)
    {

        if ($id_surat_masuk === null) {
            return redirect()->to(base_url('admin/disposisi'))->with('error', 'ID Surat Masuk tidak ditemukan.');
        }

        $surat = $this->suratMasukModel->find($id_surat_masuk);

        if (!$surat) {
            return redirect()->to(base_url('admin/disposisi'))->with('error', 'Surat Masuk tidak ditemukan.');
        }

        $data = [
            'title' => 'Formulir Disposisi Surat',
            'surat' => $surat,
            'daftar_pegawai' => $this->pegawaiModel->where('role', 'pegawai')->findAll(), // <<< AMBIL DAN KIRIM DATA PEGAWAI
        ];



        return view('kepala-desa/disposisi/tambah', $data); // Pastikan path view sudah benar
    }

    // Menyimpan data disposisi dari formulir
    public function simpan(): ResponseInterface
    {
        $rules = [
            'id_surat_masuk'    => 'required|numeric', // Pastikan id_surat_masuk belum didisposisi
            'surat_dari'        => 'required|max_length[255]',
            'tanggal_surat'     => 'required|valid_date',
            'tanggal_diterima'  => 'required|valid_date',
            'nomor_agenda'      => 'permit_empty|max_length[100]',
            'sifat'             => 'required|in_list[Biasa,Penting,Rahasia]',
            'perihal'           => 'required',
            'diteruskan_kepada' => 'required|numeric|is_not_unique[users.id_user]', // Pastikan user ada dan valid
            'catatan'           => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan data untuk disimpan ke tabel disposisi
        $dataDisposisi = [
            // 'id_disposisi' => $this->request->getPost('id_disposisi'), // ID disposisi akan auto-increment, tidak perlu di set jika ini buat baru
            'id_surat_masuk'   => $this->request->getPost('id_surat_masuk'),
            'surat_dari'       => $this->request->getPost('surat_dari'),
            'tanggal_surat'    => $this->request->getPost('tanggal_surat'),
            'tanggal_diterima' => $this->request->getPost('tanggal_diterima'),
            'nomor_agenda'     => $this->request->getPost('nomor_agenda'),
            'sifat'            => $this->request->getPost('sifat'),
            'perihal'          => $this->request->getPost('perihal'),
            'id_user'          => $this->request->getPost('diteruskan_kepada'), // Disimpan ke id_user
            'catatan'          => $this->request->getPost('catatan'),
        ];

        // Simpan data disposisi
        $this->disposisiModel->save($dataDisposisi);

        // Ambil detail surat masuk untuk data email
        $suratMasukDetail = $this->suratMasukModel->find($this->request->getPost('id_surat_masuk'));

        // Ambil data user yang dituju untuk email notifikasi
        $idUserPenerima = $this->request->getPost('diteruskan_kepada');
        $userPenerima = $this->userModel->find($idUserPenerima);

        if ($userPenerima && !empty($userPenerima['email']) && $suratMasukDetail) {
            $email = \Config\Services::email();
            $email->setTo($userPenerima['email']);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Disposisi Surat Baru');

            // Siapkan data untuk view email
            $dataEmail = [
                'nama'          => $userPenerima['name'],
                'nomor_surat'   => $suratMasukDetail['no_surat'] ?? 'Tidak Ada', // Gunakan no_surat dari SuratMasukModel
                'surat_dari'    => $suratMasukDetail['jenis_surat'] ?? 'Tidak Diketahui', // Atau dari field 'surat_dari' di Disposisi
                'perihal'       => $suratMasukDetail['jenis_surat'] ?? 'Tidak Diketahui', // Atau dari field 'perihal' di Disposisi
                'tanggal_surat' => $suratMasukDetail['created_at'] ?? 'Tidak Diketahui',
            ];

            // Load view sebagai isi email
            $message = view('email/notifikasi_disposisi', $dataEmail);
            $email->setMessage($message);

            // Kirim email
            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email ke user ID ' . $idUserPenerima . ': ' . $email->printDebugger(['headers']));
            } else {
                session()->setFlashdata('info', 'Email notifikasi berhasil dikirim ke ' . $userPenerima['email']);
            }

            $email->clear();
        } else {
            log_message('warning', 'Tidak dapat mengirim email. User atau detail surat masuk tidak ditemukan, atau email tidak valid. User ID: ' . $idUserPenerima);
            session()->setFlashdata('warning', 'Disposisi berhasil disimpan, tetapi email notifikasi gagal dikirim.');
        }

        return redirect()->to(base_url('kepala-desa/disposisi'))->with('success', 'Disposisi berhasil disimpan!');
    }
}
