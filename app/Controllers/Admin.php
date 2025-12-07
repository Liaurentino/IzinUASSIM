<?php

namespace App\Controllers;

use App\Models\MerchantModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $merchantModel;
    protected $userModel;

    public function __construct()
    {
        $this->merchantModel = new MerchantModel();
        $this->userModel = new UserModel();
    }

    // Fungsi untuk menampilkan Dashboard Admin
    public function index()
    {
        // Pengecekan role di filter harus memastikan hanya admin yang bisa akses
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Akses Ditolak.');
        }

        // Ambil data merchant yang statusnya 'pending'
        $pendingMerchants = $this->merchantModel->getPendingMerchants();

        $data = [
            'title' => 'Dashboard Admin',
            'pending_merchants' => $pendingMerchants,
        ];
        return view('admin/dashboard', $data);
    }

    // Fungsi untuk menyetujui merchant
    public function approveMerchant($merchantId)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Akses Ditolak.');
        }

        $merchant = $this->merchantModel->find($merchantId);

        if ($merchant) {
            // 1. Ubah status merchant menjadi 'approved'
            $this->merchantModel->update($merchantId, ['status' => 'approved']);

            // 2. Ubah role user menjadi 'merchant'
            $userId = $merchant['user_id'];
            $this->userModel->update($userId, ['role' => 'merchant']);

            return redirect()->to(base_url('admin'))->with('success', 'Merchant berhasil disetujui dan status pengguna diperbarui.');
        }

        return redirect()->to(base_url('admin'))->with('error', 'Merchant tidak ditemukan.');
    }

    // Fungsi untuk menolak merchant
    public function rejectMerchant($merchantId)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('auth/login'))->with('error', 'Akses Ditolak.');
        }

        $merchant = $this->merchantModel->find($merchantId);

        if ($merchant) {
            // Ubah status merchant menjadi 'rejected'
            $this->merchantModel->update($merchantId, ['status' => 'rejected']);
            
            // Catatan: Role user tetap 'user' biasa. Data merchant tetap ada dengan status 'rejected'.

            return redirect()->to(base_url('admin'))->with('success', 'Permintaan Merchant berhasil ditolak.');
        }

        return redirect()->to(base_url('admin'))->with('error', 'Merchant tidak ditemukan.');
    }
    
    // Fungsi untuk halaman login Admin
    public function login()
    {
        $data['title'] = 'Admin Login';
        return view('admin/login', $data);
    }

    // Fungsi proses login Admin
    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->orWhere('email', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Pastikan yang login adalah admin
                if ($user['role'] === 'admin') {
                    $ses_data = [
                        'user_id'       => $user['id'],
                        'username'      => $user['username'],
                        'email'         => $user['email'],
                        'role'          => $user['role'],
                        'isLoggedIn'    => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to(base_url('admin'));
                } else {
                    $session->setFlashdata('error', 'Anda bukan Admin.');
                    return redirect()->to(base_url('admin/login'));
                }
            } else {
                $session->setFlashdata('error', 'Username atau Password salah.');
                return redirect()->to(base_url('admin/login'));
            }
        } else {
            $session->setFlashdata('error', 'Username atau Email tidak ditemukan.');
            return redirect()->to(base_url('admin/login'));
        }
    }

    // Fungsi Logout Admin
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}