<?php namespace App\Controllers;

use App\Models\ReservationModel;

class Reservation extends BaseController
{
    // Daftar lokasi servis (Hardcoded sesuai permintaan)
    protected $serviceLocations = [
        [
            "name" => "Servis Jaya Abadi",
            "address" => "Jl. Sudirman No. 123, Jakarta Pusat"
        ],
        [
            "name" => "Servis Anggara 20",
            "address" => "Jl. TB Simatupang No. 45, Jakarta Selatan"
        ],
        [
            "name" => "TeknisiABC",
            "address" => "Jl. Asia Afrika No. 78, Bandung"
        ],
        [
            "name" => "Komputer Jaya Abadi",
            "address" => "Jl. Raya Darmo No. 100, Surabaya"
        ],
        [
            "name" => "Medan Ahli Komputer",
            "address" => "Jl. Gatot Subroto No. 88, Medan"
        ]
    ];

    public function index()
    {
        $data = [
            'title' => 'Servify - Reservasi Service',
            'validation' => \Config\Services::validation(),
            'serviceLocations' => $this->serviceLocations // Kirim data lokasi ke view
        ];
        
        return $this->renderView('pages/reservation', $data);
    }

    public function create()
    {
        // 1. Validasi Input (Tambahkan service_location)
        if (! $this->validate([
            'name'             => 'required|min_length[3]',
            'phone'            => 'required|min_length[10]|max_length[15]',
            'laptop_model'     => 'required|max_length[255]',
            'complaint'        => 'required',
            'reservation_date' => 'required|valid_date',
            'service_location' => 'required', // Validasi baru
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // 2. Simpan ke Database
        $reservationModel = new ReservationModel();
        $userId = $this->session->get('user_id'); 

        $reservationModel->save([
            'user_id'          => $userId,
            'name'             => $this->request->getPost('name'),
            'phone'            => $this->request->getPost('phone'),
            'laptop_model'     => $this->request->getPost('laptop_model'),
            'complaint'        => $this->request->getPost('complaint'),
            'reservation_date' => $this->request->getPost('reservation_date'),
            'service_location' => $this->request->getPost('service_location'), // Simpan lokasi
            'status'           => 'Pending',
        ]);

        // 3. Redirect
        $this->session->setFlashdata('success', 'Reservasi berhasil dibuat! Kami akan segera menghubungi Anda.');
        return redirect()->to(base_url('reservation'));
    }
}