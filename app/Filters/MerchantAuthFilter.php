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


        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userId = $session->get('user_id');
        $merchantModel = new MerchantModel();
        
        $merchant = $merchantModel->where('user_id', $userId)->first();

        if (!$merchant) {
            return redirect()->to(base_url('/'));
        }

        $uri = $request->getUri()->getPath();
        
        if ($merchant['status'] === 'approved') {
    
            if ($session->get('role') !== 'merchant') {
                $session->set([
                    'role' => 'merchant',
                    'merchant_id' => $merchant['id'],
                    'merchant_status' => 'approved',
                    'merchant_name' => $merchant['business_name']
                ]);
            
                $userModel = new UserModel();
                $userModel->update($userId, ['role' => 'merchant']);
            }
        
            return;
        }
        elseif ($merchant['status'] === 'pending') {
            if (strpos($uri, 'merchant/waiting') !== false) {
                return;
            }
            return redirect()->to(base_url('merchant/waiting'));
        }
        else {
            return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}