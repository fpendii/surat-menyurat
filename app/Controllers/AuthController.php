<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->UserModel = new UserModel();
    }
    public function login()
    {
        return view('auth/login');
    }

    public function loginProses()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            // Tambahkan cek is_active di sini
            if ($user['is_active'] == 0) {
                return redirect()->to('/login')->with('error', 'Akun belum aktif. Silakan cek email untuk aktivasi.');
            }

            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id_user'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'logged_in' => true,
                ]);
                if ($user['role'] == 'masyarakat') {
                    return redirect()->to('/masyarakat/dashboard');
                } elseif ($user['role'] == 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($user['role'] == 'kepala_desa') {
                    return redirect()->to('/kepala-desa/dashboard');
                }
            } else {
                return redirect()->to('/login')->with('error', 'Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
    }


    public function register()
    {
        return view('auth/register');
    }

    public function registerProses()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'name'     => 'required',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'phone'    => 'required',
            'address'  => 'required',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('login#signup')->withInput()->with('error', $validation->listErrors());
        }

        $model = new UserModel();

        // Generate kode aktivasi
        $activationCode = bin2hex(random_bytes(32)); // aman dan unik

        // Simpan user dengan status belum aktif
        $model->save([
            'name'            => $this->request->getPost('name'),
            'email'           => $this->request->getPost('email'),
            'phone'           => $this->request->getPost('phone'),
            'address'         => $this->request->getPost('address'),
            'role'            => 'masyarakat',
            'password'        => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'activation_code' => $activationCode,
            'is_active'       => 0,
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        // Kirim email verifikasi
        $emailService = \Config\Services::email();
        $emailService->setTo($this->request->getPost('email'));
        $emailService->setSubject('Aktivasi Akun Anda');

        $activationLink = base_url('aktivasi/' . $activationCode);
        $message = "Terima kasih telah mendaftar. Klik link berikut untuk mengaktifkan akun Anda:<br><a href='$activationLink'>$activationLink</a>";

        $emailService->setMessage($message);
        $emailService->send();

        return redirect()->to('/#signin')->with('success', 'Registrasi berhasil. Silakan cek email Anda untuk aktivasi akun.');
    }

    public function aktivasi($code)
    {
        $model = new UserModel();
        $user = $model->where('activation_code', $code)->first();

        if (!$user) {
            return redirect()->to('/#signin')->with('error', 'Kode aktivasi tidak valid.');
        }

        $model->update($user['id_user'], [
            'is_active' => 1,
            'activation_code' => null
        ]);

        return redirect()->to('/#signin')->with('success', 'Akun berhasil diaktivasi. Silakan login.');
    }

    public function forgotPasswordSend()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        // Buat token unik (misal random string + timestamp)
        helper('text');
        $token = random_string('alnum', 64);

        // Simpan token dan waktu kadaluarsa (misal 1 jam dari sekarang) di database
        $userModel->update($user['id_user'], [
            'reset_token' => $token,
            'reset_token_expired' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        ]);

        // Kirim email reset password dengan link token
        $emailSender = \Config\Services::email();

        $emailSender->setTo($email);
        $emailSender->setSubject('Reset Password');
        $resetLink = base_url('/reset-password?token=' . $token);
        $emailSender->setMessage("Klik link berikut untuk reset password: <a href='$resetLink'>$resetLink</a>");
        $emailSender->send();

        return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda');
    }


    public function resetPasswordForm()
    {
        $token = $this->request->getGet('token');
        $userModel = new UserModel();

        $user = $userModel->where('reset_token', $token)->first();

        if (!$user || strtotime($user['reset_token_expired']) < time()) {
            return redirect()->to('/login')->with('error', 'Token reset password tidak valid atau sudah kadaluarsa');
        }

        echo view('reset_password', ['token' => $token]);
    }




    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
