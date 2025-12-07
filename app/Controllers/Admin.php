<?php namespace App\Controllers;

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
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        // Ambil data merchant yang statusnya 'pending'
        $data = [
            'title' => 'Dashboard Admin',
            'pending_merchants' => $this->merchantModel->where('status', 'pending')->findAll(),
        ];
        
        return $this->renderView('admin/dashboard', $data);
    }

    public function approveMerchant($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $merchant = $this->merchantModel->find($id);

        if ($merchant) {
            // 1. Update Status di Tabel Merchants
            $this->merchantModel->update($id, ['status' => 'approved']);

            // 2. Update Role di Tabel Users (PENTING AGAR DIA PUNYA HAK AKSES)
            $this->userModel->update($merchant['user_id'], ['role' => 'merchant']);

            session()->setFlashdata('success', 'Merchant disetujui. Status User telah diperbarui.');
        }

        return redirect()->to(base_url('admin/dashboard'));
    }

    public function rejectMerchant($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $this->merchantModel->update($id, ['status' => 'rejected']);
        
        session()->setFlashdata('success', 'Permintaan Merchant ditolak.');
        return redirect()->to(base_url('admin/dashboard'));
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}