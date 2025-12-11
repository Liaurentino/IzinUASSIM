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
            'role'      => 'user' 
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
            

            $sessData = [
                'id'         => $user['id'],
                'user_id'    => $user['id'],
                'user_name'  => $user['name'], 
                'user_email' => $user['email'],
                'role'       => $user['role'],
                'isLoggedIn' => TRUE
            ];

            $redirectUrl = base_url('/');

            // === CEK ROLE ADMIN ===
            if ($user['role'] === 'admin') {
                $redirectUrl = base_url('admin/dashboard');
            } 
            // === CEK MERCHANT ===
            else {
                $merchant = $merchantModel->where('user_id', $user['id'])->first();
                
                if ($merchant) {
                    // Simpan data merchant ke session
                    $sessData['merchant_id']     = $merchant['id'];
                    $sessData['merchant_status'] = $merchant['status'];
                    $sessData['merchant_name']   = $merchant['business_name'] ?? $merchant['merchant_name'];

                    // PERBAIKAN: Gunakan 'approved' bukan 'Verified'
                    if ($merchant['status'] === 'approved') {
                        // Update role ke merchant di session
                        $sessData['role'] = 'merchant';
                        
                        // Update role di database juga (untuk konsistensi)
                        $userModel->update($user['id'], ['role' => 'merchant']);
                        
                    }
                    elseif ($merchant['status'] === 'pending') {
                        $redirectUrl = base_url('merchant/waiting');
                    }
                    elseif ($merchant['status'] === 'rejected') {
                        $this->session->setFlashdata('warning', 'Pengajuan Merchant ditolak. Hubungi admin.');
                        $redirectUrl = base_url('/');
                    }
                }
            }

            // Set Session Final
            $this->session->set($sessData);
            
            $this->session->setFlashdata('success', 'Login Berhasil! Selamat datang ' . $user['name']);
            
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