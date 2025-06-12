<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class PenggunaController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Pengguna',
            'users' => model('UserModel')->findAll()
        ];


        return view('admin/pengguna/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Pengguna'
        ];

        return view('admin/pengguna/tambah', $data);
    }

    public function simpan()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name'      => 'required|string|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[6]',
            'role'      => 'required|in_list[admin,kepala_desa,masyarakat,pegawai]',
            'phone'     => 'permit_empty|string|max_length[20]',
            'address'   => 'permit_empty|string|max_length[255]',
            'is_active' => 'required|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => $this->request->getPost('role'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
            'is_active' => $this->request->getPost('is_active'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $userModel = new UserModel();
        $userModel->insert($data);

        return redirect()->to(base_url('admin/pengguna'))->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function hapus($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $userModel->delete($id);

        return redirect()->to(base_url('admin/pengguna'))->with('success', 'Pengguna berhasil dihapus.');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('admin/pengguna'))->with('error', 'Pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Pengguna',
            'user'  => $user
        ];

        return view('admin/pengguna/edit', $data);
    }

    public function update($id)
{
    $userModel = new \App\Models\UserModel();

    // Validasi manual di sini
    $validation = \Config\Services::validation();
    $validation->setRules([
        'name'      => 'required|min_length[3]',
        'email'     => 'required|valid_email',
        'password'  => 'permit_empty|min_length[6]',
        'role'      => 'required|in_list[admin,kepala_desa,masyarakat,pegawai]',
        'phone'     => 'permit_empty',
        'address'   => 'permit_empty',
        'is_active' => 'required|in_list[0,1]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('error', $validation->listErrors());
    }

    // Cek apakah email unik (kecuali email milik user ini sendiri)
    $existing = $userModel
        ->where('email', $this->request->getPost('email'))
        ->where('id_user !=', $id)
        ->first();

    if ($existing) {
        return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
    }

    $data = [
        'name'      => $this->request->getPost('name'),
        'email'     => $this->request->getPost('email'),
        'role'      => $this->request->getPost('role'),
        'phone'     => $this->request->getPost('phone'),
        'address'   => $this->request->getPost('address'),
        'is_active' => $this->request->getPost('is_active'),
    ];

    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    // Lakukan update
    $userModel->update($id, $data);

    return redirect()->to(base_url('admin/pengguna'))->with('success', 'Data pengguna berhasil diperbarui.');
}


}
