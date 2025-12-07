<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MerchantModel;
use App\Models\ProductModel;
use App\Models\ReservationModel;

class Admin extends BaseController
{
    protected $merchantModel;
    protected $userModel;
    protected $productModel;
    protected $reservationModel;
    
    public function __construct()
    {
        $this->merchantModel = new MerchantModel();
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->reservationModel = new ReservationModel();
    }
    
    // Admin Login Page
    public function login()
    {
        // Check if already logged in
        if ($this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }
        
        $data = [
            'title' => 'Admin Login - Servify'
        ];
        
        return view('admin/login', $data);
    }
    
    // Process Admin Login
    public function processLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Simple hardcoded admin (untuk keamanan production, gunakan database)
        $adminEmail = 'admin@servify.com';
        $adminPassword = 'admin123'; // In production, use hashed password
        
        if ($email === $adminEmail && $password === $adminPassword) {
            $this->session->set([
                'admin_logged_in' => true,
                'admin_email' => $email,
                'admin_name' => 'Administrator'
            ]);
            
            return redirect()->to(base_url('admin/dashboard'));
        }
        
        $this->session->setFlashdata('error', 'Email atau password salah!');
        return redirect()->back();
    }
    
    // Admin Dashboard
    public function dashboard()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        // Get statistics
        $totalUsers = $this->userModel->countAll();
        $totalMerchants = $this->merchantModel->countAll();
        $pendingMerchants = $this->merchantModel->where('status', 'Pending')->countAllResults();
        $totalProducts = $this->productModel->countAll();
        $totalReservations = $this->reservationModel->countAll();
        
        $data = [
            'title' => 'Admin Dashboard',
            'totalUsers' => $totalUsers,
            'totalMerchants' => $totalMerchants,
            'pendingMerchants' => $pendingMerchants,
            'totalProducts' => $totalProducts,
            'totalReservations' => $totalReservations
        ];
        
        return $this->renderAdminView('admin/dashboard', $data);
    }
    
    // Merchant Verification Page
    public function merchants()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        // Get all merchants with user info
        $merchants = $this->merchantModel
            ->select('merchants.*, users.name as user_name, users.email as user_email')
            ->join('users', 'users.id = merchants.user_id')
            ->orderBy('merchants.created_at', 'DESC')
            ->findAll();
        
        $data = [
            'title' => 'Verifikasi Merchant',
            'merchants' => $merchants
        ];
        
        return $this->renderAdminView('admin/merchants', $data);
    }
    
    // Update Merchant Status (Verify/Reject)
    public function updateMerchantStatus($id)
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        $status = $this->request->getPost('status');
        
        if (!in_array($status, ['Verified', 'Rejected'])) {
            $this->session->setFlashdata('error', 'Status tidak valid');
            return redirect()->back();
        }
        
        $merchant = $this->merchantModel->find($id);
        
        if (!$merchant) {
            $this->session->setFlashdata('error', 'Merchant tidak ditemukan');
            return redirect()->back();
        }
        
        $this->merchantModel->update($id, ['status' => $status]);
        
        $message = $status === 'Verified' 
            ? 'Merchant berhasil diverifikasi!' 
            : 'Merchant ditolak';
            
        $this->session->setFlashdata('success', $message);
        return redirect()->to(base_url('admin/merchants'));
    }
    
    // View All Users
    public function users()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        $users = $this->userModel->orderBy('created_at', 'DESC')->findAll();
        
        $data = [
            'title' => 'Kelola Users',
            'users' => $users
        ];
        
        return $this->renderAdminView('admin/users', $data);
    }
    
    // View All Products
    public function products()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        $products = $this->productModel
            ->select('products.*, merchants.business_name')
            ->join('merchants', 'merchants.id = products.merchant_id')
            ->orderBy('products.created_at', 'DESC')
            ->findAll();
        
        $data = [
            'title' => 'Kelola Produk',
            'products' => $products
        ];
        
        return $this->renderAdminView('admin/products', $data);
    }
    
    // View All Reservations
    public function reservations()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        $reservations = $this->reservationModel->orderBy('created_at', 'DESC')->findAll();
        
        $data = [
            'title' => 'Kelola Reservasi',
            'reservations' => $reservations
        ];
        
        return $this->renderAdminView('admin/reservations', $data);
    }
    
    // Delete User
    public function deleteUser($id)
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        $this->userModel->delete($id);
        $this->session->setFlashdata('success', 'User berhasil dihapus');
        return redirect()->to(base_url('admin/users'));
    }
    
    // Delete Product
    public function deleteProduct($id)
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to(base_url('admin/login'));
        }
        
        $this->productModel->delete($id);
        $this->session->setFlashdata('success', 'Produk berhasil dihapus');
        return redirect()->to(base_url('admin/products'));
    }
    
    // Admin Logout
    public function logout()
    {
        $this->session->remove(['admin_logged_in', 'admin_email', 'admin_name']);
        return redirect()->to(base_url('admin/login'));
    }
    
    // Helper function to render admin views
    protected function renderAdminView($page, $data = [])
    {
        $data['session'] = $this->session;
        echo view('admin/layout/header', $data);
        echo view($page, $data);
        echo view('admin/layout/footer', $data);
    }
}