<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MerchantAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Cek apakah sudah login?
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // 2. Cek apakah role-nya merchant?
        if ($session->get('role') !== 'merchant') {
            // Jika dia user biasa/admin, kembalikan ke home agar tidak error/loop
            return redirect()->to('/'); 
        }
        
        // Jika lolos kedua cek di atas, biarkan masuk.
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}