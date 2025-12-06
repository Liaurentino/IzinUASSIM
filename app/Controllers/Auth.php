<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        $data = [
            'title' => 'Servify - Registrasi Akun',
            'validation' => \Config\Services::validation()
        ];
        
        // Cek jika sudah login, redirect ke home
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('/'));
        }

        return $this->renderView('pages/register', $data);
    }

    public function processRegister()
    {
        // 1. Validasi Input
        if (! $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|min_length[10]|max_length[15]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // 2. Simpan ke Database
        $userModel = new UserModel();
        $userModel->save([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'password' => $this->request->getPost('password'), // Password akan di-hash oleh UserModel
        ]);

        // 3. Set Session & Redirect
        $this->session->setFlashdata('success', 'Registrasi berhasil! Silakan Login.');
        return redirect()->to(base_url('login'));
    }
    
    public function login()
    {
        $data = [
            'title' => 'Servify - Login',
            'validation' => \Config\Services::validation()
        ];
        
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('/'));
        }
        
        return $this->renderView('pages/login', $data);
    }

    public function processLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Login Sukses: Set Session
                $sesData = [
                    'user_id'    => $user['id'],
                    'user_name'  => $user['name'],
                    'user_email' => $user['email'],
                    'isLoggedIn' => TRUE
                ];
                $this->session->set($sesData);
                $this->session->setFlashdata('success', 'Login Berhasil!');
                return redirect()->to(base_url('/'));
            } else {
                // Password salah
                $this->session->setFlashdata('error', 'Email atau Password salah!');
                return redirect()->back()->withInput();
            }
        } else {
            // Email tidak ditemukan
            $this->session->setFlashdata('error', 'Email atau Password salah!');
            return redirect()->back()->withInput();
        }
    }
    
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
}