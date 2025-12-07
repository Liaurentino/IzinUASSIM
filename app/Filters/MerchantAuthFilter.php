<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MerchantModel;

class MerchantAuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     *
     * @param array|null $arguments
     *
     * @return ResponseInterface|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Cek apakah user sudah login
        if (! $session->get('isLoggedIn')) {
            return redirect()->to(base_url('auth/login'))->with('error', 'Silahkan login terlebih dahulu.');
        }

        // 2. Cek apakah role user adalah 'merchant'
        if ($session->get('role') !== 'merchant') {
            // Jika bukan merchant, arahkan ke halaman utama atau halaman daftar merchant
            return redirect()->to(base_url('/'))->with('error', 'Akses Merchant Ditolak. Anda bukan Merchant terdaftar.');
        }
        
        // 3. Cek status merchant (penting: hanya untuk yang statusnya 'approved' yang bisa akses penuh)
        $merchantModel = new MerchantModel();
        $merchant = $merchantModel->where('user_id', $session->get('user_id'))->first();

        if ($merchant && $merchant['status'] !== 'approved') {
            // Jika status pending atau rejected, biarkan mereka mengakses halaman dashboard saja
            if ($request->uri->getPath() !== 'merchantdashboard') {
                 return redirect()->to(base_url('merchantdashboard'))->with('warning', 'Dashboard Anda masih dalam status ' . $merchant['status'] . '. Harap tunggu persetujuan Admin.');
            }
        }
        // Jika status approved, lanjutkan ke controller yang diminta
    }

    /**
     * We don't have anything to do here.
     *
     * @param array|null $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ...
    }
}