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
        $disposisiModel = new \App\Models\DisposisiModel();
        $userModel = new \App\Models\UserModel();
        if ($id_surat_masuk === null) {
            return redirect()->to(site_url('admin/disposisi'))->with('error', 'ID Surat Masuk tidak ditemukan.');
        }

        $surat = $this->suratMasukModel->find($id_surat_masuk);

        if (!$surat) {
            return redirect()->to(site_url('admin/disposisi'))->with('error', 'Surat Masuk tidak ditemukan.');
        }

        $data = [
            'title' => 'Formulir Disposisi Surat',
            'surat' => $surat,
            'daftar_pegawai' => $this->pegawaiModel->where('role', 'pegawai')->findAll(), // <<< AMBIL DAN KIRIM DATA PEGAWAI
        ];

        // Ambil data user untuk email
        $idUser = $this->request->getPost('diteruskan_kepada');
        $user = $userModel->find($idUser);

        if ($user && !empty($user['email'])) {
            $email = \Config\Services::email();

            $email->setTo($user['email']);
            $email->setFrom('desahandil@gmail.com', 'Sistem Surat Desa Handil');
            $email->setSubject('Disposisi Surat Baru');

            // Siapkan data untuk view email
            $dataEmail = [
                'nama'          => $user['name'],
                'nomor_surat'   => $data['no_surat'],
                'surat_dari'    => $data['surat_dari'],
                'perihal'       => $data['perihal'],
                'tanggal_surat' => $data['tanggal_surat'],
            ];

            // Load view sebagai isi email
            $message = view('email/notifikasi_disposisi', $dataEmail);
            $email->setMessage($message);

            // Kirim email
            if (!$email->send()) {
                log_message('error', 'Gagal mengirim email ke user ID ' . $idUser . ': ' . $email->printDebugger(['headers']));
            }

            $email->clear();
        }

        return view('kepala-desa/disposisi/tambah', $data); // Pastikan path view sudah benar
    }

    // Menyimpan data disposisi dari formulir
    public function simpan()
    {
        $rules = [
            'id_surat_masuk'    => 'required|numeric|is_not_unique[surat_masuk.id_surat_masuk]',
            'surat_dari'        => 'required|max_length[255]',
            'tanggal_surat'     => 'required|valid_date',
            'tanggal_diterima'  => 'required|valid_date',
            'nomor_agenda'      => 'permit_empty|max_length[100]',
            'sifat'             => 'required|in_list[Biasa,Penting,Rahasia]',
            'perihal'           => 'required',
            'diteruskan_kepada' => 'required',
            'catatan'           => 'permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->disposisiModel->save([
            'id_disposisi'      => $this->request->getPost('id_disposisi'),
            'id_surat_masuk'    => $this->request->getPost('id_surat_masuk'),
            'surat_dari'        => $this->request->getPost('surat_dari'),
            'tanggal_surat'     => $this->request->getPost('tanggal_surat'),
            'tanggal_diterima'  => $this->request->getPost('tanggal_diterima'),
            'nomor_agenda'      => $this->request->getPost('nomor_agenda'),
            'sifat'             => $this->request->getPost('sifat'),
            'perihal'           => $this->request->getPost('perihal'),
            'id_user'           => $this->request->getPost('diteruskan_kepada'),
            'catatan'           => $this->request->getPost('catatan'),
        ]);

        return redirect()->to(site_url('kepala-desa/disposisi'))->with('success', 'Disposisi berhasil disimpan!');
    }
}
