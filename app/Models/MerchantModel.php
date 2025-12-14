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
        'phone_number',
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

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    /**
     * Dapatkan merchant berdasarkan user_id
     */
    public function getMerchantByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    /**
     * Dapatkan semua merchant yang approved
     */
    public function getApprovedMerchants()
    {
        return $this->where('status', 'approved')->findAll();
    }

    /**
     * Dapatkan merchant pending untuk di-verify admin
     */
    public function getPendingMerchants()
    {
        return $this->where('status', 'pending')->findAll();
    }

    /**
     * Update status merchant
     */
    public function updateMerchantStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Cari merchant berdasarkan nama
     */
    public function searchByName($name)
    {
        return $this->like('business_name', $name)->orLike('merchant_name', $name)->findAll();
    }
}
