<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MerchantModel;
use CodeIgniter\Controller; // Pastikan ini diimpor jika Controller Anda tidak diperluas dari BaseController

class Auth extends BaseController
{
    // ... (Fungsi register dan processRegister tidak diubah) ...
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
        // Catatan: Pastikan kolom 'role' memiliki nilai default 'user' di database/model.
        $userModel->save([
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
            'password'  => $this->request->getPost('password'),
        ]);

        $this->session->setFlashdata('success', 'Registrasi berhasil! Silakan Login.');
        // Mengubah redirect ke 'auth/login' karena Anda menggunakan controller Auth
        return redirect()->to(base_url('auth/login')); 
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
        
        // 1. Ambil data user, termasuk kolom 'role'
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            
            // Siapkan data sesi universal. Role DIHARUSKAN ada di tabel users.
            $sesData = [
                'user_id'    => $user['id'],
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'role'       => $user['role'], // PERBAIKAN PENTING: Ambil role dari tabel users
                'isLoggedIn' => TRUE
            ];
            
            // 2. Logika Pengalihan Berdasarkan Role
            $redirectUrl = base_url('/'); // Default redirect

            if ($user['role'] === 'admin') {
                $redirectUrl = base_url('admin');
            } elseif ($user['role'] === 'merchant') {
                // Jika role-nya merchant, kita perlu ambil data merchant untuk cek status
                $merchant = $merchantModel->where('user_id', $user['id'])->first();

                if ($merchant) {
                    $sesData['merchant_id'] = $merchant['id'];
                    $sesData['merchant_status'] = $merchant['status'];
                    // PERBAIKAN: Menggunakan operator Null Coalescing ('??') untuk mencegah undefined array key error.
                    // Jika 'merchant_name' tidak ada di hasil query, akan menggunakan string default.
                    $sesData['merchant_name'] = $merchant['merchant_name'] ?? 'Merchant Tidak Diketahui'; 
                }

                // Redirect ke dashboard merchant, filter akan menangani status pending/approved
                $redirectUrl = base_url('merchant/dashboard');
            }
            
            // 3. Set Session dan Redirect
            $this->session->set($sesData);
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