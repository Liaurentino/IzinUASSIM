<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MerchantModel;

class MerchantDashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (! $userId) {
            // Jika tidak login, redirect ke login
            return redirect()->to(base_url('auth/login'))->with('error', 'Silahkan login terlebih dahulu.');
        }

        $merchantModel = new MerchantModel();
        $merchant = $merchantModel->where('user_id', $userId)->first();
        
        $data['title'] = 'Dashboard Merchant';
        $data['merchant'] = $merchant;
        
        // Cek status merchant
        if ($merchant) {
            $data['status'] = $merchant['status'];
            
            if ($merchant['status'] === 'approved') {
                return view('merchant/dashboard', $data);
            } elseif ($merchant['status'] === 'pending') {
                $data['title'] = 'Pendaftaran Tertunda';
                return view('merchant/status_pending', $data); // View baru
            } else {
                $data['title'] = 'Pendaftaran Ditolak';
                return view('merchant/status_rejected', $data); // View baru
            }
        } else {
            // Jika user login tapi tidak memiliki data merchant (seharusnya tidak terjadi jika role sudah 'merchant')
             return redirect()->to(base_url('merchant/register'))->with('error', 'Data Merchant tidak ditemukan. Silahkan daftar ulang.');
        }
    }
    
    // Fungsi-fungsi lain di MerchantDashboard seperti products(), reservation(), statistic() 
    // perlu disesuaikan agar hanya dapat diakses jika status merchant adalah 'approved'.
    // Ini bisa diatasi dengan MerchantAuthFilter (lihat bagian 4).
}