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
            return redirect()->to(base_url('/'))->with('error', 'Akses Merchant Ditolak. Anda bukan Merchant terdaftar.');
        }
        
        // 3. Cek status merchant
        $merchantModel = new MerchantModel();
        $merchant = $merchantModel->where('user_id', $session->get('user_id'))->first();

        // Jika status BUKAN 'approved'
        if ($merchant && $merchant['status'] !== 'approved') {
            
            // Ambil URI saat ini dan konversi ke format yang seragam
            $currentUri = service('uri')->getPath();
            
            // List URI Dashboard utama yang diperbolehkan meskipun statusnya pending/rejected
            $allowedDashboardRoutes = [
                'merchant/dashboard', 
                'merchantdashboard'
            ];

            // Cek apakah URI saat ini BUKAN salah satu dari rute Dashboard yang diizinkan
            if (! in_array($currentUri, $allowedDashboardRoutes)) {
                // Jika user mencoba mengakses rute lain (seperti /merchant/products), 
                // arahkan kembali ke dashboard utama yang akan menampilkan status pending/rejected
                 return redirect()->to(base_url('merchant/dashboard'))->with('warning', 'Dashboard Anda masih dalam status ' . $merchant['status'] . '. Harap tunggu persetujuan Admin.');
            }
        }
        // Jika status approved, atau jika statusnya belum approved TAPI HANYA mengakses /merchant/dashboard, lanjutkan.
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