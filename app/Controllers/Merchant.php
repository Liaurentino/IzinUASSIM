<?php namespace App\Controllers;

use App\Models\MerchantModel;

class Merchant extends BaseController
{
    private function geocodeAddress(string $address): ?array
{
    $url = 'https://nominatim.openstreetmap.org/search?' . http_build_query([
        'q'      => $address,
        'format' => 'json',
        'limit'  => 1
    ]);

    $context = stream_context_create([
        'http' => [
            'header' => "User-Agent: ServifyApp/1.0\r\n"
        ]
    ]);

    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        return null;
    }

    $result = json_decode($response, true);

    if (empty($result)) {
        return null;
    }

    return [
        'latitude'  => $result[0]['lat'],
        'longitude' => $result[0]['lon']
    ];
}
    // Halaman Info Merchant (Public User View)
    public function index()
    {
        $data = [
            'title' => 'Servify - Gabung Merchant',
        ];

        return $this->renderView('pages/merchant_info', $data);
    }

    // Halaman Form Register (Public User View)
    public function register()
    {
        if (! session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Anda harus login untuk mendaftar sebagai Mitra.');
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Servify - Form Pendaftaran Merchant',
            'validation' => \Config\Services::validation()
        ];
        
        return $this->renderView('pages/merchant_register', $data);
    }

    // Proses Submit Data
    public function create()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $merchantModel = new MerchantModel();
    
        $userId = session()->get('id') ?? session()->get('user_id');

        $existingMerchant = $merchantModel->where('user_id', $userId)->first();
        if ($existingMerchant) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar atau sedang dalam proses verifikasi.');
        }

        if (! $this->validate([
            'business_name'  => 'required|min_length[3]',
            'address'        => 'required',
            'phone'          => 'required|min_length[10]|max_length[15]',
            'email'          => 'required|valid_email',
            'business_type'  => 'required',
            'license_number' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $address = $this->request->getPost('address');
        $coords  = $this->geocodeAddress($address);

        $data = [
            'user_id'        => $userId,
            'business_name'  => $this->request->getPost('business_name'),
            'merchant_name'  => $this->request->getPost('business_name'),
            'address'        => $address,
            'phone'          => $this->request->getPost('phone'),
            'phone_number'   => $this->request->getPost('phone'),
            'email'          => $this->request->getPost('email'),
            'business_type'  => $this->request->getPost('business_type'),
            'license_number' => $this->request->getPost('license_number'),
            'latitude'       => $coords['latitude'] ?? null,
            'longitude'      => $coords['longitude'] ?? null,
            'status'         => 'pending',
        ];

        if($merchantModel->save($data)) {
            session()->setFlashdata('success', 'Pendaftaran Mitra berhasil! Mohon tunggu verifikasi Admin.');
            return redirect()->to(base_url('merchant/waiting')); 
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }
    public function waiting()
{
    if (! session()->get('isLoggedIn')) {
        return redirect()->to(base_url('login'));
    }

    $merchantModel = new MerchantModel();
    $userId = session()->get('id') ?? session()->get('user_id');

    $merchant = $merchantModel
        ->where('user_id', $userId)
        ->first();

    if (! $merchant) {
        return redirect()->to(base_url('merchant/register'));
    }

    $data = [
        'title'     => 'Menunggu Persetujuan Merchant',
        'merchants' => $merchant
    ];

    return $this->renderView('merchant/waiting', $data);
}
}