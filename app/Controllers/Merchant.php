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

        // KUNCI PERBAIKAN: Panggil Header (CSS), lalu Halaman Info, lalu Footer
        echo view('layout/header', $data); 
        echo view('pages/merchant_info', $data);
        echo view('layout/footer');
    }

    // Halaman Form Register (Public User View)
    public function register()
    {
        // Cek Login
        if (! session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Anda harus login untuk mendaftar sebagai Mitra.');
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Servify - Form Pendaftaran Merchant',
            'validation' => \Config\Services::validation()
        ];
        
        // KUNCI PERBAIKAN: Gunakan struktur sandwich yang sama
        echo view('layout/header', $data);
        echo view('pages/merchant_register', $data);
        echo view('layout/footer');
    }

    // Proses Submit Data
    public function create()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
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

        // Simpan ke Database
        $merchantModel = new MerchantModel();
        
        // Ambil ID user dari session
        $userId = session()->get('id') ?? session()->get('user_id');

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
            'status'         => 'pending', 
        ];

        if($merchantModel->save($data)) {
            session()->setFlashdata('success', 'Pendaftaran Mitra berhasil! Mohon tunggu verifikasi Admin.');
            return redirect()->to(base_url('merchant')); 
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }
}