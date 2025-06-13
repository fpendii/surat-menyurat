<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DisposisiModel;
use App\Models\UserModel;

class DisposisiController extends BaseController
{
    protected $disposisiModel;
    protected $userModel;

    public function __construct()
    {
        $this->disposisiModel = new DisposisiModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'disposisis' => $this->disposisiModel->join('users', 'users.id_user = disposisi.diteruskan_kepada')->findAll(),
        ];
        return view('admin/disposisi/index', $data);
    }

    public function tambah()
    {
        // Ambil user dengan role pegawai
        $pegawai = $this->userModel
            ->where('role', 'pegawai')
            ->findAll();

        $data = [
            'pegawaiList' => $pegawai,
        ];
        return view('admin/disposisi/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'surat_dari'        => 'required',
            'no_surat'          => 'required',
            'tgl_surat'         => 'required|valid_date',
            'tgl_diterima'      => 'required|valid_date',
            'no_agenda'         => 'required',
            'sifat'             => 'required|in_list[Biasa,Penting,Rahasia]',
            'perihal'           => 'required',
            'diteruskan_kepada' => 'required',
            'catatan'           => 'permit_empty',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal.');
        }

        $this->disposisiModel->save([
            'surat_dari'        => $this->request->getPost('surat_dari'),
            'no_surat'          => $this->request->getPost('no_surat'),
            'tgl_surat'         => $this->request->getPost('tgl_surat'),
            'tgl_diterima'      => $this->request->getPost('tgl_diterima'),
            'no_agenda'         => $this->request->getPost('no_agenda'),
            'sifat'             => $this->request->getPost('sifat'),
            'perihal'           => $this->request->getPost('perihal'),
            'diteruskan_kepada' => $this->request->getPost('diteruskan_kepada'),
            'catatan'           => $this->request->getPost('catatan'),
        ]);

        return redirect()->to('/admin/disposisi')->with('success', 'Disposisi berhasil ditambahkan.');
    }

    // Tambahan edit/delete bisa disediakan nanti jika dibutuhkan

    public function simpan()
    {
        $disposisiModel = new \App\Models\DisposisiModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'surat_dari'        => 'required',
            'nomor_surat'       => 'required',
            'tanggal_surat'     => 'required|valid_date',
            'tanggal_diterima'  => 'required|valid_date',
            'nomor_agenda'      => 'required',
            'sifat'             => 'required|in_list[Biasa,Segera,Rahasia]',
            'perihal'           => 'required',
            'diteruskan_kepada' => 'required|is_natural_no_zero',
            'catatan'           => 'permit_empty',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $data = [
            'surat_dari'        => $this->request->getPost('surat_dari'),
            'nomor_surat'       => $this->request->getPost('nomor_surat'),
            'tanggal_surat'     => $this->request->getPost('tanggal_surat'),
            'tanggal_diterima'  => $this->request->getPost('tanggal_diterima'),
            'nomor_agenda'      => $this->request->getPost('nomor_agenda'),
            'sifat'             => $this->request->getPost('sifat'),
            'perihal'           => $this->request->getPost('perihal'),
            'diteruskan_kepada' => $this->request->getPost('diteruskan_kepada'),
            'catatan'           => $this->request->getPost('catatan'),
        ];

        $disposisiModel->insert($data);

        return redirect()->to(base_url('admin/disposisi'))->with('success', 'Data disposisi berhasil disimpan.');
    }

    public function hapus($id)
    {
        $disposisiModel = new \App\Models\DisposisiModel();

        // Cek apakah disposisi ada
        $disposisi = $disposisiModel->find($id);
        if (!$disposisi) {
            return redirect()->to(base_url('admin/disposisi'))->with('error', 'Disposisi tidak ditemukan.');
        }

        // Hapus disposisi
        $disposisiModel->delete($id);

        return redirect()->to(base_url('admin/disposisi'))->with('success', 'Disposisi berhasil dihapus.');
    }

    public function edit($id)
    {
        $disposisi = $this->disposisiModel->find($id);
        if (!$disposisi) {
            return redirect()->to('/admin/disposisi')->with('error', 'Disposisi tidak ditemukan.');
        }

        // Ambil user dengan role pegawai
        $pegawai = $this->userModel
            ->where('role', 'pegawai')
            ->findAll();

        $data = [
            'disposisi' => $disposisi,
            'pegawaiList' => $pegawai,
        ];
        return view('admin/disposisi/edit', $data);
    }

    public function update($id)
    {
        $disposisiModel = new \App\Models\DisposisiModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'surat_dari'        => 'required',
            'nomor_surat'       => 'required',
            'tanggal_surat'     => 'required|valid_date',
            'tanggal_diterima'  => 'required|valid_date',
            'nomor_agenda'      => 'required',
            'sifat'             => 'required|in_list[Biasa,Segera,Rahasia]',
            'perihal'           => 'required',
            'diteruskan_kepada' => 'required|is_natural_no_zero',
            'catatan'           => 'permit_empty',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $data = [
            'surat_dari'        => $this->request->getPost('surat_dari'),
            'nomor_surat'       => $this->request->getPost('nomor_surat'),
            'tanggal_surat'     => $this->request->getPost('tanggal_surat'),
            'tanggal_diterima'  => $this->request->getPost('tanggal_diterima'),
            'nomor_agenda'      => $this->request->getPost('nomor_agenda'),
            'sifat'             => $this->request->getPost('sifat'),
            'perihal'           => $this->request->getPost('perihal'),
            'diteruskan_kepada' => $this->request->getPost('diteruskan_kepada'),
            'catatan'           => $this->request->getPost('catatan'),
        ];

        $disposisiModel->update($id, $data);

        return redirect()->to(base_url('admin/disposisi'))->with('success', 'Data disposisi berhasil diperbarui.');
    }
}
