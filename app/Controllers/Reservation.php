<?php namespace App\Controllers;

use App\Models\ReservationModel;

class Reservation extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Servify - Reservasi Service',
            'validation' => \Config\Services::validation()
        ];
        
        return $this->renderView('pages/reservation', $data);
    }

    public function create()
    {
        // 1. Validasi Input
        if (! $this->validate([
            'name'             => 'required|min_length[3]',
            'phone'            => 'required|min_length[10]|max_length[15]',
            'laptop_model'     => 'required|max_length[255]',
            'complaint'        => 'required',
            'reservation_date' => 'required|valid_date',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // 2. Simpan ke Database
        $reservationModel = new ReservationModel();
        $userId = $this->session->get('user_id'); // Ambil user ID jika sudah login

        $reservationModel->save([
            'user_id'          => $userId,
            'name'             => $this->request->getPost('name'),
            'phone'            => $this->request->getPost('phone'),
            'laptop_model'     => $this->request->getPost('laptop_model'),
            'complaint'        => $this->request->getPost('complaint'),
            'reservation_date' => $this->request->getPost('reservation_date'),
            'status'           => 'Pending',
        ]);

        // 3. Redirect
        $this->session->setFlashdata('success', 'Reservasi berhasil dibuat! Kami akan segera menghubungi Anda.');
        return redirect()->to(base_url('reservation'));
    }
}