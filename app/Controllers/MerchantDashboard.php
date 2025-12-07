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

    public function index()
    {
        $session = session();
        
        // Cek apakah user sudah login dan role-nya merchant
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'merchant') {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login sebagai merchant');
        }

        $userId = $session->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        // Cek apakah merchant sudah disetujui
        if (!$merchant || $merchant['status'] !== 'approved') {
            return redirect()->to(base_url('merchant/waiting'));
        }

        // Ambil data untuk dashboard
        $data = [
            'title' => 'Dashboard Merchant',
            'merchant' => $merchant,
            'total_products' => $this->productModel->where('merchant_id', $merchant['id'])->countAllResults(),
            'total_reservations' => $this->reservationModel->where('merchant_id', $merchant['id'])->countAllResults(),
        ];

        return view('merchant/dashboard', $data);
    }

    // Halaman waiting untuk merchant yang belum disetujui
    public function waiting()
    {
        $session = session();
        $userId = $session->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        if (!$merchant) {
            return redirect()->to(base_url('/'));
        }

        $data = [
            'title' => 'Menunggu Persetujuan',
            'merchant' => $merchant
        ];

        return view('merchant/waiting', $data);
    }

    // Tambah Produk
    public function addProduct()
    {
        $session = session();
        $userId = $session->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        if (!$merchant || $merchant['status'] !== 'approved') {
            return redirect()->to(base_url('merchant/dashboard'));
        }

        $data = [
            'title' => 'Tambah Produk',
            'merchant' => $merchant,
            'validation' => \Config\Services::validation()
        ];

        return view('merchant/add_product', $data);
    }

    // Store Produk
    public function storeProduct()
    {
        $session = session();
        $userId = $session->get('user_id');
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

    // Lihat Reservasi
    public function reservations()
    {
        $session = session();
        $userId = $session->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        if (!$merchant || $merchant['status'] !== 'approved') {
            return redirect()->to(base_url('merchant/dashboard'));
        }

        // Ambil semua reservasi untuk merchant ini
        $reservations = $this->reservationModel->where('merchant_id', $merchant['id'])->findAll();

        $data = [
            'title' => 'Kelola Reservasi',
            'merchant' => $merchant,
            'reservations' => $reservations
        ];

        return view('merchant/reservations', $data);
    }

    // Update Status Reservasi
    public function updateReservationStatus($id)
    {
        $status = $this->request->getPost('status');
        
        $this->reservationModel->update($id, ['status' => $status]);
        
        return redirect()->back()->with('success', 'Status reservasi berhasil diupdate!');
    }
}