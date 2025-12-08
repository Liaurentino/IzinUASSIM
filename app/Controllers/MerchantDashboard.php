<?php

namespace App\Controllers;

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

    // Helper untuk render view merchant dengan layout khusus
    protected function renderMerchantView($page, $data = [])
    {
        $data['session'] = $this->session;
        echo view('merchant/layout/merchant_header', $data);
        echo view($page, $data);
        echo view('merchant/layout/merchant_footer', $data);
    }

    public function index()
    {
        $userId = session()->get('user_id'); 
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        if (!$merchant || strtolower($merchant['status']) !== 'approved') {
            return redirect()->to(base_url('merchant/waiting'));
        }

        $data = [
            'title' => 'Dashboard Merchant',
            'merchant' => $merchant,
            'total_products' => $this->productModel->where('merchant_id', $merchant['id'])->countAllResults(),
            'pending_reservations' => $this->reservationModel->where('merchant_id', $merchant['id'])->where('status', 'Pending')->countAllResults(),
            'recent_products' => $this->productModel->where('merchant_id', $merchant['id'])->orderBy('created_at', 'DESC')->findAll(5)
        ];

        // GUNAKAN LAYOUT MERCHANT
        return $this->renderMerchantView('merchant/dashboard_content', $data);
    }

    public function waiting()
    {
        $data = ['title' => 'Menunggu Verifikasi'];
        // Halaman waiting tetap pakai layout biasa
        return $this->renderView('merchant/waiting', $data);
    }

    public function products()
    {
        $userId = session()->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        $data = [
            'title' => 'Kelola Produk',
            'merchant' => $merchant,
            'products' => $this->productModel->where('merchant_id', $merchant['id'])->findAll()
        ];
        
        return $this->renderMerchantView('merchant/products_content', $data);
    }

    public function reservations()
    {
        $userId = session()->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        $data = [
            'title' => 'Kelola Reservasi',
            'merchant' => $merchant,
            'reservations' => $this->reservationModel->where('merchant_id', $merchant['id'])->findAll()
        ];
        
        return $this->renderMerchantView('merchant/reservations_content', $data);
    }

    public function addProduct()
    {
        $userId = session()->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        $data = [
            'title' => 'Tambah Produk',
            'merchant' => $merchant,
            'validation' => \Config\Services::validation()
        ];

        return $this->renderMerchantView('merchant/add_product', $data);
    }

    public function storeProduct()
    {
        $userId = session()->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        if (!$this->validate([
            'name' => 'required|min_length[3]',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'location' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $imageUrl = $this->request->getPost('image_url') ?: 'https://via.placeholder.com/400';

        $this->productModel->save([
            'merchant_id' => $merchant['id'],
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'variant' => $this->request->getPost('variant'),
            'location' => $this->request->getPost('location'),
            'image_url' => $imageUrl,
            'rating' => 4.5,
            'sold_count' => 0
        ]);

        return redirect()->to(base_url('merchant/dashboard'))->with('success', 'Produk berhasil ditambahkan!');
    }

    public function updateReservationStatus($id)
    {
        $status = $this->request->getPost('status');
        $this->reservationModel->update($id, ['status' => $status]);
        
        return redirect()->back()->with('success', 'Status reservasi berhasil diupdate!');
    }
}