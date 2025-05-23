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
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id_user'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'logged_in' => true,
                ]);
                if($user['role'] == 'masyarakat') {
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

    public function forgotPassword()
    {
        return view('auth/forgot-password');
    }

    public function resetPassword()
    {
        return view('auth/reset-password');
    }

    public function unauthorized()
    {
        return view('auth/unauthorized');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
