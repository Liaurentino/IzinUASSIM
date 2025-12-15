<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'merchant_id', 'name', 'description', 'price', 'stock', 'variant', 'location', 'image_url', 'rating', 'sold_count'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function merchant()
    {
        return $this->belongsTo(MerchantModel::class, 'merchant_id');
    }
}