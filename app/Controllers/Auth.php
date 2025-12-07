<?php 

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MerchantModel;

class Auth extends BaseController
{
    public function register()
    {
        $data = [
            'title' => 'Servify - Registrasi Akun',
            'validation' => \Config\Services::validation()
        ];
        
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('/'));
        }

        return $this->renderView('pages/register', $data);
    }

    public function processRegister()
    {
        if (! $this->validate([
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|min_length[10]|max_length[15]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[password]'
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $userModel = new UserModel();
        
        $userModel->save([
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => $this->request->getPost('password'),
            'role'      => 'user' // Default role
        ]);

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
        $merchantModel = new MerchantModel();
        
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            
            // 1. Siapkan Data Session Dasar
            $sessData = [
                'id'         => $user['id'],       // ID User (Primary Key users)
                'user_id'    => $user['id'],       // Alias untuk kompatibilitas
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'role'       => $user['role'],     // Role dari database (admin/user/merchant)
                'isLoggedIn' => TRUE
            ];

            // 2. Ambil Data Merchant (Cek status merchant, meskipun role user masih 'user')
            $merchant = $merchantModel->where('user_id', $user['id'])->first();

            if ($merchant) {
                // Masukkan data merchant ke session agar bisa diakses di dashboard/header
                $sessData['merchant_id']     = $merchant['id'];
                $sessData['merchant_status'] = $merchant['status']; // Verified/pending/rejected
                $sessData['merchant_name']   = $merchant['merchant_name'] ?? $merchant['business_name'];
            }

            // 3. Tentukan Redirect URL
            $redirectUrl = base_url('/'); // Default ke Home

            if ($user['role'] === 'admin') {
                $redirectUrl = base_url('admin/dashboard');
            } 
            // Jika role sudah merchant ATAU status merchant sudah Verified (agar dashboard bisa diakses)
            elseif ($user['role'] === 'merchant' || ($merchant && $merchant['status'] === 'Verified')) {
                // Update role di session jika di database masih user tapi status verified
                $sessData['role'] = 'merchant'; 
                $redirectUrl = base_url('merchant/dashboard');
            }
            // Jika user biasa tapi sudah daftar merchant (status pending)
            elseif ($merchant && $merchant['status'] === 'pending') {
                $redirectUrl = base_url('merchant/waiting');
            }
            
            // Set Session
            $this->session->set($sessData);
            $this->session->setFlashdata('success', 'Login Berhasil! Selamat datang ' . $user['name'] . '.');
            
            return redirect()->to($redirectUrl);
            
        } else {
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