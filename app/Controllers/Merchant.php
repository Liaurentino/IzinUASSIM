<?php namespace App\Controllers;

use App\Models\MerchantModel;

class Merchant extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Servify - Gabung Merchant',
        ];
        // Halaman informasi untuk mendaftar merchant
        return $this->renderView('pages/merchant_info', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Servify - Form Pendaftaran Merchant',
            'validation' => \Config\Services::validation()
        ];
        
        // Cek jika sudah login/mendaftar (sesuaikan logika di sini jika perlu)
        if (! $this->session->get('isLoggedIn')) {
            $this->session->setFlashdata('error', 'Anda harus login untuk mendaftar sebagai Mitra.');
            return redirect()->to(base_url('login'));
        }

        return $this->renderView('pages/merchant_register', $data);
    }

    public function create()
    {
        // 1. Cek Login
        if (! $this->session->get('isLoggedIn')) {
            $this->session->setFlashdata('error', 'Anda harus login untuk mendaftar sebagai Mitra.');
            return redirect()->to(base_url('login'));
        }

        // 2. Validasi Input
        if (! $this->validate([
            'business_name'  => 'required|min_length[3]|is_unique[merchants.business_name]',
            'address'        => 'required',
            'phone'          => 'required|min_length[10]|max_length[15]',
            'email'          => 'required|valid_email|is_unique[merchants.email]',
            'business_type'  => 'required',
            'license_number' => 'required|is_unique[merchants.license_number]',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // 3. Simpan ke Database
        $merchantModel = new MerchantModel();
        
        $merchantModel->save([
            'user_id'        => $this->session->get('user_id'),
            'business_name'  => $this->request->getPost('business_name'),
            'address'        => $this->request->getPost('address'),
            'phone'          => $this->request->getPost('phone'),
            'email'          => $this->request->getPost('email'),
            'business_type'  => $this->request->getPost('business_type'),
            'license_number' => $this->request->getPost('license_number'),
            'status'         => 'Pending', // Status awal Pending
        ]);

        // 4. Redirect
        $this->session->setFlashdata('success', 'Pendaftaran Mitra berhasil! Kami akan mereview permohonan Anda.');
        return redirect()->to(base_url('merchant'));
    }
}