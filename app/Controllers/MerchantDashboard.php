<?php namespace App\Controllers;

use App\Models\MerchantModel;
use App\Models\ProductModel;
use App\Models\ReservationModel;

class MerchantDashboard extends BaseController
{
    protected $merchantModel;
    protected $productModel;
    protected $reservationModel;
    
    public function __construct()
    {
        $this->merchantModel = new MerchantModel();
        $this->productModel = new ProductModel();
        $this->reservationModel = new ReservationModel();
    }
    
    public function index()
    {
        $merchantId = $this->session->get('merchant_id');
        
        // Get statistics
        $totalProducts = $this->productModel->where('merchant_id', $merchantId)->countAllResults();
        $totalReservations = $this->reservationModel->countAllResults();
        $totalSold = $this->productModel->where('merchant_id', $merchantId)
                          ->selectSum('sold_count')->get()->getRow()->sold_count ?? 0;
        
        // Get recent products
        $recentProducts = $this->productModel->where('merchant_id', $merchantId)
                               ->orderBy('created_at', 'DESC')->findAll(5);
        
        $data = [
            'title' => 'Dashboard Merchant',
            'totalProducts' => $totalProducts,
            'totalReservations' => $totalReservations,
            'totalSold' => $totalSold,
            'recentProducts' => $recentProducts,
        ];
        
        return $this->renderMerchantView('merchant/dashboard', $data);
    }
    
    public function products()
    {
        $merchantId = $this->session->get('merchant_id');
        $products = $this->productModel->where('merchant_id', $merchantId)
                         ->orderBy('created_at', 'DESC')->findAll();
        
        $data = [
            'title' => 'Kelola Produk',
            'products' => $products,
        ];
        
        return $this->renderMerchantView('merchant/products', $data);
    }
    
    public function addProduct()
    {
        $data = [
            'title' => 'Tambah Produk Baru',
            'validation' => \Config\Services::validation()
        ];
        
        return $this->renderMerchantView('merchant/add_product', $data);
    }
    
    public function storeProduct()
    {
        $validation = $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'variant' => 'max_length[100]',
            'location' => 'required|max_length[255]',
            'image_url' => 'permit_empty|valid_url|max_length[500]',
        ]);
        
        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        
        $merchantId = $this->session->get('merchant_id');
        
        $data = [
            'merchant_id' => $merchantId,
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'variant' => $this->request->getPost('variant'),
            'location' => $this->request->getPost('location'),
            'image_url' => $this->request->getPost('image_url') ?: 'https://placehold.co/400x300/4c70ff/ffffff?text=Product',
            'rating' => 5.0,
            'sold_count' => 0,
        ];
        
        $this->productModel->save($data);
        
        $this->session->setFlashdata('success', 'Produk berhasil ditambahkan!');
        return redirect()->to(base_url('merchant/dashboard/products'));
    }
    
    public function editProduct($id)
    {
        $merchantId = $this->session->get('merchant_id');
        $product = $this->productModel->where('id', $id)
                        ->where('merchant_id', $merchantId)->first();
        
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Produk',
            'product' => $product,
            'validation' => \Config\Services::validation()
        ];
        
        return $this->renderMerchantView('merchant/edit_product', $data);
    }
    
    public function updateProduct($id)
    {
        $validation = $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'variant' => 'max_length[100]',
            'location' => 'required|max_length[255]',
            'image_url' => 'permit_empty|valid_url|max_length[500]',
        ]);
        
        if (!$validation) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        
        $merchantId = $this->session->get('merchant_id');
        $product = $this->productModel->where('id', $id)
                        ->where('merchant_id', $merchantId)->first();
        
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk tidak ditemukan');
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'variant' => $this->request->getPost('variant'),
            'location' => $this->request->getPost('location'),
            'image_url' => $this->request->getPost('image_url') ?: $product['image_url'],
        ];
        
        $this->productModel->update($id, $data);
        
        $this->session->setFlashdata('success', 'Produk berhasil diupdate!');
        return redirect()->to(base_url('merchant/dashboard/products'));
    }
    
    public function deleteProduct($id)
    {
        $merchantId = $this->session->get('merchant_id');
        $product = $this->productModel->where('id', $id)
                        ->where('merchant_id', $merchantId)->first();
        
        if (!$product) {
            $this->session->setFlashdata('error', 'Produk tidak ditemukan');
            return redirect()->back();
        }
        
        $this->productModel->delete($id);
        
        $this->session->setFlashdata('success', 'Produk berhasil dihapus!');
        return redirect()->to(base_url('merchant/dashboard/products'));
    }
    
    public function reservations()
    {
        $reservations = $this->reservationModel->orderBy('created_at', 'DESC')->findAll();
        
        $data = [
            'title' => 'Daftar Reservasi',
            'reservations' => $reservations,
        ];
        
        return $this->renderMerchantView('merchant/reservations', $data);
    }
    
    public function updateReservationStatus($id)
    {
        $status = $this->request->getPost('status');
        
        if (!in_array($status, ['Pending', 'Confirmed', 'Completed', 'Cancelled'])) {
            $this->session->setFlashdata('error', 'Status tidak valid');
            return redirect()->back();
        }
        
        $this->reservationModel->update($id, ['status' => $status]);
        
        $this->session->setFlashdata('success', 'Status reservasi berhasil diupdate!');
        return redirect()->back();
    }
    
    public function profile()
    {
        $merchantId = $this->session->get('merchant_id');
        $merchant = $this->merchantModel->find($merchantId);
        
        $data = [
            'title' => 'Profil Merchant',
            'merchant' => $merchant,
            'validation' => \Config\Services::validation()
        ];
        
        return $this->renderMerchantView('merchant/profile', $data);
    }
    
    public function statistics()
    {
        $merchantId = $this->session->get('merchant_id');
        
        // More detailed statistics
        $products = $this->productModel->where('merchant_id', $merchantId)->findAll();
        $totalRevenue = 0;
        foreach ($products as $product) {
            $totalRevenue += $product['price'] * $product['sold_count'];
        }
        
        $data = [
            'title' => 'Statistik & Laporan',
            'totalRevenue' => $totalRevenue,
            'products' => $products,
        ];
        
        return $this->renderMerchantView('merchant/statistics', $data);
    }
    
    // Helper function for merchant dashboard views
    protected function renderMerchantView($page, $data = [])
    {
        $data['session'] = $this->session;
        echo view('merchant/layout/header', $data);
        echo view($page, $data);
        echo view('merchant/layout/footer', $data);
    }
}