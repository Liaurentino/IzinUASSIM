<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MerchantAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            $session->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to(base_url('login'));
        }
        
        // Check if user has merchant account and it's verified
        if (!$session->get('merchant_id') || $session->get('merchant_status') !== 'Verified') {
            $session->setFlashdata('error', 'Akses ditolak. Anda belum terdaftar sebagai merchant atau belum diverifikasi.');
            return redirect()->to(base_url('merchant'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}