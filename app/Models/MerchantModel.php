<?php namespace App\Models;

use CodeIgniter\Model;

class MerchantModel extends Model
{
    protected $table      = 'merchants';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'business_name', 'address', 'phone', 'email', 'business_type', 'license_number', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Aturan validasi
    protected $validationRules = [
        'business_name'  => 'required|min_length[3]|max_length[255]|is_unique[merchants.business_name]',
        'address'        => 'required',
        'phone'          => 'required|min_length[10]|max_length[15]',
        'email'          => 'required|valid_email|is_unique[merchants.email]',
        'business_type'  => 'required',
        'license_number' => 'required|is_unique[merchants.license_number]',
    ];

    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    // Relasi ke tabel products
    public function products()
    {
        return $this->hasMany(ProductModel::class, 'merchant_id');
    }
}