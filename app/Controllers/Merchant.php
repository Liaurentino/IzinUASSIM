<?php namespace App\Controllers;

use App\Models\MerchantModel;

class Merchant extends BaseController
{
    // Halaman Info Merchant (Public User View)
    public function index()
    {
        $data = [
            'title' => 'Servify - Gabung Merchant',
        ];

        return $this->renderView('pages/merchant_info', $data);
    }

    // Halaman Form Register (Public User View)
    public function register()
    {
        if (! session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Anda harus login untuk mendaftar sebagai Mitra.');
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Servify - Form Pendaftaran Merchant',
            'validation' => \Config\Services::validation()
        ];
        
        return $this->renderView('pages/merchant_register', $data);
    }

    // Proses Submit Data
    public function create()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $merchantModel = new MerchantModel();
        
        // Ambil ID user dari session
        $userId = session()->get('id') ?? session()->get('user_id');

        // Cek apakah user ini SUDAH pernah daftar (untuk mencegah duplikasi)
        $existingMerchant = $merchantModel->where('user_id', $userId)->first();
        if ($existingMerchant) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar atau sedang dalam proses verifikasi.');
        }

        // Validasi Input
        if (! $this->validate([
            'business_name'  => 'required|min_length[3]',
            'address'        => 'required',
            'phone'          => 'required|min_length[10]|max_length[15]',
            'email'          => 'required|valid_email',
            'business_type'  => 'required',
            'license_number' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'user_id'        => $userId,
            'business_name'  => $this->request->getPost('business_name'),
            'merchant_name'  => $this->request->getPost('business_name'), // Backup kolom
            'address'        => $this->request->getPost('address'),
            'phone'          => $this->request->getPost('phone'),
            'phone_number'   => $this->request->getPost('phone'), // Backup kolom
            'email'          => $this->request->getPost('email'),
            'business_type'  => $this->request->getPost('business_type'),
            'license_number' => $this->request->getPost('license_number'),
            'status'         => 'pending', // Status awal selalu pending
        ];

        if($merchantModel->save($data)) {
            session()->setFlashdata('success', 'Pendaftaran Mitra berhasil! Mohon tunggu verifikasi Admin.');
            // Arahkan ke halaman waiting agar user tahu statusnya
            return redirect()->to(base_url('merchant/waiting')); 
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }
}