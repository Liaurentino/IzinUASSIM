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
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

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
            $this->merchantModel->update($id, ['status' => 'approved']);
            $this->userModel->update($merchant['user_id'], ['role' => 'merchant']);

            session()->setFlashdata('success', 'Merchant disetujui. User telah menjadi Merchant.');
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