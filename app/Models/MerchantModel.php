<?php

namespace App\Models;

use CodeIgniter\Model;

class MerchantModel extends Model
{
    protected $table            = 'merchants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    
      protected $allowedFields    = [
        'user_id', 
        'business_name',   
        'merchant_name',  
        'address', 
        'phone',           
        'email', 
        'business_type', 
        'license_number', 
        'latitude', 
        'longitude', 
        'status'
    ];

    protected $useTimestamps = true; 
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPendingMerchants()
    {
        return $this->where('status', 'pending')->findAll();
    }
}