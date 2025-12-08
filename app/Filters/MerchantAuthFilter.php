<?php 

namespace App\Filters;

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

        // 1. CEK LOGIN DASAR
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userId = $session->get('user_id');
        $merchantModel = new MerchantModel();
        
        // 2. CEK DATA MERCHANT DI DATABASE
        $merchant = $merchantModel->where('user_id', $userId)->first();

        if (!$merchant) {
            // User belum daftar merchant
            return redirect()->to(base_url('/'));
        }

        // 3. HANDLE BERDASARKAN STATUS
        $uri = $request->getUri()->getPath();
        
        if ($merchant['status'] === 'approved') {
            // Merchant sudah approved
            
            // Update session jika belum
            if ($session->get('role') !== 'merchant') {
                $session->set([
                    'role' => 'merchant',
                    'merchant_id' => $merchant['id'],
                    'merchant_status' => 'approved',
                    'merchant_name' => $merchant['business_name']
                ]);
                
                // Update role di database juga
                $userModel = new UserModel();
                $userModel->update($userId, ['role' => 'merchant']);
            }
            
            // Izinkan akses dashboard
            return;
        }
        elseif ($merchant['status'] === 'pending') {
            // Hanya izinkan akses halaman waiting
            if (strpos($uri, 'merchant/waiting') !== false) {
                return;
            }
            return redirect()->to(base_url('merchant/waiting'));
        }
        else {
            // Status rejected atau lainnya
            return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}