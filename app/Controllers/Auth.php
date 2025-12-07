<?php namespace App\Controllers;

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
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'password' => $this->request->getPost('password'),
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
            // Check if user has merchant account
            $merchant = $merchantModel->where('user_id', $user['id'])->first();
            
            $sesData = [
                'user_id'    => $user['id'],
                'user_name'  => $user['name'],
                'user_email' => $user['email'],
                'isLoggedIn' => TRUE
            ];
            
            // Add merchant data to session if exists
            if ($merchant) {
                $sesData['merchant_id'] = $merchant['id'];
                $sesData['merchant_status'] = $merchant['status'];
                $sesData['business_name'] = $merchant['business_name'];
            }
            
            $this->session->set($sesData);
            $this->session->setFlashdata('success', 'Login Berhasil!');
            
            // Redirect to merchant dashboard if verified merchant
            if ($merchant && $merchant['status'] === 'Verified') {
                return redirect()->to(base_url('merchant/dashboard'));
            }
            
            return redirect()->to(base_url('/'));
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