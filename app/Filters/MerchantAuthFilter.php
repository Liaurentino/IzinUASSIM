<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MerchantModel;
use App\Models\UserModel;

class MerchantAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Cek Login Dasar
        if (! $session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        if ($session->get('role') !== 'merchant') {
            
            $userId = $session->get('id');
            $merchantModel = new MerchantModel();
            
            // Cek status terbaru di Database
            $merchant = $merchantModel->where('user_id', $userId)->first();

            // Skenario A: Admin SUDAH Approve, tapi session user masih user biasa
            if ($merchant && $merchant['status'] === 'approved') {
                // Update Session secara paksa agar user bisa masuk
                $session->set([
                    'role' => 'merchant',
                    'merchant_id' => $merchant['id'],
                    'merchant_status' => 'approved',
                    'merchant_name' => $merchant['business_name']
                ]);
                
                // Pastikan role di tabel user juga merchant (double check safety)
                $userModel = new UserModel();
                $userModel->update($userId, ['role' => 'merchant']);

                // Izinkan akses (jangan return redirect, biarkan lanjut ke controller tujuan)
                return; 
            }
            
            // Skenario B: Masih Pending
            if ($merchant && $merchant['status'] === 'pending') {
                // Izinkan akses HANYA ke halaman 'waiting'
                $uri = $request->getUri()->getPath();
                if (strpos($uri, 'merchant/waiting') !== false) {
                    return;
                }
                return redirect()->to(base_url('merchant/waiting'));
            }

            // Skenario C: Tidak punya data merchant / User biasa iseng akses
            return redirect()->to(base_url('/'));
        }

        // 3. Jika session sudah 'merchant', cek status approvalnya
        if ($session->get('merchant_status') !== 'approved') {
             // Tangani jika status rejected atau pending tapi role session terlanjur merchant
             return redirect()->to(base_url('merchant/waiting'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}