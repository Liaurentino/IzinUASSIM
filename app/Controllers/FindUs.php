<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MerchantModel;

class FindUs extends BaseController
{
    public function index()
    {
        $merchantModel = new MerchantModel();
        $merchants = $merchantModel
            ->select('
                merchants.id,
                merchants.business_name,
                merchants.address,
                merchants.phone,
                merchants.email,
                merchants.business_type,
                merchants.latitude,
                merchants.longitude
            ')
            ->where('merchants.status', 'approved')
            ->where('merchants.latitude IS NOT NULL')
            ->where('merchants.longitude IS NOT NULL')
            ->findAll();

        return view('findus/index', [
            'title'     => 'Find Us',
            'merchants' => $merchants
        ]);
    }
}
