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
        $this->merchantModel    = new MerchantModel();
        $this->productModel     = new ProductModel();
        $this->reservationModel = new ReservationModel();
    }

    protected function renderMerchantView(string $view, array $data = [])
    {
        $data['session'] = session();
        echo view('merchant/layout/header', $data);
        echo view($view, $data);
        echo view('merchant/layout/footer');
    }

    public function index()
    {
        $userId   = session()->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        if (!$merchant || strtolower($merchant['status']) !== 'approved') {
            return redirect()->to(base_url('merchant/waiting'));
        }

        $merchantId = (int) $merchant['id'];

        $data = [
            'title'                   => 'Dashboard Merchant',
            'merchant'                => $merchant,
            'total_products'          => $this->productModel
                                            ->where('merchant_id', $merchantId)
                                            ->countAllResults(),
            'pending_reservations'    => $this->reservationModel
                                            ->countByMerchant($merchantId, 'Pending'),
            'completed_reservations'  => $this->reservationModel
                                            ->countByMerchant($merchantId, 'Completed'),
            'recent_products'         => $this->productModel
                                            ->where('merchant_id', $merchantId)
                                            ->orderBy('created_at', 'DESC')
                                            ->findAll(5),
            'recent_reservations'     => $this->reservationModel
                                            ->getByMerchant($merchantId, null, 5),
        ];

        return $this->renderMerchantView('merchant/dashboard_content', $data);
    }

    /* =========================
       KELOLA PRODUK
    ========================== */
      public function products()
    {
        $userId = session()->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        $data = [
            'title' => 'Kelola Produk',
            'merchant' => $merchant,
            'products' => $this->productModel->where('merchant_id', $merchant['id'])->findAll()
        ];
        
        return $this->renderMerchantView('merchant/add_product', $data);
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

    /* =========================
       KELOLA RESERVASI
    ========================== */

   public function reservations()
{
    $userId = session()->get('user_id');
    $merchant = $this->merchantModel
        ->where('user_id', $userId)
        ->first();

    // Ambil filter status dari URL
    $currentFilter = $this->request->getGet('status') ?? 'all';

    // Query dasar
    $builder = $this->reservationModel
        ->where('merchant_id', $merchant['id']);

    if ($currentFilter !== 'all') {
        $builder->where('status', $currentFilter);
    }

    $reservations = $builder
        ->orderBy('reservation_date', 'DESC')
        ->findAll();

    // Statistik
    $stats = [
        'pending'     => $this->reservationModel->where([
            'merchant_id' => $merchant['id'],
            'status'      => 'Pending'
        ])->countAllResults(),

        'processing'  => $this->reservationModel->where([
            'merchant_id' => $merchant['id'],
            'status'      => 'Processing'
        ])->countAllResults(),

        'completed'   => $this->reservationModel->where([
            'merchant_id' => $merchant['id'],
            'status'      => 'Completed'
        ])->countAllResults(),
    ];

    return $this->renderMerchantView('merchant/reservations', [
        'title'         => 'Manajemen Reservasi',
        'merchant'      => $merchant,
        'reservations'  => $reservations,
        'stats'         => $stats,
        'currentFilter' => $currentFilter
    ]);
}
    /* =========================
       DETAIL RESERVASI
    ========================== */

    public function reservationDetail(int $id)
    {
        $userId   = session()->get('user_id');
        $merchant = $this->merchantModel->where('user_id', $userId)->first();

        $reservation = $this->reservationModel->find($id);

        if (!$reservation || $reservation['merchant_id'] != $merchant['id']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Reservasi tidak ditemukan');
        }

        $data = [
            'title'       => 'Detail Reservasi',
            'reservation' => $reservation,
            'merchant'    => $merchant
        ];

        return $this->renderMerchantView('merchant/reservation_detail', $data);
    }

    /* =========================
       UPDATE STATUS
    ========================== */

    public function updateReservationStatus(int $id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403);
        }

        $status = $this->request->getPost('status');
        $notes  = $this->request->getPost('notes');

        $valid = ['Pending', 'Processing', 'Completed', 'Cancelled'];
        if (!in_array($status, $valid, true)) {
            return $this->response->setJSON(['success' => false]);
        }

        $this->reservationModel->updateStatus($id, $status, $notes);

        return $this->response->setJSON(['success' => true]);
    }

    public function waiting()
    {
        return $this->renderMerchantView('merchant/waiting', [
            'title' => 'Menunggu Verifikasi'
        ]);
    }
}
