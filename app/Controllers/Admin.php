<?php

namespace App\Controllers;

use App\Models\MerchantModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $merchantModel;
    protected $userModel;

    public function __construct()
    {
        $this->merchantModel = new MerchantModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Pastikan cek role session sesuai dengan cara Anda menyimpan session (misal: 'role' atau 'level')
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'))->with('error', 'Akses Ditolak.');
        }

        // Ambil data merchant dengan status 'pending' (huruf kecil)
        $pendingMerchants = $this->merchantModel->where('status', 'pending')->findAll();

        $data = [
            'title' => 'Dashboard Admin',
            'pending_merchants' => $pendingMerchants,
        ];
        
        return view('admin/dashboard', $data);
    }

    public function approveMerchant($merchantId)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $merchant = $this->merchantModel->find($merchantId);

        if ($merchant) {
            // 1. Update status merchant menjadi 'approved'
            $this->merchantModel->update($merchantId, ['status' => 'approved']);

            // 2. Update role user menjadi 'merchant'
            // Pastikan kolom di database merchant adalah 'user_id'
            $userId = $merchant['user_id'];
            
            // Cek apakah user ada sebelum update
            if($this->userModel->find($userId)) {
                $this->userModel->update($userId, ['role' => 'merchant']);
            }

            return redirect()->to(base_url('admin'))->with('success', 'Merchant berhasil disetujui.');
        }

        return redirect()->to(base_url('admin'))->with('error', 'Merchant tidak ditemukan.');
    }

    public function rejectMerchant($merchantId)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $this->merchantModel->update($merchantId, ['status' => 'rejected']);
        return redirect()->to(base_url('admin'))->with('success', 'Permintaan Merchant ditolak.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}