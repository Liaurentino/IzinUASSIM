<?php namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\MerchantModel;

class Reservation extends BaseController
{
    protected $reservationModel;
    protected $merchantModel;

    public function __construct()
    {
        $this->reservationModel = new ReservationModel();
        $this->merchantModel = new MerchantModel();
    }

    /**
     * Tampilkan halaman reservasi dengan list merchant yang approved
     */
    public function index()
    {
        // Ambil semua merchant yang sudah di-approve
        $approvedMerchants = $this->merchantModel->getApprovedMerchants();

        $data = [
            'title' => 'Servify - Reservasi Service',
            'validation' => \Config\Services::validation(),
            'merchants' => $approvedMerchants // Kirim merchant ke view
        ];
        
        return $this->renderView('pages/reservation', $data);
    }

    /**
     * API untuk mendapatkan merchant berdasarkan pencarian
     */
    public function getMerchants()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false]);
        }

        $search = $this->request->getPost('search');
        
        $merchants = $search 
            ? $this->merchantModel->searchByName($search)
            : $this->merchantModel->getApprovedMerchants();

        return $this->response->setJSON([
            'success' => true,
            'merchants' => $merchants
        ]);
    }

    /**
     * Proses pembuatan reservasi
     */
    public function create()
    {
        // Validasi input
        if (! $this->validate([
            'name'             => 'required|min_length[3]',
            'phone'            => 'required|min_length[10]|max_length[15]',
            'laptop_model'     => 'required|max_length[255]',
            'complaint'        => 'required',
            'reservation_date' => 'required|valid_date',
            'merchant_id'      => 'required|numeric',
            'merchant_name'    => 'required',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $merchantId = (int) $this->request->getPost('merchant_id');
        
        // Verifikasi merchant ada dan status approved
        $merchant = $this->merchantModel->find($merchantId);
        if (!$merchant || $merchant['status'] !== 'approved') {
            return redirect()->back()->with('error', 'Merchant tidak valid atau belum di-approve.');
        }

        // Simpan reservasi
        $data = [
            'user_id'           => $this->session->get('user_id') ?? null,
            'merchant_id'       => $merchantId,
            'merchant_name'     => $this->request->getPost('merchant_name'),
            'name'              => $this->request->getPost('name'),
            'phone'             => $this->request->getPost('phone'),
            'laptop_model'      => $this->request->getPost('laptop_model'),
            'complaint'         => $this->request->getPost('complaint'),
            'reservation_date'  => $this->request->getPost('reservation_date'),
            'service_location'  => $this->request->getPost('merchant_name'), // Nama merchant sebagai lokasi
            'status'            => 'Pending',
        ];

        if ($this->reservationModel->save($data)) {
            $this->session->setFlashdata('success', 
                'Reservasi berhasil dibuat! Kami akan segera menghubungi Anda. ' .
                'Cek status di menu "Reservasi Saya"'
            );
            return redirect()->to(base_url('reservation'));
        } else {
            $this->session->setFlashdata('error', 'Gagal membuat reservasi. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }
    
    public function myReservations()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userId = $this->session->get('user_id');
        $reservations = $this->reservationModel->getByUserId($userId);

        $data = [
            'title' => 'Reservasi Saya',
            'reservations' => $reservations
        ];

        return $this->renderView('pages/my_reservations', $data);
    }

    /**
     * Halaman detail reservasi
     */
    public function detail($id)
    {
        $reservation = $this->reservationModel->getWithMerchantDetails($id);

        if (!$reservation) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Reservasi tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Reservasi',
            'reservation' => $reservation
        ];

        return $this->renderView('pages/reservation_detail', $data);
    }
}