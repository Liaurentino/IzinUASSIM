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
    // Tambahkan 'status' ke allowedFields dan pastikan 'user_id' ada
    protected $allowedFields    = ['user_id', 'merchant_name', 'address', 'phone_number', 'latitude', 'longitude', 'status']; 

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Fungsi untuk mendapatkan merchant yang masih pending
    public function getPendingMerchants()
    {
        return $this->where('status', 'pending')->findAll();
    }
}